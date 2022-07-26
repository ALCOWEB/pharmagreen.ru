<?php
/* @var $this \yii\web\View */
/* @var $content string */

use kartik\field\FieldRange;

use shop\entities\Shop\Product\Product;
?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>


    <!--shop  area start-->
    <div class="shop_area shop_reverse mt-70 mb-70">
        <div class="container">
            <div class="row">
              

              
                    <?= $content ?>

            </div>
        </div>
    </div>
    <!--shop  area end-->


<?php $this->endContent() ?>