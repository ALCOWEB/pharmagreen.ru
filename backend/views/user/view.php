<?php
use shop\helpers\UserHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\rbac\Item;
use yii\widgets\DetailView;
use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $user shop\entities\User\User */
$this->title = $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">



    <p>
        <?= Html::a('Update', ['update', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $user->id], [
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
                'model' => $user,
                'attributes' => [
                    'id',
                    'email:email',
                    'phone',
                    [
                        'attribute' => 'status',
                        'value' => UserHelper::statusLabel($user->status),
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Role',
                        'value' => implode(', ', ArrayHelper::getColumn(Yii::$app->authManager->getRolesByUser($user->id), 'description')),
                        'format' => 'raw',
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Photos</div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <?php if ($user->photo):?>
                <div class="btn-group">
                    <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-photo', 'user_id' => $user->id], [
                        'class' => 'btn btn-default',
                        'data-method' => 'post',
                        'data-confirm' => 'Remove photo?',
                    ]); ?>
                </div>
                <div>
                    <?= Html::a(
                        Html::img($user->photo->getThumbFileUrl('file', 'thumb')),
                        $user->photo->getUploadedFileUrl('file'),
                        ['class' => 'thumbnail', 'target' => '_blank']
                    ) ?>
                </div>
            <?php endif?>
            <?= $form->field($photosForm, 'file')->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ]
            ]) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>