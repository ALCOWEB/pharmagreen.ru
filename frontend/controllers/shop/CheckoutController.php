<?php

namespace frontend\controllers\shop;

use shop\cart\Cart;
use shop\forms\Shop\Order\OrderForm;
use shop\forms\auth\SignupForm;
use shop\services\Shop\OrderService;
use shop\services\auth\SignupService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\mail\MailerInterface;

class CheckoutController extends Controller
{
    public $layout = 'blank';

    private $service;
    private $signup_service;
    private $cart;

    public function __construct($id, $module, OrderService $service, SignupService $signup_service, Cart $cart, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->signup_service = $signup_service;
        $this->cart = $cart;
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $form = new OrderForm($this->cart->getWeight());

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
           if (!Yii::$app->user->isGuest){
                try {
                    $order = $this->service->checkout(Yii::$app->user->id, $form);
                    return $this->redirect(['/cabinet/order/'.$order->id_hash]);
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            } else {


               try {


                      $user = $this->signup_service->getByEmail($form->customer->email);
                      if ($user){
                          $order = $this->service->checkout($user->id, $form);
                          return $this->redirect(['/cabinet/order/'.$order->id_hash]);
                      } else {

                          $this->signup_service->signup_order($form);
                          $user = $this->signup_service->getByEmail($form->customer->email);
                          $order = $this->service->checkout($user->id, $form);
                          return $this->redirect(['/cabinet/order/'.$order->id_hash]);
                      }

               } catch (\DomainException $e) {
                   Yii::$app->errorHandler->logException($e);
                   Yii::$app->session->setFlash('error', $e->getMessage());
               }

           }
        }

        return $this->render('index', [
            'cart' => $this->cart,
            'model' => $form,
        ]);
    }
}