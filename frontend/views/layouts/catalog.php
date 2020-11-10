<?php
/* @var $this \yii\web\View */
/* @var $content string */
use frontend\widgets\Shop\TagShopWidget;
?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>


    <!--shop  area start-->
    <div class="shop_area shop_reverse mt-70 mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <!--sidebar widget start-->
                    <aside class="sidebar_widget">
                        <div class="widget_inner">


                            <div class="widget_list banner_widget">
                                <h3>Сертификаты:</h3>
                                <div class="banner_thumb">
                                    <a href="#"><img src="/assets/img/bg/banner17.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="widget_list tags_widget">
                                <h3>Тэги</h3>
                                <?= TagShopWidget::widget();?>

                            </div>

                        </div>
                    </aside>
                    <!--sidebar widget end-->
                </div>

                <div class="col-lg-9 col-md-12">
                    <?= $content ?>

                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->


<?php $this->endContent() ?>