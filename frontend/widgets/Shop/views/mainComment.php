<?php
use yii\helpers\Url;
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 28.08.2020
 * Time: 22:47
 */?>


    <div class="container">
        <div class="row">
<?php foreach ($reviews as $review):?>
            <div class="col-md-4"><div class="testimonial_area">

                    <div class="">
                        <div class="single_testimonial">
                            <div class="testimonial_thumb" style=" ">
                                <a href="#"> <div class="round-img" style="background: url(<?php
                                    if ($review->photo) {
                                        echo $review->photo->getThumbFileUrl('file', 'admin');
                                    } else { echo '';}

                                    ?>) no-repeat center center; background-size: cover;">

                                    </div> </a>
                            </div>
                            <div class="testimonial_content">
                                <div class="testimonial_icon_img">

                                    <i class="fa fa-quote-right fa-2x" style="color: #40A944; margin-top: 20px;" aria-hidden="true"></i>

                                </div>
                                <p><?= $review->text;?></p>
                                <a href="<?= Url::to(['/shop/catalog/product', 'id' => $review->product_id]);?>"><?= $review->product->name?></a>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
<?php endforeach;?>
    </div>
</div>
