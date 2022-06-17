<?php
use yii\grid\GridView;
use shop\entities\shop\Materials;
use yii\helpers\Json;
use shop\helpers\OrderHelper;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<p>
<?= Html::a('Создать новые цены на материалы', ['create'], ['class' => 'btn btn-success']) ?>

</p>
<div class="row">
<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        ['attribute' => 'created_at',
            'value' => function($model){
    return Yii::$app->formatter->asDate($model->created_at, 'php:d F Y');
            } ],
        ['attribute' => 'status',
        'format' => 'raw',
        'value' => function($model){
            return '<label class="'.Materials::styleLabel($model->status).'">'.Materials::statusLabel($model->status).'</label>';} ],
        
        ['class' => 'yii\grid\ActionColumn'],
      
    ],
]);
?>
</div>