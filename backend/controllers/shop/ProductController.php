<?php
namespace backend\controllers\shop;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\httpclient\Client;
use yii\filters\VerbFilter;
use shop\PanelList\PanelList;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use backend\forms\shop\ProductSearch;
use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Product\Modification;
use shop\forms\manage\Shop\Product\PriceForm;
use shop\forms\manage\Shop\Product\PhotosForm;
use shop\services\Shop\LightPanelPriceService;
use shop\forms\manage\Shop\Product\QuantityForm;
use shop\forms\manage\Shop\Product\ProductEditForm;
use shop\services\manage\Shop\ProductManageService;
use shop\forms\manage\Shop\Product\ProductCreateForm;

class ProductController extends Controller
{
    private $service;
    public $lpService;
    public function __construct($id, $module, ProductManageService $service, LightPanelPriceService $lpService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->lpService = $lpService;
        
    }
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'activate' => ['POST'],
                    'draft' => ['POST'],
                    'delete-photo' => ['POST'],
                    'move-photo-up' => ['POST'],
                    'move-photo-down' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddPhotoBatch()
    {  
        $productSearch = new ProductSearch();
        $dataProvider = $productSearch->search(Yii::$app->request->queryParams);
        $products = $dataProvider->getModels();
        $photosForm = new PhotosForm();
        if ($photosForm->load(Yii::$app->request->post()) && $photosForm->validate()) {
            foreach($products as $product){
                try {
                    $this->service->addPhotosBatch($product, $photosForm, false);
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }
            return $this->redirect(['index']);
        }

        return $this->render('addPhotoBatch', [
            'products' => $products,
            'dataProvider' => $dataProvider,
            'searchModel' => $productSearch,
            'photosForm' => $photosForm
        ]);


    }
    /**-
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $product = $this->findModel($id);
        $modificationsProvider = new ActiveDataProvider([
            'query' => $product->getModifications()->orderBy('name'),
            'key' => function (Modification $modification) use ($product) {
                return [
                    'product_id' => $product->id,
                    'id' => $modification->id,
                ];
            },
            'pagination' => false,
        ]);
        $photosForm = new PhotosForm();
        if ($photosForm->load(Yii::$app->request->post()) && $photosForm->validate()) {
           //var_dump($photosForm);
            try {
                $this->service->addPhotos($product->id, $photosForm);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('view', [
            'product' => $product,
            'modificationsProvider' => $modificationsProvider,
            'photosForm' => $photosForm,
        ]);
    }
    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ProductCreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $product = $this->service->create($form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionCreateFromList()
    {  
        $list = new PanelList;
        
        foreach ($list->makeCrystalNasten() as $panel){
           $this->service->createFromList($panel); 
        }
        foreach ($list->makeCrystalPodves1s() as $panel){
            $this->service->createFromList($panel); 
         }
        foreach ($list->makeCrystalPodves2s() as $panel){
            $this->service->createFromList($panel); 
        }
        foreach ($list->makeFramelNasten() as $panel){
            $this->service->createFromList($panel); 
         }
        foreach ($list->makeFramelPodves1s() as $panel){
            $this->service->createFromList($panel); 
        }
        foreach ($list->makeFramelPodves2s() as $panel){
            $this->service->createFromList($panel); 
        }
        foreach ($list->makeMagnetNasten() as $panel){
            $this->service->createFromList($panel); 
         }
        foreach ($list->makeMagnetPodves1s() as $panel){
            $this->service->createFromList($panel); 
        }
        foreach ($list->makeMagnetPodves2s() as $panel){
            $this->service->createFromList($panel); 
        }
    }

    public function actionChangePrice(){
        $products = Product::find()->all();
       //var_dump($product->getValue(4));
       foreach($products as $product){
        $this->lpService->calcPrice($product);
        $product->save();
       }  
    }
    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);
        $form = new ProductEditForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'product' => $product,
        ]);
    }
    /**
     * @param integer $id
     * @return mixed
     */
    public function actionPrice($id)
    {
        $product = $this->findModel($id);
        $form = new PriceForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->changePrice($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('price', [
            'model' => $form,
            'product' => $product,
        ]);
    }
    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionQuantity($id)
    {
        $product = $this->findModel($id);

        $form = new QuantityForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->changeQuantity($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('quantity', [
            'model' => $form,
            'product' => $product,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionActivate($id)
    {
        try {
            $this->service->activate($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionNew($id)
    {
        try {
            $this->service->new($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }
    public function actionNotNew($id)
    {
        try {
            $this->service->notNew($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionSale($id)
    {
        try {
            $this->service->sale($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }
    public function actionNotSale($id)
    {
        try {
            $this->service->notSale($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }
    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDraft($id)
    {
        try {
            $this->service->draft($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionDeletePhoto($id, $photo_id)
    {
        try {
            $this->service->removePhoto($id, $photo_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }
    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionMovePhotoUp($id, $photo_id)
    {
        $this->service->movePhotoUp($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }
    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionMovePhotoDown($id, $photo_id)
    {
        $this->service->movePhotoDown($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }
    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Product
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}