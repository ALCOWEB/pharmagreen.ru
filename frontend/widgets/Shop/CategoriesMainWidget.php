<?php
namespace frontend\widgets\Shop;
use shop\entities\Shop\Category;
use shop\readModels\Shop\CategoryReadRepository;
use yii\base\Widget;
use yii\helpers\Html;
class CategoriesMainWidget extends Widget
{
    /** @var Category|null */
    public $active;
    private $categories;
    public function __construct(CategoryReadRepository $categories, $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;

    }
    public function run(): string
    {

        return $this->render('categoriesMain', [
            'categories' => $this->categories,
            'active' => $this->active
        ]);

    }
}