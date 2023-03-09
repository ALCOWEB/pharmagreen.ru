<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 06.08.2020
 * Time: 22:07
 */

namespace backend\forms\Shop;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\Shop\Product\Review;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use shop\helpers\ProductHelper;
use shop\entities\Shop\Product\Product;

class ReviewSearch extends Model
{
    public $id;
    public $created_at;
    public $user_id;
    public $product_id;
    public $vote;
    public $text;
    public $active;

    public function rules()
    {
        return [
            [['id', 'user_id', 'vote', 'product_id'], 'integer'],
            [['text', 'created_at', 'active'], 'safe']
        ];

    }

    public function search($params){
        $query = Review::find()->with('product');
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'key' => function (Review $review) {
                    return [
                        'product_id' => $review->product_id,
                        'review_id' => $review->id,
                    ];
                },
                'sort' => [
                    'defaultOrder' => ['id' => SORT_DESC]
                ],
            ]);

        $this->load($params);
        if (!$this->validate()){
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'vote' => $this->vote,
            'active' => $this->active,
        ]);
        return $dataProvider;
    }

    public function productList(): array
    {
        return ArrayHelper::map(Product::find()->innerJoin('shop_reviews', 'shop_products.id = shop_reviews.product_id')->asArray()->all(), 'id', function (array $product) {
        return $product['name'];
    });



    }
    public function statusList(): array
    {
        return ProductHelper::statusList();
    }

}