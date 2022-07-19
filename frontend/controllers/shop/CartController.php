<?php

namespace frontend\controllers\shop;

use shop\forms\Shop\AddToCartForm;
use shop\readModels\Shop\ProductReadRepository;
use shop\services\Shop\CartService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\widgets\Shop\CartWidget;

class CartController extends Controller
{
    public $layout = 'blank';

    private $products;
    private $service;

    public function __construct($id, $module, CartService $service, ProductReadRepository $products, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'quantity' => ['POST'],
                    'remove' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $cart = $this->service->getCart();

        return $this->render('index', [
            'cart' => $cart,
        ]);
    }

    public function actionAjaxTest()
    {
        //$cart = $this->service->getCart();

        if(\Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $testData = Yii::$app->request->post();
            return 'success';
        }
    }

    public function actionAjaxAdd($id)
    {


          if (!$product = $this->products->find($id)) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }

          $form = new AddToCartForm($product);

        if(\Yii::$app->request->isAjax){

            //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if (!$product->modifications) {
                if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                    try {
                        $this->service->add($product->id, null, $form->quantity);
                        return CartWidget::widget();
                    } catch (\DomainException $e) {
                        Yii::$app->errorHandler->logException($e);
                        Yii::$app->session->setFlash('error', $e->getMessage());
                    }
                }
    
                try {
                    $this->service->add($product->id, null, 1);
                    Yii::$app->session->setFlash('success', 'Товар добавлен в корзину!');
                    return CartWidget::widget();
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }
    
          //  $this->layout = 'blank';
    
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                try {
                    $this->service->add($product->id, $form->modification, $form->quantity);
                    return CartWidget::widget();
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            } else {
                try {
                    $this->service->add($product->id, null, 1);
                    Yii::$app->session->setFlash('success', 'Товар добавлен в корзину!');
                    return CartWidget::widget();
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }

           

            // if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            //     try {
            //         $this->service->add($product->id, null, $form->quantity);
            //     } catch (\DomainException $e) {
            //         Yii::$app->errorHandler->logException($e);
            //         Yii::$app->session->setFlash('error', $e->getMessage());
            //     }

            //     return CartWidget::widget();

            // }

            // if (!$product->modifications) {
            //     try {
            //         $this->service->add($product->id, null, 1);
            //     } catch (\DomainException $e) {
            //         Yii::$app->errorHandler->logException($e);
            //         Yii::$app->session->setFlash('error', $e->getMessage());
            //     }
            //     return CartWidget::widget();
            // }
        }

        return $this->render('add', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */


    public function actionAdd($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $form = new AddToCartForm($product);

        if (!$product->modifications) {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                try {
                    $this->service->add($product->id, null, $form->quantity);
                    return $this->redirect(['index']);
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }

            try {
                $this->service->add($product->id, null, 1);
                Yii::$app->session->setFlash('success', 'Товар добавлен в корзину!');
                return $this->redirect(Yii::$app->request->referrer);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        $this->layout = 'blank';

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->add($product->id, $form->modification, $form->quantity);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('add', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionQuantity($id)
    {
        try {
            $this->service->set($id, (int)Yii::$app->request->post('quantity'));
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionQuantityall(array $ids)
    {
        foreach($ids as $id){
        try {
            $this->service->set($id, (int)Yii::$app->request->post('quantity_'.$id));
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        }
        return $this->redirect(['index']);
    }



    /**
     * @param $id
     * @return mixed
     */
    public function actionRemove($id)
    {

        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }



    public function actionRemoveAjax($id)
    {

        if(\Yii::$app->request->isAjax){
             //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            try {
                $this->service->remove($id);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            return CartWidget::widget();
        }


    }

}