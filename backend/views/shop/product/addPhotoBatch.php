<?php
use shop\entities\Shop\Product\Product;
use shop\helpers\PriceHelper;
use shop\helpers\ProductHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use shop\entities\Shop\Characteristic;
/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Shop\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="user-index">

  

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'rowOptions' => function (Product $model) {
                    return $model->quantity <= 0 ? ['style' => 'background: #fdc'] : [];
                },
                'columns' => [
                    [
                        'value' => function (Product $model) {
                            return $model->mainPhoto ? Html::img($model->mainPhoto->getThumbFileUrl('file', 'admin')) : null;
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 100px'],
                    ],
                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function (Product $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'category_id',
                        'filter' => $searchModel->categoriesList(),
                        'value' => 'category.name',
                    ],

                    [
                        'label' => 'storon',
                        'attribute' => 'storon',
                        'filter' => ['Односторонняя' => 'Односторонняя', 'Двухсторонняя' => 'Двухсторонняя'],
                        'value' => function (Product $model) {
                            $char = Characteristic::find()->where(['name' => 'Количество сторон'])->one();
                            $val = $model->getValue($char->id);
                            return $val->value;
                        },
                       
                        
                    ],

                    [
                        'attribute' => 'status',
                        'filter' => $searchModel->statusList(),
                        'value' => function (Product $model) {
                        return ProductHelper::statusLabel($model->status);
                    },
                        'format' => 'raw',
                    ],

                ],
            ]); ?>
        </div>
    </div>
</div>

<?php $form = ActiveForm::begin([
                'options' => ['enctype'=>'multipart/form-data'],
            ]); ?>

            <?= $form->field($photosForm, 'files[]')->label(false)->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ]
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

