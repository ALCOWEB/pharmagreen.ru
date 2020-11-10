<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 19.09.2020
 * Time: 15:34
 */

namespace shop\services\manage\Shop;
use shop\entities\Shop\PaymentMethod;
use shop\forms\manage\Shop\PaymentForm;
use shop\repositories\Shop\PaymentMethodRepository;


class PaymentMethodManageService
{
    private $payment_method;

    public function __construct(PaymentMethodRepository $payment_method)
    {
        $this->payment_method = $payment_method;
    }

    public function create(PaymentForm $payment_method): PaymentMethod
    {
        $method = PaymentMethod::create($payment_method->name);
        $this->payment_method->save($method);
        return $method;
    }

    public function edit($id, PaymentForm $form): void
    {
        $method = $this->payment_method->get($id);
        $method->edit(
            $form->name
        );
        $this->payment_method->save($method);
    }

    public function remove($id): void
    {
        $method = $this->payment_method->get($id);
        $this->payment_method->remove($method);
    }

}