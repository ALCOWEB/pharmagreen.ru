<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>
<section class="main_content_area">
<div class="container">

    <div class="account_dashboard">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <!-- Nav tabs -->
                <div class="dashboard_tab_button">
                    <ul role="tablist" class="nav flex-column dashboard-list">


                        <li><a href="<?= Html::encode(Url::to(['/auth/reset/request'])) ?>" class="list-group-item <?= Yii::$app->controller->route == 'auth/reset/request' ? ' active' : '' ?>">Восстановить пароль</a></li>
                        <li><a href="<?= Html::encode(Url::to(['/cabinet/default/index'])) ?>" class="list-group-item  <?= Yii::$app->controller->route == 'cabinet/profile/edit' ? ' active' : '' ?>">Мой аккаунт</a></li>
                        <li><a href="<?= Html::encode(Url::to(['/cabinet/wishlist/index'])) ?>" class="list-group-item <?= Yii::$app->controller->route == 'cabinet/wishlist/index' ? ' active' : '' ?>">Список желаний</a></li>
                        <li><a href="<?= Html::encode(Url::to(['/cabinet/order/index'])) ?>" class="list-group-item <?= Yii::$app->controller->route == 'cabinet/order/index' ? ' active' : '' ?>">История заказов</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!-- Tab panes -->


                        <h1><?php echo Html::encode($this->title);?></h1>

                    <?= $content ?>

            </div>

        </div>
    </div>

</div>
</section>
<?php $this->endContent() ?>