<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
use yii\widgets\LinkPager;
?>

<div class="blog_wrapper">
    <div class="row">
    <?php foreach ($dataProvider->getModels() as $post): ?>
        <?= $this->render('_post', [
            'post' => $post
        ]) ?>
    <?php endforeach; ?>
    </div>
</div>
<!--blog pagination area start-->
<div class="blog_pagination">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="pagination">
                    <?= LinkPager::widget([
                        'pagination' => $dataProvider->getPagination(),
                        'options' =>['class' => '']
                    ]) ?>

                    <p style="padding-top: 3px;padding-left: 15px;">Показано <?= $dataProvider->getCount() ?> из <?= $dataProvider->getTotalCount() ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--blog pagination area end-->

