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
                <?php $form = ActiveForm::begin() ?>
                <?=$form->errorSummary($model);?>
                <div class="row">
                    <div class="col-lg-4 col-md-4">

                            <h3>Данные покупателя</h3>
                            <div class="row">

                                <div class="col-lg-12 mb-20">

                                    <?= $form->field($model->customer, 'name')->textInput()->label('Имя') ?>
                                </div>

                                <div class="col-lg-12 mb-20">
                                    <?= $form->field($model->customer, 'phone')->widget(MaskedInput::class, [
                                        'mask' => '+7 (999) 999 99 99',
                                    ])->textInput()->label('Телефон');?>

                                </div>
                                <div class="col-lg-12 mb-20">
                                    <?= $form->field($model->customer, 'email')->textInput()->label('E-mail') ?>

                                </div>



                                <div class="col-12">
                                    <div class="order-notes">
                                        <?= $form->field($model, 'note')->textarea(['rows' => 3])->label('Комментарий к заказу')?>
                                    </div>
                                </div>
                            </div>



                    </div>


                    <div class="col-lg-4 col-md-4">
                            <h3>Способ доставки</h3>
                     <div class="row">
                        <div class="col-lg-12 mb-20">

<!--                            --><?//= $form->field($model->delivery, 'method')->dropDownList($model->delivery->deliveryMethodsList(), ['prompt' => '--- Select ---', 'encode' => false ])->label('Выбор метода доставки') ?><!-- -->
                            <?= $form->field($model->delivery, 'method')->radioList($model->delivery->deliveryMethodsList(),['unselect' => null,
                                'item' => function ($index, $label, $name, $checked, $value) use ($model){
                    return '<div class="panel-default" style="display:flex;align-items:baseline;">'.Html::radio($name, $checked, ['value' => $value, 'id' => 'delivery'.$value,'class' => 'project-status-btn', 'onchange' => 'makeActiveDelivery(this)']).'<label class="'.($checked ? ' active'  : '') .' " for="delivery'.$value.'" >' . $label .'<div class="delivery" style="display:none">'.$model->delivery->description($value).'</div></label></div>';
                },] )->label('') ?>


                        </div>
                        <div class="col-12 mb-20">
                            <h3>Данные доставки</h3>

                        </div>

                        <div class="col-lg-12 mb-20">
                            <?= $form->field($model->delivery, 'address')->textarea(['rows' => 3])->label('Адрес') ?>
                        </div>

                        <div class="col-lg-12 mb-20">
                            <?= $form->field($model->delivery, 'index')->textInput()->label('Индекс') ?>

                        </div>
                     </div>


                    </div>

                    <div class="col-lg-4 col-md-4">
                        <h3>Выбор способа оплаты</h3>

                        <div class="row">
                            <div class="col-lg-12 mb-20">

                                <?= $form->field($model->payment, 'method')->radioList($model->payment->paymentMethodsList(),['unselect' => null,
                                    'item' => function ($index, $label, $name, $checked, $value) use ($model){
                                        return '<div class="panel-default" style="display:flex;align-items:baseline;">'.Html::radio($name, $checked, ['value' => $value, 'id' => 'payment'.$value,'class' => 'project-status-btn', 'onchange' => 'makeActivePayment(this)']).'<label class="'.($checked ? ' active'  : '') .' " for="payment'.$value.'" >' . $label .'<div class="payment" style="display:none">'.$model->payment->description($value).'</div></label></div>';
                                    },] )->label('') ?>
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
    <!--Checkout page section end-->

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
