<?php
/* @var $this yii\web\View */
/* @var $user \shop\entities\User\User */
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>
    Hello,

    Follow the link below to confirm your email:

<?= $confirmLink ?>

Ваш пароль:
<?= $password; ?>
