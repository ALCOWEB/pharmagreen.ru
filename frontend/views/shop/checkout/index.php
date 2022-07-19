<?php

/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */
/* @var $model \shop\forms\Shop\Order\OrderForm */

use shop\helpers\PriceHelper;
use shop\helpers\WeightHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use frontend\assets\InnSearchAsset;

//InnSearchAsset::register($this);
$this->title = 'Оформить заказ';
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Shopping Cart', 'url' => ['/shop/cart/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="cabinet-index">







    <div class="Checkout_section mt-70">
        <div class="container">

            <div class="checkout_form">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">


                                <table>
                                    <thead>
                                    <tr>
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
                                                    <?= $item->getQuantity() ?>
                                            </td>
                                            <td class="product_total"><?= PriceHelper::format($item->getCost()) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php $cost = $cart->getCost() ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Итого:</td>
                                        <td><p class="cart_amount"><?= PriceHelper::format($cost->getTotal()) ?></p></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-lg-4 col-md-4">
                       <p style="font-weight: bold; font-size: 16px;text-transform: uppercase;margin-bottom: 5px;">Выберите тип плательщика:</p>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" style="width: 20px; height: 20px;" name="inlineRadioOptions" id="inlineRadio1" value="option1"  checked="checked">
                        <label class="form-check-label" for="inlineRadio1"><p>Юридическое лицо</p></label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" style="width: 20px; height: 20px;" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2"><p>Физическое лицо</p></label>
                        </div>
                    </div>
                </div>  
              
               
                <?php $formFiz = ActiveForm::begin(['id' => 'fizlico', 'options' => ['style' => 'display:none;']]) ?>
                <?php 
                    echo $formFiz->field($model->customer, 'inn')->hiddenInput(['value'=> 111])->label(false);
                    echo $formFiz->field($model->customer, 'companyName')->hiddenInput(['value'=> 'нет названия компании'])->label(false);
                    echo $formFiz->field($model->customer, 'urAddress')->hiddenInput(['value'=> 'нет юр.адреса'])->label(false);
                ?>
                <div class="row">
                    <div class="col-lg-4 col-md-4">

                            <h3>Данные покупателя</h3>
                            <div class="row">

                                <div class="col-lg-12 mb-20">

                                    <?= $formFiz->field($model->customer, 'name')->textInput()->label('Имя') ?>
                                </div>
                                

                                <div class="col-lg-12 mb-20">
                                    <?= $formFiz->field($model->customer, 'phone')->widget(MaskedInput::class, [
                                        'options' => ['id' => 'fizOrderMask'],
                                        'mask' => '+7 (999) 999 99 99',
                                    ])->textInput(['id' => 'fizOrderMask', 'placeholder' => '+7 (999) 999 99 99'])->label('Телефон');?>

                                </div>
                                <div class="col-lg-12 mb-20">
                                    <?= $formFiz->field($model->customer, 'email')->textInput()->label('E-mail') ?>

                                </div>



                                <div class="col-12">
                                    <div class="order-notes">
                                        <?= $formFiz->field($model, 'note')->textarea(['rows' => 3])->label('Комментарий к заказу')?>
                                    </div>
                                </div>
                            </div>



                    </div>


                    <div class="col-lg-4 col-md-4">
                        
                     <div class="row">
                       
                        <div class="col-12">
                            <h3>Данные доставки</h3>

                        </div>

                        <div class="col-lg-12 mb-20">
                            <?= $formFiz->field($model->delivery, 'address')->textarea(['rows' => 3])->label('Адрес') ?>
                        </div>
                     </div>
                     <div class="order_button">
                            <?= Html::submitButton('Оформить заказ', ['class' => '']) ?>
                            <?= Html::a('Быстрый заказ', ['#'], ['class' => 'btn btn-primary', 'data-toggle' => "modal", 'data-target' => "#modal_box_checkout"]) ?>
                        </div>

                    </div>

                      <div class="col-lg-4 col-md-4">
                    </div>
                </div>
                <?php ActiveForm::end() ?>

                <?php $formUr = ActiveForm::begin(['id' => 'Urlico']) ?>
                <div class="row">
                    <div class="col-lg-4 col-md-4">

                            <h3>Данные покупателя</h3>
                            <div class="row">


                                <div class="col-lg-12 mb-20">
                                     <?= $formUr->field($model->customer, 'companyName')->textInput()->label('Название компании') ?>
                                </div>

                                <div class="col-lg-12 mb-20">
                                     <?= $formUr->field($model->customer, 'inn')->textInput()->label('ИНН') ?>
                                </div>
                                <div class="col-lg-12 mb-20">

                                    <?= $formUr->field($model->customer, 'name')->textInput()->label('Контактное лицо') ?>
                                </div>

                                <div class="col-lg-12 mb-20">
                                    <?= $formUr->field($model->customer, 'phone')->widget(MaskedInput::class, [
                                        'options' => ['id' => 'urOrderMask'],
                                        'mask' => '+7 (999) 999 99 99',
                                    ])->textInput(['id' => 'urOrderMask', 'placeholder' => '+7 (999) 999 99 99'])->label('Телефон');?>

                                </div>
                                <div class="col-lg-12 mb-20">
                                    <?= $formUr->field($model->customer, 'email')->textInput()->label('E-mail') ?>

                                </div>

                                <div class="col-lg-12 mb-20">
                                     <?= $formUr->field($model->customer, 'urAddress')->textInput()->label('Юридический адрес') ?>
                                </div>


                                



                                <div class="col-12">
                                    <div class="order-notes">
                                        <?= $formUr->field($model, 'note')->textarea(['rows' => 3])->label('Комментарий к заказу')?>
                                    </div>
                                </div>
                            </div>



                    </div>


                    <div class="col-lg-4 col-md-4">
                        
                     <div class="row">
                       
                        <div class="col-12">
                            <h3>Данные доставки</h3>

                        </div>

                        <div class="col-lg-12 mb-20">
                            <?= $formUr->field($model->delivery, 'address')->textarea(['rows' => 3])->label('Адрес') ?>
                        </div>
                     </div>
                     <div class="order_button">
                            <?= Html::submitButton('Оформить заказ', ['class' => '']) ?>
                            <?= Html::a('Быстрый заказ', ['#'], ['class' => 'btn btn-primary', 'data-toggle' => "modal", 'data-target' => "#modal_box_checkout"]) ?>
                        </div>

                    </div>

                      <div class="col-lg-4 col-md-4">
                    </div>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
    <!--Checkout page section end-->

    <!-- modal area start-->
        <div class="modal fade" id="modal_box_checkout" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" style="display: -ms-flexbox; display: flex; -ms-flex-align: center; align-items: center; min-height: calc(100% - 1rem);"  role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-x"></i></span>
                    </button>
                    <div class="modal_body">
                        <div class="container">
                            <div class="checkout_form">

                                <?php $form_fast = ActiveForm::begin(['id' => 'fastOrderForm']) ?>
                                <div class="row">
                                    <div class="col-lg-12">

                                            <p  style="font-size: 32px; font-weight: bold; text-align: center;">Быстрый заказ</p>
                                            <p  style="text-align: center; padding-bottom:29px;">Заполните форму и мы Вам перезвоним!</p>
                                            <div class="row">

                                                <div class="col-lg-12 mb-20">

                                                    <?= $form_fast->field($model->customer, 'name')->textInput(['placeholder' => 'Имя'])->label(false) ?>
                                                </div>

                                                <div class="col-lg-12 mb-20">
                                                    <?= $form_fast->field($model->customer, 'phone')->widget(MaskedInput::class, [
                                                           'options' => ['id' => 'fastOrderMask'],
                                                        'mask' => '+7 (999) 999 99 99'
                                                    ])->textInput(['id' => 'fastOrderMask', 'placeholder' => '+7 (999) 999 99 99'])->label(false)?>

                                                </div>
                                                <div class="col-lg-12 mb-20">
                                                    <?= $form_fast->field($model->customer, 'email')->textInput(['placeholder' => 'E-Mail'])->label(false) ?>

                                                </div>



                                                <div class="col-12">
                                                    <div class="order-notes">
                                                        <?= $form_fast->field($model, 'note')->textarea(['rows' => 3, 'placeholder' => 'Комментарий к заказу'])->label(false)?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="order_button">
                                              <?= Html::submitButton('Оформить заказ', ['class' => '']) ?>
                                            </div>

                                    </div>
                                </div>
                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal area end-->


    <script>
        function makeActiveDelivery(div){
            // this.next('div').css( "background-color", "red" )
            $('div#deliveryform-method').find('div.delivery').css({display : 'none'});
            $(div).next().find('div').css({display : 'block'});
        }
        function makeActivePayment(div){
            // this.next('div').css( "background-color", "red" )
            $('div#paymentform-method').find('div.payment').css({display : 'none'});
            $(div).next().find('div').css({display : 'block'});
        }
    </script>


</div>
