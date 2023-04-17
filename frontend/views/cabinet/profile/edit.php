<?php

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\User\UserEditForm */
/* @var $user shop\entities\User\User */

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\helpers\Url;

$this->title = 'Редактировать профиль';
$this->params['breadcrumbs'][] = ['label' => 'Cabinet', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = 'Profile';
?>


<div class="login">



            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'email')->textInput(['maxLength' => true])->label('E-mail') ?>
            <?= $form->field($model, 'phone')->textInput(['maxLength' => true])->label('Телефон') ?>
            <div class="box box-default">
                <div class="box-header with-border">Фото</div>
                <div class="box-body">
                    <?= $form->field($model->photo, 'file')->widget(FileInput::class, [
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => false,
                        ],
                        'pluginOptions' => [
                            'initialPreview'=>[

                                ($user->photo) ? Html::img($user->photo->getThumbFileUrl('file', 'thumb')) : null,
                            ],
                            'deleteUrl' => Url::to(['delete-photo', 'user_id' => $user->id]),
                            'overwriteInitial'=>true,

                        ]
                    ])->label(false) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
<h4>Привязать профиль соцсетей</h4>
<?= yii\authclient\widgets\AuthChoice::widget([
    'baseAuthUrl' => ['cabinet/network/attach'],
]); ?>



