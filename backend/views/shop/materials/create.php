<?php
/* @var $order \frontend\forms\OrderForm */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use shop\entities\Shop\Materials;


?>


<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'akril_5mm')->textInput()->label('Акрил, 5 мм, кв.м') ?>
        <?= $form->field($model, 'akril_4mm')->textInput()->label('Акрил, 4 мм кв.м') ?>
        <?= $form->field($model, 'akril_3mm')->textInput()->label('Акрил, 3 мм кв.м') ?>

        <?= $form->field($model, 'pvh_2mm')->textInput()->label('ПВХ, 2 мм, кв.м') ?>
        <?= $form->field($model, 'policarb_2mm')->textInput()->label('Поликарб, 2 мм, кв.м') ?>
        <?= $form->field($model, 'pet_1mm')->textInput()->label('ПЭТ, 1 мм, кв.м') ?>
        <?= $form->field($model, 'pet_05mm')->textInput()->label('ПЭТ, 0.5 мм, кв.м') ?>
        <?= $form->field($model, 'svetodiody')->textInput()->label('Светодиоды, 1м') ?>
        <?= $form->field($model, 'blok24')->textInput()->label('Блок, 24 Вт, шт') ?>
        <?= $form->field($model, 'blok36')->textInput()->label('Блок, 36 Вт, шт') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'blok48')->textInput()->label('Блок, 48 Вт, шт') ?>
        <?= $form->field($model, 'blok60')->textInput()->label('Блок, 60 Вт, шт') ?>
        <?= $form->field($model, 'derj_tabl_verh')->textInput()->label('Держ. табл. верх, шт') ?>
        <?= $form->field($model, 'derj_dist')->textInput()->label('Дистанц. держ') ?>
        <?= $form->field($model, 'kronsht_cang')->textInput()->label('Кроншт. цанговый, шт') ?>
        <?= $form->field($model, 'pechat')->textInput()->label('Пчать, кв.м') ?>
        <?= $form->field($model, 'scoch')->textInput()->label('Скотч, п.м') ?>
        <?= $form->field($model, 'tross')->textInput()->label('Тросс, п.м') ?>
        <?= $form->field($model, 'provod')->textInput()->label('Провод, п.м') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'ugolok')->textInput()->label('Уголк, шт') ?>
        <?= $form->field($model, 'prujina')->textInput()->label('Пружинка, шт') ?>
        <?= $form->field($model, 'podves_frame')->textInput()->label('Подвес фрейм., шт') ?>
        <?= $form->field($model, 'profil_frame')->textInput()->label('Профиль фрейм 1ст, п.м') ?>
        <?= $form->field($model, 'profil_frame_2storon')->textInput()->label('Профиль фрейм 2ст, п.м') ?>
        <?= $form->field($model, 'profil_magnet')->textInput()->label('Профиль магнетик, п.м') ?>
        <?= $form->field($model, 'magnitiki')->textInput()->label('Магнитики, шт') ?>
        <?= $form->field($model, 'golovki')->textInput()->label('Головки-зажимы, шт') ?>
        <?= $form->field($model, 'yashCost')->textInput()->label('Цена ящика, шт') ?>

    </div>

</div>
<div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'status')->radioList([Materials::ACTIVE => "АКТИВНО", Materials::DRAFT => "ЧЕРНОВИК"], [
                                                'class' => 'inline-label',
                                                'item' => function ($index, $label, $name, $checked, $value) {
                                                    return '<label class="'.Materials::styleLabel($value) . ($checked ? ' active' : '') . '">' .
                                                        Html::radio($name, $checked, ['value' => $value,]) . $label . '</label>';
                                                },
                                            ])->label('СТАТУС') ?>  
    </div>
</div> 

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
   

</div>

<?php ActiveForm::end(); ?>