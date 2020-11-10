
<?php
/* @var $this yii\web\View */
/* @var $model shop\forms\manage\User\UserEditForm */
/* @var $user shop\entities\User\User */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
$this->title = 'Update User: ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'role')->dropDownList($model->rolesList()) ?>

    <div class="box box-default">
        <div class="box-header with-border">Photos</div>
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
            <?= $form->field($model->photo, 'file')->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ]
            ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>