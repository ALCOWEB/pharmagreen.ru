<?php

/* @var $item \frontend\widgets\Blog\CommentView */
?>



<div class="comment_list" data-id="<?= $item->comment->id ?>">
    <div class="comment_thumb">
        <img src="<?php
        if ($item->comment->user->photo) {
            echo $item->comment->user->photo->getThumbFileUrl('file', 'admin');
        } else { echo '/assets/img/blog/comment3.png.jpg';}?>" alt="" style="background-size: cover;overflow: hidden;">
    </div>
    <div class="comment_content">
        <div class="comment_meta">
            <h5><?= $item->comment->user->username ?></h5>
            <span><?= Yii::$app->formatter->asDatetime($item->comment->created_at) ?></span>
        </div>
        <p>
            <?php if ($item->comment->isActive()): ?>
                <?= Yii::$app->formatter->asNtext($item->comment->text) ?>
            <?php else: ?>
                <i>Этот комментарий удалён</i>
            <?php endif; ?>
        </p>
        <div class="comment_reply">
            <span class="comment-reply">Ответить</span>
        </div>
    </div>
    <div class="margin">
        <div class="reply-block"></div>
        <div class="comments">
            <?php foreach ($item->children as $children): ?>
                <?= $this->render('_comment', ['item' => $children]) ?>
            <?php endforeach; ?>
        </div>
    </div>

</div>

