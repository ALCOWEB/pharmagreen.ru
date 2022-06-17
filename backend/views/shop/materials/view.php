<?php use yii\widgets\DetailView;
use yii\helpers\Html;
use shop\entities\shop\Materials;
?>
<div class="raw">
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [    
        'id',
        ['attribute' => 'created_at',
            'label' => "Дата создания",
            'value' => function($model){
    return Yii::$app->formatter->asDate($model->created_at, 'php:d F Y');
            } ],
        ['attribute' => 'akril_5mm', 'label' => "Акрил, 5мм, кв.м" ],
        ['attribute' => 'akril_3mm', 'label' => "Акрил, 3мм, кв.м" ],
        ['attribute' => 'akril_4mm', 'label' => "Акрил, 4мм, кв.м" ],
        ['attribute' => 'pvh_2mm', 'label' => "ПВХ, 2мм, кв.м" ],
        ['attribute' => 'policarb_2mm', 'label' => "Поликарбонат, 2мм, кв.м" ],
        ['attribute' => 'pet_1mm', 'label' => "ПЭТ, 1мм, кв.м" ],
        ['attribute' => 'pet_05mm', 'label' => "ПЭТ, 0,5мм, кв.м" ],
        ['attribute' => 'svetodiody', 'label' => "Светодиодная линейка, п.м" ],
        ['attribute' => 'blok24', 'label' => "Блок, 24ВТ, шт." ],
        ['attribute' => 'blok36', 'label' => "Блок, 36ВТ, шт." ],
        ['attribute' => 'blok48', 'label' => "Блок, 48ВТ, шт." ],
        ['attribute' => 'blok60', 'label' => "Блок, 60ВТ, шт." ],
        ['attribute' => 'derj_tabl_verh', 'label' => "Держатель табличек, шт." ],
        ['attribute' => 'derj_dist', 'label' => "Дистанционный держатель, 16х25мм, шт." ],
        ['attribute' => 'kronsht_cang', 'label' => "Подвес, шт." ],
        ['attribute' => 'pechat', 'label' => "Печать, кв.м" ],
        ['attribute' => 'tross', 'label' => "Тросс 2мм, п.м" ],
        ['attribute' => 'provod', 'label' => "Провод шввп 2х0,75, п.м" ],
        ['attribute' => 'ugolok', 'label' => "Уголок(фреймлайт/магнетик), шт." ],
        ['attribute' => 'prujina', 'label' => "Пружинка для фреймлайта, шт." ],
        ['attribute' => 'podves_frame', 'label' => "Подвес для фреймлайта, шт." ],
        ['attribute' => 'profil_frame', 'label' => "Профиль фреймлайт 1ст., п.м" ],
        ['attribute' => 'profil_frame_2storon', 'label' => "Профиль фреймлайт 2ст., п.м" ],
        ['attribute' => 'profil_magnet', 'label' => "Профиль магнетик, п.м" ],
        ['attribute' => 'magnitiki', 'label' => "Магнитики, 5х5мм, шт." ],
        ['attribute' => 'golovki', 'label' => "Заглушки, 12мм, шт." ],
        ['attribute' => 'yashCost', 'label' => "Цена ящика, шт." ],
        ['attribute' => 'status', 
            'label' => "Сатус прайса на материалы",
            'format' => 'raw',
            'value' => function($model){
                return '<label class="'.Materials::styleLabel($model->status).'">'.Materials::statusLabel($model->status).'</label>';}
         ],
      
    ],
]) ?>
</div>
