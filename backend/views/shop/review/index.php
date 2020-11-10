<?php
use shop\entities\Shop\Product\Review;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use shop\helpers\ProductHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 09.08.2020
 * Time: 17:30
 */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;




//ArrayHelper::map($dataProvider->query->asArray()->all(), 'id', function (array $reviews) {
//    return $reviews['product']['name'];
//});
?>

<div class="user-index">

    <p>
        <?= Html::a('Create Brand', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    'created_at',
                    ['attribute' => 'product_id',
                        'filter' => $searchModel->productList(),
                        'value' => function($model){
                                return $model->product->name;
                        }
                    ],
                    'user_id',
                    'vote',
                    'text',
                    ['attribute' => 'active',
                     'filter' => $searchModel->statusList(),
                        'value' => function (Review $model) {
                            return ProductHelper::statusLabel($model->active);
                        },
                        'format' => 'raw',
                        ],


                    ['class' => ActionColumn::class],
                ],
            ]);


            ?>
        </div>
    </div>
</div>