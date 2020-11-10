<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\Shop\AddToCartForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Добавить в корзину';
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Cart', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="col-lg-2">
        <?php if ($product->photos[0]): ?>

            <img src="<?= $product->photos[0]->getThumbFileUrl('file', 'catalog_product_main') ?>" data-zoom-image="<?= $product->photos[0]->getThumbFileUrl('file', 'catalog_product_main') ?>" alt="<?= Html::encode($product->name) ?>">

        <?php
        endif; ?>
    </div>

        <div class="col-lg-5">
            <?php $form = ActiveForm::begin() ?>

            <?php if ($modifications = $model->modificationsList()): ?>
                <?= $form->field($model, 'modification')->dropDownList($modifications, ['prompt' => '--- выбрать модификацию ---'])->label('Модификация') ?>
            <?php endif; ?>

            <?= $form->field($model, 'quantity')->textInput() ?>

            <div class="cart_submit">
                <?= Html::submitButton('Добавить в корзину') ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>

