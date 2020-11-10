<?php

/* @var $this yii\web\View */
/* @var $model shop\entities\Blog\Post\Post */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

$url = Url::to(['post', 'id'=>$post->id]);
?>

    <div class="col-lg-4 col-md-4 col-sm-6">
        <article class="single_blog">
            <figure>
                <?php if ($post->photo): ?>
                <div class="blog_thumb">
                    <a href="<?= Html::encode($url) ?>"><img src="<?= Html::encode($post->getThumbFileUrl('photo', 'thumb')) ?>" alt=""></a>
                </div>
                <?php endif; ?>
                <figcaption class="blog_content">

                    <h4 class="post_title"><a href="<?= Html::encode($url) ?>"><strong><?= Html::encode($post->title) ?></strong></a></h4>
                    <p><?=StringHelper::truncate(Yii::$app->formatter->asNtext($post->description), '100', '...')  ?></p>
                    <p><a href="<?= Html::encode( Url::to(['category', 'id'=>$post->category->id])) ?>">
                            <div class="articles_date">
                    <p><?= Html::encode($post->category->title) ?></a></p>
                             </div>


                </figcaption>
            </figure>
        </article>

</div>





