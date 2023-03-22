<?php

/** @var $posts shop\entities\Blog\Post\Post[] */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
?>

<!--blog area start-->

<section class="blog_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <p>статьи нашего сайта</p>
                    <h2>Блог</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="blog_carousel blog_column3 owl-carousel">
                <?php foreach ($posts as $post):?>
                <?php $url = Url::to(['/blog/post/post', 'id' =>$post->id]);?>
                <div class="col-lg-3">
                    <article class="single_blog">
                        <figure>
                            <?php if ($post->photo): ?>
                                <div class="blog_thumb">
                                    <a href="<?= Html::encode($url)?>"><img src="<?= Html::encode($post->getThumbFileUrl('photo', 'widget_list')) ?>" alt="" class="img-responsive" /></a>
                                </div>
                            <?php endif; ?>

                            <figcaption class="blog_content">
                                <div class="articles_date">
                                    <h4 class="post_title" style="font-weight: bold;"><a href="<?= Html::encode($url)?>"><?= Html::encode($post->title)?></a></h4>
                                </div>
                                <p><?= Html::encode(StringHelper::truncateWords(strip_tags($post->description), 20)) ?></p>
                                <footer class="blog_footer">
                                    <a href="<?= Html::encode($url)?>">Подробнее</a>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>
