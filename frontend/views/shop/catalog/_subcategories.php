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
                                <img
                                        style="object-fit: cover; height: 230px; width: 100%;"
                                        src="<?= $child->getThumbFileUrl('photo', 'thumb') ?>"
                                        alt=""
                                >
                                <h4 style="text-align: center; margin-top: 10px;">
                                    <?= Html::encode($child->name) ?>
                                </h4>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>