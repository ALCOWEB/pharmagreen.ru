<?php
/* @var $this \yii\web\View */
use frontend\widgets\Blog\LastPostsWidget;
use frontend\widgets\Shop\FeaturedProductsWidget;
use frontend\widgets\Shop\MainCommentWidget;
use frontend\widgets\FeedbackWidget;

/* @var $content string */
//\frontend\assets\OwlCarouselAsset::register($this);
?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>
<section class="slider_section">
        <div class="slider_area owl-carousel">
            <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="slider_content">
                                <h1>Vegetables Big Sale</h1>
                                <h2>Fresh Farm Products</h2>
                                <p>
								10% certifled-organic mix of fruit and veggies. Perfect for weekly cooking and snacking!
							    </p> 
                                <a href="shop.html">Read more </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="slider_content">
                                <h1>Fresh Vegetables</h1>
                                <h2>Natural Farm Products</h2>
                                <p>
								Widest range of farm-fresh Vegetables, Fruits & seasonal produce
							     </p> 
                                <a href="shop.html">Read more </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider3.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="slider_content">
                                <h1>Fresh Tomatoes</h1>
                                <h2>Natural Farm Products</h2>
                                <p>
								Natural organic tomatoes make your health stronger. Put your information here
							     </p>
                                <a href="shop.html">Read more </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--shipping area start-->
    <div class="shipping_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <i class="fa fa-plane fa-3x" style="color: #40a944;" aria-hidden="true"></i>
                        </div>
                        <div class="shipping_content">
                            <h3>Бесплатная доставка</h3>
                            <p>Бесплатная доставка по всей Росси при заказе от 10000 рублей</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_shipping col_2">
                        <div class="shipping_icone">
                            <i class="fa fa-clock-o fa-3x" style="color: #40a944;" aria-hidden="true"></i>
                        </div>
                        <div class="shipping_content">
                            <h3>Круглосутончая поддержка</h3>
                            <p>Вы можете заказать товар или получить консультацию 24 часа в сутки</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_shipping col_3">
                        <div class="shipping_icone">
                            <i class="fa fa-thumbs-o-up fa-3x" style="color: #40a944;" aria-hidden="true"></i>
                        </div>
                        <div class="shipping_content">
                            <h3>Качественная продукция</h3>
                            <p>Наши товары изготавльиваются только из чистого натурального сырья</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--shipping area end-->

    <?= FeaturedProductsWidget::widget([
        'limit' => 4,
    ]) ?>
    <div class="banner_fullwidth">

        <?= FeedbackWidget::widget();?>

    </div>
<?= LastPostsWidget::widget([
    'limit' => 4,
    'view' => 'last-posts'
]) ?>

 <div class="container" style="padding-bottom: 50px; border-bottom: 1px solid #efefef;">
     <div class="row">
         <div class="col-lg-12">
             <div class="section_title">
                 <p>отзывы на нашу продукцию</p>
                 <h2>Отзывы</h2>
             </div>
         </div>
     </div>


            <?= MainCommentWidget::widget([
                'review_ids' => [1,2,3]
            ]) ?>



    </div>

<?php $this->endContent() ?>