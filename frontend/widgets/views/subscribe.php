<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 08.10.2020
 * Time: 22:55
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>



<div class="widgets_container widget_newsletter">
    <h3><strong>ПОДПИСАТСЬЯ НА НОВОСТИ</strong></h3>
    <div class="subscribe_form">

        <?php $form = ActiveForm::begin([
                'id' => 'subscribe',
            'action' => 'contact/subscribe',
            'fieldConfig' =>[
            'options' => [
            ]]
        ]); ?>
        <?=$form->field($model, 'email', [ 'options' => [
                'tag' => null
        ],])->textInput(['placeholder'=>'E-mail'])->label(false);?>
        <?=Html::submitButton('Подписаться',  ['class' => 'submit btn btn-default']); ?>
        <?php ActiveForm::end(); ?>


    </div>
</div>



<?php

$js = <<<JS
  $('#subscribeform-email').prop('required',true);
  $('#subscribe').on('beforeSubmit', function() {
    var form = $(this);
    var data = form.serializeArray();
    // отправляем данные на сервер
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: data
    }).done(function(data) {
            if(data.success) {
                // data is saved
                $("div.subscribe_form").html('<strong>Спасибо за подписку!</strong>')
                console.log(data)
            } else if (data.validation) {
                // server validation failed
                console.log(data);
                form.yiiActiveForm('updateMessages', data.validation, true); // renders validation messages at appropriate places
            } else {
                // incorrect server response  
                console.log(data);
                console.log('ашипка')
            }
        })
        .fail(function () {
            // request failed
             console.log('ajax error')
        })
    return false; // отменяем отправку данных формы
});
JS;
$this->registerJs($js);

?>

