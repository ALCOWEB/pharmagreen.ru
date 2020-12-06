<?php

/* @var $this yii\web\View */

use shop\entities\Shop\Product\Product;
use shop\helpers\PriceHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Список желаний';
$this->params['breadcrumbs'][] = ['label' => 'Cabinet', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">


    <!--wishlist area start -->
    <div class="wishlist_area mt-70">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc wishlist">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product_remove">Удалить</th>
                                        <th class="product_thumb">Изображение</th>
                                        <th class="product_name">Наименование</th>
                                        <th class="product-price">Цена</th>
                                        <th class="product_quantity">Наличие</th>
                                        <th class="product_total">Добавить в корзину</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($dataProvider->models as $model):?>
                                    <tr>
                                        <td class="product_remove">
                                            <?= Html::a('X', Url::to(['/cabinet/wishlist/delete', 'id' => $model->id]), ['data-method' => 'post', 'title' => 'Удалить', ]) ?>
                                        </td>
                                        <td class="product_thumb"><a class="primary_img" href="<?= Html::encode(Url::to(['shop/catalog/product', 'id' => $model->id])) ?>">
                                                <img src="<?= Html::encode($model->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?>" alt=""/>
                                            </a></td>
                                        <td class="product_name"><a href="<?= Html::encode(Url::to(['shop/catalog/product', 'id' => $model->id])) ?>"><?= $model->name ?></a></td>
                                        <td class="product-price"><?= PriceHelper::format($model->price_new) ?></td>
                                        <td class="product_quantity"><?php echo $model->isAvailable() == true ? 'на складе': 'нет на складе'; ?></td>
                                        <td class="product_total"><?= Html::a('Добавить в корзину', Url::to(['/shop/cart/add', 'id' => $model->id]), ['data-method' => 'post', 'title' => 'Добавить в корзину','class' => 'add_to_cart_link']) ?></td>


                                    </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


            <div class="row">
                <div class="col-12">
                    <div class="wishlist_share">
                        <h4>Share on:</h4>
                        <ul>
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                            <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
    <!--wishlist area end -->

</div>