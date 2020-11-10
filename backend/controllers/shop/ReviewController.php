<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 06.08.2020
 * Time: 21:45
 */
namespace backend\controllers\shop;
use Yii;
use yii\web\Controller;
use shop\services\manage\Shop\ReviewManageService;
use backend\forms\shop\ReviewSearch;
use shop\entities\Shop\Product\Review;
use shop\forms\manage\Shop\Product\ReviewEditForm;

class ReviewController extends Controller
{
    private $service;

    public function __construct(string $id, $module, ReviewManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex(){
        $searchModel = new ReviewSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionView($product_id, $review_id)
    {
        return $this->render('view', [
            'review' => $this->findModel($review_id),
        ]);
    }




    public function actionUpdate($product_id, $review_id)
    {
        $review = $this->findModel($review_id);
        $form = new ReviewEditForm($review);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($product_id, $review_id ,$form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'review' => $review,
        ]);
    }


    public function actionActivate($product_id, $review_id){
        try {
            $this->service->activate($product_id, $review_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'product_id' => $review_id, 'review_id' => $review_id]);

    }


    public function actionDraft($product_id, $review_id){
        try {
            $this->service->draft($product_id, $review_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'product_id' => $review_id, 'review_id' => $review_id]);

    }

    public function actionDelete($product_id, $review_id){
        try {
            $this->service->remove($product_id, $review_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);

    }

    protected function findModel($id): Review
    {
        if (($model = Review::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }


}