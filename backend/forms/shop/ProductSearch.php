<?php
namespace backend\forms\Shop;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use shop\helpers\ProductHelper;
use shop\entities\Shop\Category;
use yii\data\ActiveDataProvider;
use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Product;
class ProductSearch extends Model
{
    public $id;
    public $code;
    public $name;
    public $category_id;
    public $brand_id;
    public $status;
    public $quantity;
    public $new;
    public $sale;
    public $storon;
    public $price;
    public $priceRange;



    public function rules(): array
    {
        return [
            [['id', 'category_id', 'brand_id', 'status', 'quantity', 'new', 'sale',], 'integer'],
            [['code', 'name', 'storon', 'price'], 'safe'],
        ];
    }
    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function  search(array $params, $query = null): ActiveDataProvider
    {   
        if ($query == null){
            $query = Product::find()->with('mainPhoto', 'category');
        }
        $query->joinWith(['values'])->distinct();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['p.id' => SORT_ASC],
                        'desc' => ['p.id' => SORT_DESC],
                    ],
                    'name' => [
                        'asc' => ['p.name' => SORT_ASC],
                        'desc' => ['p.name' => SORT_DESC],
                    ],
                    'price' => [
                        'asc' => ['p.price_new' => SORT_ASC],
                        'desc' => ['p.price_new' => SORT_DESC],
                    ],
                    'rating' => [
                        'asc' => ['p.rating' => SORT_ASC],
                        'desc' => ['p.rating' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => [
                'pageSizeLimit' => [3, 100],
                'defaultPageSize' => 3
            ]
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'new' => $this->new,
            'sale' => $this->sale,
            'shop_values.value' => $this->storon,
        ]);
        $low = Product::find()->select(['price_new'])->orderBy(['price_new' => SORT_ASC])->one();
        $max = Product::find()->select(['price_new'])->orderBy(['price_new' => SORT_DESC])->one();
        $this->priceRange = [$low->price_new,  $max->price_new];
        $price = isset($this->price) ? explode(' - ', $this->price): 
        [ 
            $low->price_new
            ,
            
            $max->price_new
        ];
      
        $this->price = implode(' - ', $price);
     
        $query
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['between', 'price_new', $price[0], $price[1]]);
        return $dataProvider;
    }
    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }
    public function statusList(): array
    {
        return ProductHelper::statusList();
    }


    public function NewList(): array
    {
        return [0 => 'standart', 1 => 'new' ];
    }
    public function Saleist(): array
    {
        return [0 => 'standart', 1 => 'Sale' ];
    }
}


