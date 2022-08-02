<?php
namespace frontend\controllers\shop;
use shop\forms\Shop\AddToCartForm;
use shop\forms\Shop\ReviewForm;
use shop\forms\Shop\Search\SearchForm;
use shop\readModels\Shop\BrandReadRepository;
use shop\readModels\Shop\CategoryReadRepository;
use shop\readModels\Shop\ProductReadRepository;
use shop\readModels\Shop\TagReadRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use shop\services\manage\Shop\ReviewManageService;
use backend\forms\Shop\ProductSearch;
use shop\entities\Shop\Product\Product;
use shop\forms\manage\Shop\Product\PanelCalcForm;
use shop\services\Shop\LightPanelPriceService;
use shop\repositories\Shop\CharacteristicRepository;
use shop\repositories\Shop\MaterialsRepository;
use shop\repositories\Shop\ProductRepository;
use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Category;
use yii\helpers\ArrayHelper;
use yii;
class CatalogController extends Controller
{
    public $layout = 'catalog';
    private $products;
    private $categories;
    private $brands;
    private $tags;
    private $reviewManageService;
    public function __construct(
        $id,
        $module,
        ProductReadRepository $products,
        CategoryReadRepository $categories,
        BrandReadRepository $brands,
        TagReadRepository $tags,
        ReviewManageService $reviewManageService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->categories = $categories;
        $this->brands = $brands;
        $this->tags = $tags;
        $this->reviewManageService = $reviewManageService;
    }
    /**
     * @return mixed
     */

    public function actionCalculator()
    { 
        
        $service = new LightPanelPriceService(new ProductRepository, new MaterialsRepository, new CharacteristicRepository);
        $product = new Product();
        $form = new PanelCalcForm();
       // $service->calcPrice($product);
        $characteristics = Characteristic::find()->all();
        $charMap = ArrayHelper::map($characteristics, function($characteristic){ return $characteristic->id;}, function($characteristic){ return $characteristic->slug;});
       // var_dump($charMap);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
          $product->category_id = Category::find()->where(['name'=>$form->category])->one()->id; 
          foreach (get_object_vars($form) as $key => $value) {
            $id = array_search($key, $charMap); 
            if($id != null){
                echo $id . '=' . $value.'</br>';
                $product->setValue($id, $value);
            }
           // var_dump($product);

         //sss   var_dump($characteristics);    
                 
              //   $product->setValue($id, $value);     
                    
          }
               $service->calcPrice($product);
               var_dump($product->price_new);
        }
               
                return $this->render('calc', [
                    'form' => $form
                ]);
          
        
        return $this->render('calc', [
            'form' => $form
        ]);

    }
    
    
    public function actionIndex()
    { 
        $searchModel = new ProductSearch();
        $query = Product::find()->alias('p')->with('mainPhoto', 'category', 'photos', 'modifications');
        //->active('p')
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);
       // $dataProvider = $this->products->getAll();
       // $dataProvider = $this->products->search($searchModel);
        $category = $this->categories->getRoot();
        //$this->view->params['search'] = $searchModel;
        return $this->render('index', [
            'search' => $searchModel,
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCategory($id)
    {
        if (!$category = $this->categories->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $searchModel = new ProductSearch();
        $query = Product::find()->alias('p')->with('mainPhoto', 'photos', 'modifications')->joinWith(['category'], false)->where(['p.category_id' => $id]);
        
        //->active('p')
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);
        //$dataProvider = $this->products->getAllByCategory($category);
        return $this->render('category', [
            'search' => $searchModel,
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionBrand($id)
    {
        if (!$brand = $this->brands->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByBrand($brand);
        return $this->render('brand', [
            'brand' => $brand,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionTag($id)
    {
        if (!$tag = $this->tags->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByTag($tag);
        return $this->render('tag', [
            'tag' => $tag,
            'dataProvider' => $dataProvider,
        ]);

    }
    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionProduct($id)
    {
        if (!$product = $this->products->find_with_reviews($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $reviews = $product->getReviews()->with('user')->all();
        $this->layout = 'blank';
        $cartForm = new AddToCartForm($product);
        $reviewForm = new ReviewForm();

        if ($reviewForm->load(Yii::$app->request->post()) && $reviewForm->validate()) {
            try {
                $this->reviewManageService->create($product->id, Yii::$app->user->id, $reviewForm);
                return $this->redirect(Yii::$app->request->referrer);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('product', [
            'reviews' => $reviews,
            'product' => $product,
            'cartForm' => $cartForm,
            'reviewForm' => $reviewForm,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionSearch()
    {
        $form = new SearchForm();
        $form->load(\Yii::$app->request->queryParams);
        $form->validate();
        $dataProvider = $this->products->search($form);
        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'searchForm' => $form,
        ]);
    }
}