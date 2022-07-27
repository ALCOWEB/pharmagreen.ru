<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $tag shop\entities\Shop\Tag */
use yii\helpers\Html;
$this->title = 'Products with tag ' . $tag->name;
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $tag->name;
?>


<div class="col-lg-9 col-md-12">
<?php
// echo $this->render('_filter', [
//     'search' => $search
// ]) 
?>

<h1>Товары с тэгом &laquo;<?= Html::encode($tag->name) ?>&raquo;</h1>
<?= $this->render('_list', [
    //'search' => $search,
    'dataProvider' => $dataProvider
]) ?>      





          

</div>