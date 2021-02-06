<?php

namespace shop\services\Shop;
use shop\cart\Cart;
use shop\cart\CartItem;
use shop\entities\Shop\Order\CustomerData;
use shop\entities\Shop\Order\DeliveryData;
use shop\entities\Shop\Order\Order;
use shop\entities\Shop\Order\OrderItem;
use shop\forms\Shop\Order\OrderForm;
use shop\repositories\Shop\DeliveryMethodRepository;
use shop\repositories\Shop\PaymentMethodRepository;
use shop\repositories\Shop\OrderRepository;
use shop\repositories\Shop\ProductRepository;
use shop\repositories\UserRepository;
use shop\services\TransactionManager;
use yii\mail\MailerInterface;
use Yii;

class OrderService
{
    private $cart;
    private $orders;
    private $products;
    private $users;
    private $deliveryMethods;
    private $paymentMethods;
    private $transaction;
    private $mailer;

    public function __construct(
        Cart $cart,
        OrderRepository $orders,
        ProductRepository $products,
        UserRepository $users,
        DeliveryMethodRepository $deliveryMethods,
        PaymentMethodRepository $paymentMethods,
        TransactionManager $transaction,
         MailerInterface $mailer
    )
    {
        $this->cart = $cart;
        $this->orders = $orders;
        $this->products = $products;
        $this->users = $users;
        $this->deliveryMethods = $deliveryMethods;
        $this->paymentMethods = $paymentMethods;
        $this->transaction = $transaction;
        $this->mailer = $mailer;
    }

    public function checkout($userId, OrderForm $form, $password = null): Order
    {
        $user = $this->users->get($userId);

        $products = [];

        $items = array_map(function (CartItem $item) use (&$products) {
            $product = $item->getProduct();
            $product->checkout($item->getModificationId(), $item->getQuantity());
            $products[] = $product;
            return OrderItem::create(
                $product,
                $item->getModificationId(),
                $item->getPrice(),
                $item->getQuantity()
            );
        }, $this->cart->getItems());

        $order = Order::create(
            $user->id,
            new CustomerData(
                $form->customer->phone,
                $form->customer->name,
                $form->customer->email
            ),
            $items,
            $this->cart->getCost()->getTotal(),
            $form->note
        );


        $order->setPaymentMethod($this->paymentMethods->get($form->payment->method));

        $order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery->method),
            new DeliveryData(
                $form->delivery->index,
                $form->delivery->address
            )
        );

        $this->transaction->wrap(function () use ($order, $products) {
            $this->orders->save($order);
            foreach ($products as $product) {
                $this->products->save($product);
            }
            $this->cart->clear();
        });

        $send = $this->mailer
            ->compose(
                ['html' => 'checkout/checkout-html', 'text' => 'checkout/checkout-text'],
                ['user' => $user,'order' => $order, 'password' => $password]
            )
            ->setTo($form->customer->email)
            ->setFrom(['info@pharmagreen.ru' => 'Письмо с сайта'])
            ->setSubject('Заказ № ' . $order->id)
            ->send();
        if (!$send) {
            throw new \RuntimeException('Email sending error.');
        }

        return $order;
    }


}