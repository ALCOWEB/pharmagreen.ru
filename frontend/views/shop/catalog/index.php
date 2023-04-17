<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category shop\entities\Shop\Category */
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use frontend\widgets\shop\TagShopWidget;
use frontend\widgets\Shop\FilterWidget;
$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php //= $this->render('_filter', [
//    'search' => $search
//]) ?>

<div class="col-lg-12 col-md-12">
<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_subcategories', [
    'category' => $category
]) ?>

<?php //= $this->render('_list', [
//    //'search' => $search,
//    'dataProvider' => $dataProvider
//]) ?><!--             -->

</div>

