<?php

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */
/* @var $cartForm shop\forms\Shop\AddToCartForm */
/* @var $reviewForm shop\forms\Shop\ReviewForm */

use frontend\assets\MagnificPopupAsset;
use shop\helpers\PriceHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use shop\entities\User\User;
use yii\widgets\DetailView;
use shop\entities\Shop\Product\Value;
$this->title = $product->name;

$this->registerMetaTag(['name' =>'description', 'content' => $product->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $product->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
foreach ($product->category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ['category', 'id' => $product->category->id]];
$this->params['breadcrumbs'][] = $product->name;

$this->params['active_category'] = $product->category;


?>



<!--product details start-->
<div class="product_details mt-70 mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <?php if (isset($product->photos[0])): ?>

                            <img id="zoom1" src="<?= $product->photos[0]->getThumbFileUrl('file', 'catalog_product_main_500') ?>" alt="<?= Html::encode($product->name) ?>">

                            <?php
                            endif; ?>

                    </div>
                    <div class="single-zoom-thumb">
                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                            <?php foreach ($product->photos as $i => $photo): ?>

                <li>
                    <a class="elevatezoom-gallery" href="#"  data-image="<?= $photo->getThumbFileUrl('file', 'catalog_product_main_500') ?>">
                        <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>" alt="" />
                    </a>
                </li>

                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product_d_right">


                        <h1><?= Html::encode($product->name);?></h1>

                        <div class=" product_ratting">
                            <ul>
                                <li><a href="#"><i class="<?php  echo ceil($product->rating) >= 1 ? 'fa fa-star' : 'fa fa-star-o'?>"></i></a></li>
                                <li><a href="#"><i class="<?php  echo ceil($product->rating) >= 2 ? 'fa fa-star' : 'fa fa-star-o'?>"></i></a></li>
                                <li><a href="#"><i class="<?php  echo ceil($product->rating) >= 3 ? 'fa fa-star' : 'fa fa-star-o'?>"></i></a></li>
                                <li><a href="#"><i class="<?php  echo ceil($product->rating) >= 4 ? 'fa fa-star' : 'fa fa-star-o'?>"></i></a></li>
                                <li><a href="#"><i class="<?php  echo ceil($product->rating) >= 5 ? 'fa fa-star' : 'fa fa-star-o'?>"></i></a></li>
                                <li class="review">   <a href="" onclick="$('a[href=\'#reviews\']').trigger('click'); $('html, body').animate({scrollTop: $('#reviews').offset().top }, 1500); return false;">
                                        отзывов: <?= count($product->reviews); ?></a> / <a href="" onclick="$('a[href=\'#reviews\']').trigger('click'); $('html, body').animate({scrollTop: $('#reviews').offset().top }, 1500); return false;">Написать отзыв</a></p></li>

                            </ul>
                        </div> 
                        
                        <div class="price_box">
                            <span class="current_price"><?= PriceHelper::format($product->price_new) ?></span>
                            <span class="old_price"><?= PriceHelper::format($product->price_old) ?></span>

                        </div>
                        <div class="product_desc">
                            <p><?= Yii::$app->formatter->asNtext($product->short_desc) ?></p>
                        </div>
                        <div class="product_variant color">
                 



                            <?php $form = ActiveForm::begin([

                                'action' => ['/shop/cart/ajax-add', 'id' => $product->id],
                                'options' => ['class' => 'add_to_cart_form'],
                            ]) ?>

                            <?php if ($modifications = $cartForm->modificationsList()): ?>
                                <h3 style="margin-bottom:15px;">Доступные модификации:</h3>
        
                                <?= $form->field($cartForm, 'modification')->dropDownList($modifications, ['prompt' => 'Выбрать опцию', 'encode' => false,'class' => 'form-control modification-select'])->label(false) ?>
                                <!-- <?= $form->field($cartForm, 'modification')->radioList($modifications)->label(false) ?> -->
                                <!-- <?= $form->field($cartForm, 'modification')->checkboxList($modifications);?> -->
                            <?php endif; ?>
                            <div class="quantity_inner">
                                
                                    <?= $form->field($cartForm, 'quantity', ['template' => "<button class='btn-qty bt_minus'>-</button>{input}<button class='btn-qty bt_plus'>+</button>\n{error}",  'options' => [
                                        'tag' => false, // Don't wrap with "form-group" div
                                    ],])->input('number', ['min' => 1, 'class' => 'input-quantity']) ?>
                                
                            </div>
                            <div class="product_variant quantity">
                                <!-- <label>Колличество</label> -->
                               
                                <?= Html::submitButton('Добавить в корзину', ['class' => 'button']) ?>
                
                            </div>
                            <?php ActiveForm::end() ?>
                            <strong>Вы так же можете отправить заявку на почту info@calligrafm.ru</strong>
                        </div>

                        <div class=" product_d_action">
                            <ul>
                                <li><?= Html::a('<span class="lnr lnr-heart"></span>&nbsp;Добавить в список желаний', Url::to(['/cabinet/wishlist/add', 'id' => $product->id]), ['data-method' => 'post', 'title' => 'Добавить в список желаний', 'class' => 'add_to_wish_list_link', 'data-product-id' => $product->id]) ?></li>

                            </ul>
                        </div>
                        <div class="product_meta">
                            <span>Категория: <a href="<?= Html::encode(Url::to(['/shop/catalog/category', 'id' =>$product->category->id])) ?>"><?= Html::encode($product->category->name)?></a></span>
                        </div>
<!---->
<!--                    <div class="priduct_social">-->
<!--                        <ul>-->
<!--                            <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i> Like</a></li>-->
<!--                            <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>-->
<!--                            <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> save</a></li>-->
<!--                            <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i> share</a></li>-->
<!--                            <li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i> linked</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->

                </div>
                <div class="row">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button">
                        <ul class="nav" role="tablist">
                            <li >
                                <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Описание</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Характеристики</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Отзывы&nbsp;(<?= count($product->reviews);?>) </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info" role="tabpanel" >
                            <div class="product_info_content">
                                <?= $product->description ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sheet" role="tabpanel" >
                            <div class="product_info_content">
                                  <?= DetailView::widget([
                                        'model' => $product,
                                        'attributes' => array_map(function (Value $value) {
                                            return [
                                                'label' => $value->characteristic->name,
                                                'value' => $value->value,
                                            ];
                                        }, $product->values),
                                    ]) ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" >

                            <div class="reviews_wrapper">

                               <?php foreach ($reviews as $review): ?>

                                <div class="reviews_comment_box">
                                    <div class="comment_thmb">


                                        <img src="<?= $review->user->photo ? $review->user->photo->getThumbFileUrl('file', 'admin'): ''?>" alt="">
                                    </div>
                                    <div class="comment_text">

                                        <div class="reviews_meta">
                                            <div class="star_rating">
                                                <ul>
                                                    <li><a href="#"><i class="<?php  echo ceil($review->vote) >= 1 ? 'fa fa-star' : 'fa fa-star-o'?>"></i></a></li>
                                                    <li><a href="#"><i class="<?php  echo ceil($review->vote) >= 2 ? 'fa fa-star' : 'fa fa-star-o'?>"></i></a></li>
                                                    <li><a href="#"><i class="<?php  echo ceil($review->vote) >= 3 ? 'fa fa-star' : 'fa fa-star-o'?>"></i></a></li>
                                                    <li><a href="#"><i class="<?php  echo ceil($review->vote) >= 4 ? 'fa fa-star' : 'fa fa-star-o'?>"></i></a></li>
                                                    <li><a href="#"><i class="<?php  echo ceil($review->vote) >= 5 ? 'fa fa-star' : 'fa fa-star-o'?>"></i></a></li>
                                                </ul>
                                            </div>
                                            <p><strong><?= $review->text?> </strong><?= Yii::$app->formatter->asDatetime($review->created_at) ?></p>
                                            <span><?= User::findIdentity($review->user_id)->username ?  User::findIdentity($review->user_id)->username:'неизвестно';?></span>
                                        </div>
                                    </div>

                                </div>

                               <?php  endforeach ?>

                                <h2>Напшите отзыв</h2>

                                <?php if (Yii::$app->user->isGuest): ?>

                                    <div class="panel-panel-info">
                                        <div class="panel-body">
                                            Пожалуйста, <?= Html::a('войдите', ['/auth/auth/login']) ?> чтобы написать отзыв.
                                        </div>
                                    </div>

                                <?php else: ?>



                                    <?php $form = ActiveForm::begin(['id' => 'form-review']) ?>
                                    <div class="product_review_form">



                                            <div class="row">
                                                <div class="col-12">

                                                    <?= $form->field($reviewForm, 'vote')->dropDownList($reviewForm->votesList(), ['prompt' => '--- Выбрать ---'])->label('Рейтинг') ?>
                                                </div>
                                                <div class="col-12">


                                                    <?= $form->field($reviewForm, 'text')->textarea(['rows' => 5])->label('Ваш отзыв') ?>
                                                </div>
                                            </div>

                                        <?= Html::submitButton('Отправить', ['class' => '']) ?>

                                    </div>


                                    <?php ActiveForm::end() ?>

                                <?php endif; ?>
                            </div>


                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!--product details end-->

<!--product info start-->
<!-- <div class="product_d_info mb-65">
    <div class="container">
        
        </div>
    </div> -->
<!--product info end-->
