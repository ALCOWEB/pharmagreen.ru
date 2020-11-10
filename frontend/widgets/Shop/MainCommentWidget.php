<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 19.07.2020
 * Time: 20:07
 */

namespace frontend\widgets\Shop;

use shop\readModels\Blog\PostReadRepository;
use yii\base\Widget;
use shop\entities\Shop\Product\Review;
use shop\entities\User\User;

class MainCommentWidget extends Widget
{

    public $limit;
    public $repository;
    public $product_ids;
    public $review_ids;

    public function __construct($config = [])
    {
        parent::__construct($config);

    }

    public function run(): string
    {

        $reviews = Review::find()->where(['in', 'id', $this->review_ids])->with('user', 'product', 'photo')->all();
        return $this->render('mainComment', [
            'reviews' =>  $reviews,
            ]);



    }

}