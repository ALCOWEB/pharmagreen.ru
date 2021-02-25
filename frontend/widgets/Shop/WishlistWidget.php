<?php

namespace frontend\widgets\Shop;

use yii\base\Widget;

class WishlistWidget extends Widget
{

    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function run(): string
    {
        return $this->render('wishlist');
    }
}