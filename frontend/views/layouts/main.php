<?php
/* @var $this \yii\web\View */
/* @var $content string */
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use frontend\widgets\Shop\CartWidget;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use shop\readModels\Shop\ProductReadRepository;
use frontend\widgets\Shop\CategoriesMainWidget;
use frontend\widgets\SubscribeWidget;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en">
<!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>
    <?php $this->head() ?>
    <!-- all css here -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico">




</head>
<body>
<?php $this->beginBody() ?>
<!--header area start-->

<!--offcanvas menu area start-->
<div class="off_canvars_overlay">

</div>


<div class="offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <a href="javascript:void(0)"><i class="icon-menu"></i></a>
                </div>
                <div class="offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="icon-x"></i></a>
                    </div>
                    <div class="header-account-mobile">
                        <ul>
                            <?php if (Yii::$app->user->isGuest): ?>
                                <li><a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>">Вход</a></li>
                                <li>|</li>
                                <li><a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>">Регистрация</a></li>
                            <?php else: ?>
                                <li><a href="<?= Html::encode(Url::to(['/cabinet/profile/edit'])) ?>">Личный кабинет</a></li>
                                <li>|</li>
                                <li><a href="<?= Html::encode(Url::to(['/auth/auth/logout'])) ?>" data-method="post">Выход</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="search_container">
                        <?= Html::beginForm(['/shop/catalog/search'], 'get') ?>

                        <div class="search_box">
                            <input type="text" name="text" value="" placeholder="Введите название продукта..." >
                            <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                        </div>
                        <?= Html::endForm() ?>
                    </div>

                    <div class="call-support">
                        <p><a href="tel:8-800-667-34-70">8-800-667-34-70</a> Звонок по России бесплатный</p>
                    </div>
                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            <li class="menu-item">
                                <a href="<?= Html::encode(Url::to(['/shop/catalog']))?>">Каталог</a>
                            </li>
                            <li><a href="<?= Html::encode(Url::to(['/blog/index']))?>">Статьи</a>
                            </li>
                            <li><a href="<?= Html::encode(Url::to(['/site/about']))?>">О нас</a></li>
                            <li><a href="<?= Html::encode(Url::to(['/site/about']))?>">Доставка и оплата</a></li>
                            <li><a href="<?= Html::encode(Url::to(['contact/index']))?>">Контакты</a></li>

                        </ul>
                    </div>
                    <div class="offcanvas_footer">
                        <span><a href="#"><i class="fa fa-envelope-o"></i> info@pharmagreen.ru</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--offcanvas menu area end-->

<header>
    <div class="main_header">

        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3 col-sm-3 col-3">
                        <div class="logo">
                            <a href="<?= Url::home() ?>"><img src="/assets/img/logo/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-6 col-sm-7 col-8">
                        <div class="header_right_info">
                            <div class="search_container">
                                <?= Html::beginForm(['/shop/catalog/search'], 'get') ?>
                                    
                                    <div class="search_box">
                                        <input type="text" name="text" value="" placeholder="Введите название продукта..." >
                                        <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                                    </div>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="header_account_area">
                                <div class="header_account_list register">
                                    <ul>
                                    <?php if (Yii::$app->user->isGuest): ?>
                                        <li><a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>">Вход</a></li>
                                        <li>|</li>
                                        <li><a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>">Регистрация</a></li>
                                    <?php else: ?>
                                        <li><a href="<?= Html::encode(Url::to(['/cabinet/profile/edit'])) ?>">Личный кабинет</a></li>
                                        <li>|</li>
                                        <li><a href="<?= Html::encode(Url::to(['/auth/auth/logout'])) ?>" data-method="post">Выход</a></li>
                                    <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="header_account_list header_wishlist">

                                    <a href="<?= Url::to(['/cabinet/wishlist/index']) ?>"><span class="lnr lnr-heart"></span> <span class="item_count"><?php echo ProductReadRepository::getWishListCount(\Yii::$app->user->id);?></span> </a>
                                </div>
                                <div class="header_account_list  mini_cart_wrapper">

                                    <?= CartWidget::widget() ?>

                                    <!--mini cart end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <?= CategoriesMainWidget::widget([
                            'active' => $this->params['active_category'] ?? null
                        ]) ?>

                    </div>
                    <div class="col-lg-6">
                        <!--main menu start-->
                        <div class="main_menu menu_position">

                            <nav>
                                <ul>
                                    <li class="mega_items"><a href="<?= Html::encode(Url::to(['/shop/catalog']))?>">Каталог</a>

                                    </li>
                                    <li><a href="<?= Html::encode(Url::to(['/blog/index']))?>">Статьи</a>
                                    </li>
                                    <li><a href="<?= Html::encode(Url::to(['/site/about']))?>">О нас</a></li>
                                    <li><a href="<?= Html::encode(Url::to(['/site/about']))?>">Доставка и оплата</a></li>
                                    <li><a href="<?= Html::encode(Url::to(['contact/index']))?>">Контакты</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!--main menu end-->
                    </div>
                    <div class="col-lg-3">
                        <div class="call-support">
                            <p><a href="tel:8-800-667-34-70">8-800-667-34-70</a> Звонок по России бесплатный</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header area end-->


<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' =>['class' => 'breadcrumb breadcrumb_nomargin']

                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?= Alert::widget() ?>
<?= $content ?>


<!--footer area start-->
<footer class="footer_widgets">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-7">
                    <div class="widgets_container contact_us">
                        <div class="footer_logo">
                            <a href="index.html"><img src="/assets/img/logo/logo.png" alt=""></a>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="footer_menu">

                                    <ul>
                                        <li> <a href="<?= Html::encode(Url::to(['/shop/catalog']))?>">Каталог</a></li>
                                        <li><a href="contact.html">Статьи</a></li>
                                        <li><a href="about.html">О нас</a></li>

                                    </ul>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="footer_menu">

                                    <ul>
                                        <li><a href="#">Доставка</a></li>
                                        <li><a href="contact.html">Оплата</a></li>
                                        <li><a href="#">Контакты</a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="col-lg-5 col-md-12 col-sm-7">
                    <div class="widgets_container contact_us">
                        <h3><strong>НАШИ КОНТАКТЫ</strong></h3>

                        <p><span class="lnr lnr-map-marker" ></span> г.Чебоксары, Проспект мира д.30, кв 30</p>
                        <p><span class="lnr lnr-envelope"></span> <a href="#">info@bobrbobr.com</a></p>
                        <p><span class="lnr lnr-phone-handset" ></span> <a href="tel:8-800-333-71-75">8-800-333-71-75</a> </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-3 col-sm-5">
                    <?= SubscribeWidget::widget() ?>
                </div>


            </div>
        </div>
    </div>

    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7">
                    <div class="copyright_area">
                        <p>Copyright  © 2020  <a href="#">Safira</a>  . All Rights Reserved.Design by  <a href="#">Safira</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer area end-->



<!--news letter popup start-->

<!--news letter popup start-->


<?php $this->endBody() ?>



</body>
</html>
<?php $this->endPage() ?>
