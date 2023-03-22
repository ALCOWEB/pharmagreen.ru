<?php

namespace backend\controllers\shop;

use Yii;
use shop\entities\Shop\Materials;
use backend\forms\shop\MaterialSearch;
use shop\forms\Shop\Materials as MaterialsForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AddressController implements the CRUD actions for Address model.
 */
class MaterialsController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

 
    public function actionIndex()
    {
        $searchModel = new MaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

 
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

 
    public function actionCreate()
    {
        $model = new MaterialsForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $materials = Materials::create($model);
            $materials->save();
            return $this->redirect(['view', 'id' => $materials->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $materials = $this->findModel($id);
        $form = new MaterialsForm;

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $materials->edit($form);
            $materials->save();
            return $this->redirect(['view', 'id' => $materials->id]);
        }

        return $this->render('edit', [
            'materials' => $materials,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Materials::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
