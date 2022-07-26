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
    public function actionIndex()
    { 
        $searchModel = new ProductSearch();
        $query = Product::find()->alias('p')->with('mainPhoto');
        //->active('p')
        $dataProvider = $searchModel->search(Yii::$app->request->post(), $query);
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
        $query = Product::find()->alias('p')->with('mainPhoto')->joinWith(['category'], false)->where(['p.category_id' => $id]);
        
        //->active('p')
        $dataProvider = $searchModel->search(Yii::$app->request->post(), $query);
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