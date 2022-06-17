<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use shop\entities\shop\Materials;



 $form = ActiveForm::begin(); ?>


 

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($materials, 'akril_5mm')->textInput()->label('Акрил, 5 мм, кв.м') ?>
                <?= $form->field($materials, 'akril_4mm')->textInput()->label('Акрил, 4 мм кв.м') ?>
                <?= $form->field($materials, 'akril_3mm')->textInput()->label('Акрил, 3 мм кв.м') ?>
                <?= $form->field($materials, 'pvh_2mm')->textInput()->label('ПВХ, 2 мм, кв.м') ?>
                <?= $form->field($materials, 'policarb_2mm')->textInput()->label('Поликарб, 2 мм, кв.м') ?>
                <?= $form->field($materials, 'pet_1mm')->textInput()->label('ПЭТ, 1 мм, кв.м') ?>
                <?= $form->field($materials, 'pet_05mm')->textInput()->label('ПЭТ, 0.5 мм, кв.м') ?>
                <?= $form->field($materials, 'svetodiody')->textInput()->label('Светодиоды, 1м') ?>
                <?= $form->field($materials, 'blok24')->textInput()->label('Блок, 24 Вт, шт') ?>
                <?= $form->field($materials, 'blok36')->textInput()->label('Блок, 36 Вт, шт') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($materials, 'blok48')->textInput()->label('Блок, 48 Вт, шт') ?>
                <?= $form->field($materials, 'blok60')->textInput()->label('Блок, 60 Вт, шт') ?>
                <?= $form->field($materials, 'derj_tabl_verh')->textInput()->label('Держ. табл. верх, шт') ?>
                <?= $form->field($materials, 'derj_dist')->textInput()->label('Дистанц. держ') ?>
                <?= $form->field($materials, 'kronsht_cang')->textInput()->label('Кроншт. цанговый, шт') ?>
                <?= $form->field($materials, 'pechat')->textInput()->label('Пчать, кв.м') ?>
                <?= $form->field($materials, 'scoch')->textInput()->label('Скотч, п.м') ?>
                <?= $form->field($materials, 'tross')->textInput()->label('Тросс, п.м') ?>
                <?= $form->field($materials, 'provod')->textInput()->label('Провод, п.м') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($materials, 'ugolok')->textInput()->label('Уголк, шт') ?>
                <?= $form->field($materials, 'prujina')->textInput()->label('Пружинка, шт') ?>
                <?= $form->field($materials, 'podves_frame')->textInput()->label('Подвес фрейм., шт') ?>
                <?= $form->field($materials, 'profil_frame')->textInput()->label('Профиль фрейм 1ст, п.м') ?>
                <?= $form->field($materials, 'profil_frame_2storon')->textInput()->label('Профиль фрейм 2ст, п.м') ?>
                <?= $form->field($materials, 'profil_magnet')->textInput()->label('Профиль магнетик, п.м') ?>
                <?= $form->field($materials, 'magnitiki')->textInput()->label('Магнитики, шт') ?>
                <?= $form->field($materials, 'golovki')->textInput()->label('Головки-зажимы, шт') ?>
                <?= $form->field($materials, 'yashCost')->textInput()->label('Цена ящика, шт') ?>
              
                
            </div>

        </div>
        <?= $form->field($materials, 'status')->radioList([Materials::ACTIVE => "АКТИВНО", Materials::DRAFT => "ЧЕРНОВИК"], [
                                                'class' => 'inline-label',
                                                'item' => function ($index, $label, $name, $checked, $value) {
                                                    return '<label class="'.Materials::styleLabel($value) . ($checked ? ' active' : '') . '">' .
                                                        Html::radio($name, $checked, ['value' => $value,]) . $label . '</label>';
                                                },
                                            ])->label('СТАТУС') ?>

        
        <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
  
  

    <?php ActiveForm::end(); 
   

    ?>

