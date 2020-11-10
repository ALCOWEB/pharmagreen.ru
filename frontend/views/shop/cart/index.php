<?php

/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */

use shop\helpers\PriceHelper;
use yii\helpers\Html;
use shop\helpers\WeightHelper;
use yii\helpers\Url;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="cabinet-index">


        <div class="shopping_cart_area mt-70">

            <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="table_desc">
                                <?= Html::beginForm(['quantityall', 'ids' => $cart->getItemsIds()]); ?>
                                <div class="cart_page table-responsive">


                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="product_remove">Удалить</th>
                                            <th class="product_thumb">Изображение</th>
                                            <th class="product_name">Товар</th>
                                            <th class="product_name">Модель</th>
                                            <th class="product-price">Цена</th>
                                            <th class="product_quantity">Кол-во</th>
                                            <th class="product_total">Цена</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                    <?php foreach ($cart->getItems() as $item): ?>

                                        <?php
                                        $product = $item->getProduct();
                                        $modification = $item->getModification();
                                        $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                                        ?>
                                        <tr>
                                            <td class="product_remove"><a title="Удалить" class="" href="<?= Url::to(['remove', 'id' => $item->getId()]) ?>" data-method="post"><i class="fa fa-trash-o"></i></a></td>
                                            <td class="product_thumb">   <a href="<?= $url ?>">
                                                    <?php if ($product->mainPhoto): ?>
                                                        <img src="<?= $product->mainPhoto->getThumbFileUrl('file', 'cart_list') ?>" alt="" class="" />
                                                    <?php endif; ?>
                                                </a></td>
                                            <td class="product_name"><a href="<?= $url ?>"><?= $product->name ?></a></td>
                                            <td class="text-left">
                                                <?php if ($modification): ?>
                                                    <?= Html::encode($modification->name) ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="product-price"><?= PriceHelper::format($item->getPrice()) ?></td>
                                            <td class="product_quantity">

                                                <div class="input-group btn-block" style="max-width: 200px;">
                                                    <input type="text" name="<?='quantity_'.$item->getId()?>" value="<?= $item->getQuantity() ?>" size="1" class="form-control" />

                                                </div>
                                                </td>
                                            <td class="product_total"><?= PriceHelper::format($item->getCost()) ?></td>
                                        </tr>
                                    <?php endforeach; ?>

                                        </tbody>
                                    </table>


                                </div>
                                <div class="cart_submit">
                                    <button type="submit">Обновить корзину</button>
                                </div>
                                <?= Html::endForm() ?>
                            </div>
                        </div>
                    </div>
                    <!--coupon code area start-->
                    <div class="coupon_area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">

                                <div class="coupon_inner left" style="padding: 0px;">
                                    <?= Html::a('Продолжить покупки',  Yii::$app->request->referrer, ['class' => 'btn btn-success'] )?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <?php $cost = $cart->getCost() ?>
                                <div class="coupon_code right">
                                    <h3>Цена корзины</h3>
                                    <div class="coupon_inner">
                                        <div class="cart_subtotal">
                                            <p>Цена без скидки</p>
                                            <p class="cart_amount"><?= PriceHelper::format($cost->getOrigin()) ?></p>
                                        </div>

                                        <?php foreach ($cost->getDiscounts() as $discount): ?>
                                            <div class="cart_subtotal">
                                                <p><?= Html::encode($discount->getName()) ?></p>
                                                <p class="cart_amount"><?= PriceHelper::format($discount->getValue()) ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="cart_subtotal ">
                                            <p>Вес</p>

                                            <p class="cart_amount"><?= WeightHelper::format($cart->getWeight()) ?></p>
                                        </div>
                                       <div style="margin-bottom: 20px;border-bottom: 1px solid #ededed;"></div>

                                        <div class="cart_subtotal">
                                            <p>Итого</p>
                                            <p class="cart_amount"><?= PriceHelper::format($cost->getTotal()) ?></p>
                                        </div>
                                        <div class="buttons clearfix">
                                            <?php if ($cart->getItems()): ?>
                                                <div class="pull-right"><a href="<?= Url::to('/shop/checkout/index') ?>" class="btn btn-success">Оформить заказ</a></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--coupon code area end-->
            </div>
        </div>
        <!--shopping cart area end -->


    </div>

<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 21.05.2020
 * Time: 14:04
 */