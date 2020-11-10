<?php
use yii\helpers\Html;
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 20.07.2020
 * Time: 21:10
 */



?>


<div class="tag_cloud">
    <?php foreach ($tags as $tag): ?>

            <?php echo Html::a(Html::encode($tag->name), ['shop/catalog/tag', 'id' => $tag->id]);?>

    <?php endforeach; ?>


</div>

