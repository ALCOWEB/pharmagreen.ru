<?php

/* @var $cart \shop\cart\Cart */

use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<a href="javascript:void(0)"><span class="lnr lnr-cart"></span><span class="item_count"><?php echo $cart->getAmount(); ?></span></a>

<div class="mini_cart">
    <div class="cart_gallery">
        <div class="cart_close">
            <div class="cart_text">
                <h3>Корзина</h3>
            </div>
            <div class="mini_cart_close">
                <a href="javascript:void(0)"><i class="icon-x"></i></a>
            </div>
        </div>

        <?php foreach ($cart->getItems() as $item): ?>
            <?php
            $product = $item->getProduct();
            $modification = $item->getModification();
            $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
            ?>
            <div class="cart_item">
                <div class="cart_img">
                    <?php if ($product->mainPhoto): ?>
                    <a href="#"> <img src="<?= $product->mainPhoto->getThumbFileUrl('file', 'cart_widget_list') ?>" alt="" /></a>
                    <?php endif; ?>

                </div>
                <div class="cart_info">
                    <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                    <?php if ($modification): ?>
                        <br/><small><?= Html::encode($modification->name) ?></small>
                    <?php endif; ?>
                    <p><?= $item->getQuantity() ?> x <span> <?= PriceHelper::format($item->getCost()) ?> </span></p>
                </div>
                <div class="cart_remove">
                    <a href="<?= Url::to(['/shop/cart/remove', 'id' => $item->getId()]) ?>" title="Remove" class="" data-method="post"><i class="icon-x"></i></a>

                </div>
            </div>

        <?php endforeach ?>

    </div>
    <?php $cost = $cart->getCost(); ?>
    <div class="mini_cart_table">
        <div class="cart_table_border">
            <div class="cart_total">
                <span>Итого:</span>
                <span class="price"><?= PriceHelper::format($cost->getOrigin()) ?></span>
            </div>
            <div class="cart_total mt-10">
                <span>Итого со скидкой:</span>
                <span class="price"><?= PriceHelper::format($cost->getTotal()) ?></span>
            </div>
        </div>
    </div>
    <div class="mini_cart_footer">
        <div class="cart_button">
            <a href="<?= Url::to(['/shop/cart/index']) ?>"><i class="fa fa-shopping-cart"></i> Посмотреть корзину</a>
        </div>
        <div class="cart_button">
            <a href="<?= Url::to(['/shop/checkout/index']) ?>"><i class="fa fa-sign-in"></i> Оформить заказ</a>
        </div>

    </div>
</div>



