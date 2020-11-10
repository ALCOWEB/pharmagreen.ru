<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>


            <!--login area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <p>
                        <?= $form->field($model, 'username')->textInput()->label('E-mail') ?>
                    </p>
                    <p>
                        <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
                    </p>
                    <div class="login_submit">
                        <?= Html::a('Забыли пароль?', ['auth/reset/request']) ?>
                        <?= $form->field($model, 'rememberMe', ['options' => ['tag'=>false]])->checkbox(
                        ['template' => "{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}"]
                        )->label('Запомнить меня')  ?>
                        <?= Html::submitButton('Вход', ['name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>




                </div>
            </div>
            <!--login area start-->

            <!--register area start-->
            <div class="col-lg-6 col-md-6">
                <div class="well">

                    <p><strong>Зарегестрировать аккаунт</strong></p>
                    <p>Если у Вас нет аккаунта, Вы можете пройти быструю процедуру регистрации. Аккаунт позволит Вам просматривать Ваши заказы, а так же управлять Вашим профилем.</p>
                    <a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>" class="button-auth">РЕГИСТРАЦИЯ</a>
                </div>
                <br>
                <div class="well">
                    <p><strong>Войти через социальные сети</strong></p>
                    <?= yii\authclient\widgets\AuthChoice::widget([
                        'baseAuthUrl' => ['auth/network/auth']
                    ]); ?>
                </div>
            </div>




