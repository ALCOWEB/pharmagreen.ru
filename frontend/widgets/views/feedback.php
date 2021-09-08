<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use \yii\widgets\MaskedInput;
?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="banner_full_content">
                <p style="font-size: 30px;"><strong>Задайте Ваш вопрос!</strong></p>
                <p>Если у Вас появились какие-то вопросы, напишите телефон для связи и мы ответим в ближайшее время!</p>
                <div class="subscribe_form">
                    <?php $form = ActiveForm::begin([
                        'id' => 'feedbackForm',
                        'action' => 'contact/feedback'

                    ])?>

                    <?=
                    $form->field($feedbackForm, 'mailOrPhone', [ 'options' => [
                        'tag' => null
                    ],])->label(false)->widget(MaskedInput::class, [
                        'mask' => '+7 (999) 999 99 99',
                    ])->textInput(['placeholder' => 'Телефон']);?>
                    <?=Html::submitButton('Перезвонить мне',  ['class' => 'submit btn btn-default']); ?>
                    <?php ActiveForm::end()?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <img src="/img/techsupport.png"  style=" width: 290px; position: absolute; bottom: -60px; right: 0px;" alt="">
        </div>
    </div>
</div>

<?php
$js = <<<JS

$('#feedbackform-mailorphone').prop('required', true);
$('#feedbackForm').on('beforeSubmit', function (){
   var form = $(this);
   var data = form.serializeArray();
   $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: data
   }).done(function (data){
       if (data.success){
           console.log(data);
       }
       else if (data.validation) {
                // server validation failed
                console.log(data);
                form.yiiActiveForm('updateMessages', data.validation, true); // renders validation messages at appropriate places
            }
       else {
                // incorrect server response  
                console.log(data);
                console.log('ашипка')
            }
       
   })
     return false; // отменяем отправку данных формы   
})
JS;
$this->registerJs($js);
