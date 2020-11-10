<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 19.07.2020
 * Time: 21:55
 *
 */
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<?php foreach ($comments as $comment):?>
<div class="post_wrapper">
    <div class="post_thumb">
        <a href=""><img src="<?php
            if ($comment->user->photo) {
                echo $comment->user->photo->getThumbFileUrl('file', 'admin');
            } else { echo '/assets/img/blog/comment3.png.jpg';}?>" alt="" style="object-fit: cover;width: 50px;height: 50px; max-width: inherit;"></a>
    </div>
    <div class="post_info">
        <span> <?= $comment->user_name ? $comment->user_name : 'Anonymus'?> сказал:</span>
        <a href="<?= Html::encode(Url::to(['blog/post/post', 'id'=>$comment->post_id])) ?>"><?php
            echo $comment->text;

            ?></a>
    </div>
</div>
<?php endforeach?>