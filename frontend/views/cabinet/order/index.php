<?php

use shop\entities\Shop\Order\Order;
use shop\helpers\OrderHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = ['label' => 'Cabinet', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout'=>"{items}\n{sorter}\n{pager}\n{summary}",
                'columns' => [
                    [
                        'attribute' => 'id',
                        'label' => '№',
                        'value' => function (Order $model) {
                            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    'created_at:datetime',
                    [
                        'attribute' => 'status',
                        'label' => 'Статус',
                        'value' => function (Order $model) {
                            return OrderHelper::statusLabel($model->current_status);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'cost',
                        'label' => 'Сумма',

                    ],

                ],
            ]); ?>
        </div>
    </div>

</br>