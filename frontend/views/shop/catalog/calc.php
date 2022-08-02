<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category shop\entities\Shop\Category */
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use frontend\widgets\shop\TagShopWidget;
use frontend\widgets\Shop\FilterWidget;
$this->title = 'Калькулятор';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $model = ActiveForm::begin() ?>

    <?php echo $model->field($form, 'category')->radioList(['Кристалайт' => 'Кристалайт']) ?>
    <?php echo $model->field($form, 'krepl')->radioList(['Подвесная' => 'Подвесная']) ?>
    <?php echo $model->field($form, 'storon')->radioList(['Односторонняя' => 'Односторонняя']) ?>
    <?php echo $model->field($form, 'segment')->radioList(['Стандарт' => 'Стандарт']) ?>
    <?php echo $model->field($form, 'wight')->input('integer') ?>
    <?php echo $model->field($form, 'height')->input('integer') ?>
    <?php echo Html::submitButton('Расчитать', ['class' => 'button'])?>

<?php $model = ActiveForm::end() ?>