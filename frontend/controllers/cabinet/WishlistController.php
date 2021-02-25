<?php

namespace frontend\controllers\cabinet;

use frontend\widgets\Shop\CartWidget;
use frontend\widgets\Shop\WishlistWidget;
use shop\readModels\Shop\ProductReadRepository;
use shop\services\cabinet\WishListService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class WishlistController extends Controller
{
    public $layout = 'cabinet';
    private $service;
    private $products;

    public function __construct($id, $module, WishlistService $service, ProductReadRepository $products, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->products = $products;
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
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = $this->products->getWishList(\Yii::$app->user->id);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionAdd($id)
    {
        try {
            $this->service->add(Yii::$app->user->id, $id);
            Yii::$app->session->setFlash('success', 'Success!');
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }


    public function actionAddAjax($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if(\Yii::$app->request->isAjax){

                $this->service->add(Yii::$app->user->id, $id);
                return WishlistWidget::widget();



        }

    }


    /**
     * @param $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove(Yii::$app->user->id, $id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionDeleteAjax($id)
    {
        if(\Yii::$app->request->isAjax){
            //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            try {
                $this->service->remove(Yii::$app->user->id, $id);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

        }

    }
}