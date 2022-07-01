<?php
namespace backend\forms\Shop;
use shop\entities\Shop\Category;
use shop\helpers\ProductHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Product;
use yii\helpers\ArrayHelper;
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
    public function rules(): array
    {
        return [
            [['id', 'category_id', 'brand_id', 'status', 'quantity', 'new', 'sale'], 'integer'],
            [['code', 'name', 'storon'], 'safe'],
        ];
    }
    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Product::find()->with('mainPhoto', 'category');
        $query->joinWith(['values'])->distinct();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
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
        $query
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name]);
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


