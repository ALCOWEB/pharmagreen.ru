<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contact_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact_message content">
                    <p>Мы будем рады ответить на все Ваши вопросы, выслушать пожелания, предложения и замечания по работе нашего интернет-магазина в Москве. Всю необходимую контактную информацию Вы найдете здесь Переписать!!!!!</p>
                    <ul>
                        <li><i class="fa fa-fax"></i>  Адрес: г.Чебоксары, Проспект Мира 3/б</li>
                        <li><i class="fa fa-envelope-o"></i> <a href="#">info@bobryy2.com</a></li>
                        <li><i class="fa fa-phone"></i><a href="tel:0(1234)567890">0(1234) 567 890</a>  </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact_message form">

                    <h3>Напишите нам и мы ответим в ближайшее время</h3>
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class' => false])->label('Имя') ?>

                    <?= $form->field($model, 'email')->textInput(['class' => false])->label('E-mail') ?>

                    <?= $form->field($model, 'subject')->textInput(['class' => false])->label('Тема') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6, 'class' => false])->label('Текст') ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ])->label('Введите код с картинки') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>


