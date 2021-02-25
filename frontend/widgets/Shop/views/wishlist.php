<?php
use yii\helpers\Url;
use shop\readModels\Shop\ProductReadRepository;
?>
<a href="<?= Url::to(['/cabinet/wishlist/index']) ?>"><span class="lnr lnr-heart"></span> <span class="item_count"><?php echo ProductReadRepository::getWishListCount(\Yii::$app->user->id);?></span> </a>
