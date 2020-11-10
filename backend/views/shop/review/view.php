<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use shop\entities\Shop\Product\Product;
/* @var $this yii\web\View */
/* @var $tag shop\entities\Shop\Tag */
/* @var $review shop\entities\Shop\Product\Review */
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">


    <p>
        <?php if ($review->isActive()): ?>
            <?= Html::a('Draft', ['draft', 'product_id' => $review->product->id, 'review_id' => $review->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Activate', ['activate', 'product_id' => $review->product->id, 'review_id' => $review->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Update', ['update', 'product_id' => $review->product_id, 'review_id' => $review->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'product_id' => $review->product->id, 'review_id' => $review->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $review,
                'attributes' => [
                    'id',
                    ['attribute'=>'product_id',
                     'value' => $review->product->name,
                        ],
                    'created_at',
                    'user_id',
                    'vote',
                    'text',
                    'active',
                ],
            ]) ?>
        </div>
    </div>
</div>