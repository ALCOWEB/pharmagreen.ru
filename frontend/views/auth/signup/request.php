<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>





        <div class="col-lg-4">
            <p>Для регистрации заполните следующую форму:</p>
            <div class="account_form">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>


                <?= $form->field($model, 'email')->label('E-mail') ?>

                <?= $form->field($model, 'phone')->label('Телефон') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>


                    <?= Html::submitButton('Зарегистрироваться', [ 'name' => 'signup-button']) ?>


            <?php ActiveForm::end(); ?>
            </div>
        </div>


