<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
?>

<?php $this->beginContent('@frontend/views/layouts/main.php') ?>



    <section class="main_content_area">
        <div class="container">
            <!-- <h1><?php echo Html::encode($this->title);?></h1> -->

            <div class="row">

                    <?= $content ?>

            </div>


        </div>
    </section>
<?php $this->endContent() ?>