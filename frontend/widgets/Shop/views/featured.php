<?php
/** @var $products shop\entities\Shop\Product\Product[] */
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use shop\forms\Shop\AddToCartForm;
use yii\widgets\ActiveForm;
?>


<!--product area start-->
<div class="product_area mb-65">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <p>список рекомендуемых товаров</p>
                    <h2>Рекомендуемые товары</h2>
                </div>
            </div>
        </div>
        <div class="product_container">
            <div class="row">
                <div class="col-12">
                    <div class="product_carousel product_column5 owl-carousel">
                        <?php foreach ($products as $product):?>
                            <?php $url = Url::to(['/shop/catalog/product', 'id' =>$product->id]); ?>
                            <?php $category_url = Url::to(['/shop/catalog/category', 'id' =>$product->category->id]); ?>
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <?php if ($product->mainPhoto): ?>
                                            <a class="primary_img" href="<?= Html::encode($url) ?>">
                                                <img src="<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?>" alt=""/>
                                            </a>

                                        <a  class="secondary_img" href="<?= Html::encode($url) ?>">
                                            <img src="<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?>" alt=""/>
                                        </a>
                                    <?php endif; ?>

                                    <div class="label_product">
                                        <?= $product->sale ? '<span class="label_sale">Скидка</span>' : ''?>
                                        <?= $product->new ? '<span class="label_new">Новинка</span>' : ''?>
                                    </div>
                                    <div class="action_links">
                                        <ul>
                                            <li class="add_to_cart">
                                                <?= Html::a('<span class="lnr lnr-cart"></span>', '#', ['data-method' => 'post', 'title' => 'Добавить в корзину','class' => 'add_to_cart_link', 'data-product-id' => $product->id ]) ?>
                                            </li>
                                            <li class="quick_button"><a href="#" data-toggle="modal" data-target="#modal_box<?= $product->id;?>"  title="Быстрый просмотр"> <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist">
                                                <?= Html::a('<span class="lnr lnr-heart"></span>', "#", ['data-method' => 'post', 'title' => 'Добавить в список желаний', 'class' => 'add_to_wish_list_link', 'data-product-id' => $product->id]) ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <h4 class="product_name"><a href="<?= Html::encode($url) ?>"><?= Html::encode($product->name) ?></a></h4>
                                    <p><a href="<?= Html::encode($category_url) ?>"><?= Html::encode($product->category->name) ?></a></p>
                                    <div class="price_box">

                                            <span class="current_price"><?= PriceHelper::format($product->price_new) ?></span>
                                            <?php if ($product->price_old): ?>
                                                <span class="old_price"><?= PriceHelper::format($product->price_old) ?></span>
                                            <?php endif; ?>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>


                            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product area end-->

<?php foreach ($products as $product):?>


<!-- modal area start-->
<div class="modal fade" id="modal_box<?= $product->id;?>" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="icon-x"></i></span>
            </button>
            <div class="modal_body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="modal_tab">
                                <div class="tab-content product-details-large">
                                    <?php foreach ($product->photos as $i => $photo): ?>
                                        <div class="tab-pane fade <?php if($i == 0){echo 'active';}?>" id="tab<?=$i?>" role="tabpanel" >
                                            <div class="modal_tab_img">
                                                <a href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>"><img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>" alt=""></a>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>

                                </div>
                                <div class="modal_tab_button">
                                    <ul class="nav product_navactive owl-carousel" role="tablist">
                                        <?php foreach ($product->photos as $i => $photo): ?>
                                            <li >
                                                <a class="nav-link active" data-toggle="tab" href="#tab<?=$i?>" role="tab" aria-controls="tab<?=$i?>" aria-selected="false"><img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>" alt=""></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="modal_right">
                                <div class="modal_title mb-10">
                                    <h2><?= Html::encode($product->name);?></h2>
                                </div>
                                <div class="modal_price mb-10">
                                    <span class="current_price"><?= PriceHelper::format($product->price_new) ?></span>
                                    <span class="old_price"><?= PriceHelper::format($product->price_old) ?></span>
                                </div>
                                <div class="modal_description mb-15">
                                    <p><?= $product->description ?></p>
                                </div>
                                <div class="variants_selects">

                                    <div class="modal_add_to_cart">


                                            <br>

                                            <?php $addToCartForm = new AddToCartForm($product)?>
                                            <?php $form = ActiveForm::begin([

                                                'action' => ['/shop/cart/ajax-add', 'id' => $product->id],
                                                'options' => ['class' => 'add_to_cart_form'],

                                            ]) ?>

                                            <?php if ($modifications = $addToCartForm->modificationsList()): ?>
                                                <h3>Доступные Модификации</h3>
                                                <?= $form->field($addToCartForm, 'modification')->dropDownList($modifications, ['prompt' => '--- Выбрать модификацию ---'])->label(false) ?>
                                            <?php endif; ?>

                                                <?= $form->field($addToCartForm, 'quantity', ['template' => "{input}\n{error}",  'options' => [
                                                    'tag' => false, // Don't wrap with "form-group" div
                                                ],])->input('number', ['style' => 'float:left']) ?>
                                                <?= Html::submitButton('Добавить в корзину', []) ?>

                                            <?php ActiveForm::end() ?>




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
<!-- modal area end-->
<?php endforeach;?>
