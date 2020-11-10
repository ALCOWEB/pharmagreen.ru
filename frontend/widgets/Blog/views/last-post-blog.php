<?php

/** @var $posts shop\entities\Blog\Post\Post[] */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
?>

<?php foreach ($posts as $post):?>


    <?php $url = Url::to(['/blog/post/post', 'id' =>$post->id]);?>
<div class="post_wrapper">
    <div class="post_thumb">
    <?php if ($post->photo): ?>
        <a href="<?= Html::encode($url)?>"><img src="<?= Html::encode($post->getThumbFileUrl('photo', 'last-post-blog')) ?>" alt="" class="" /></a>
    <?php endif; ?>
    </div>
    <div class="post_info">
        <h4><a href="<?= Html::encode($url)?>"><?= Html::encode(StringHelper::truncate($post->title, 25))?></a></h4>
        <span><?= Yii::$app->formatter->asDatetime($post->created_at) ?></span>
    </div>
</div>
<?php endforeach;?>
