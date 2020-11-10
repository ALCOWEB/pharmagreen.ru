<?php
use yii\helpers\Html;
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 20.07.2020
 * Time: 21:10
 */



?>


<ul>
    <?php foreach ($postWithTags as $tag): ?>
        <li>
              <?php echo Html::a(Html::encode($tag->name), ['tag', 'slug' => $tag->slug]);?></li>

              <?php endforeach; ?>


</ul>