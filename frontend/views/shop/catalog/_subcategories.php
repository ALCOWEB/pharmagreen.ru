<?php
/* @var $category shop\entities\Shop\Category */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if ($category->children): ?>
    <div class="panel panel-default">
        <div class="row">
            <?php foreach ($category->children as $child): ?>
                <div class="col-md-3">
                    <div class="single_banner">
                        <div class="banner_thumb">
                            <a href="<?= Html::encode(Url::to(['/shop/catalog/category', 'id' => $child->id])) ?>">
                                <?= Html::encode($child->name) ?>
                                <img src="<?= $child->getThumbFileUrl('photo', 'thumb') ?>" alt="">
                            </a>
                        </div>
                    </div>
<!--                    <img src="--><?php //= $child->getThumbFileUrl('photo', 'thumb') ?><!--">-->
<!--                    <a href="--><?php //= Html::encode(Url::to(['/shop/catalog/category', 'id' => $child->id])) ?><!--">--><?php //= Html::encode($child->name) ?><!--</a> &nbsp;-->
                </div>

            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>