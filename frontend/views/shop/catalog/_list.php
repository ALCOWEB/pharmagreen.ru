<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */


use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<!--shop wrapper start-->
<!--shop toolbar start-->
<div class="shop_toolbar_wrapper">
    <div class="shop_toolbar_btn">

        <button data-role="grid_3" type="button" class="active btn-grid-3" data-toggle="tooltip" title="3"></button>

        <button data-role="grid_4" type="button"  class=" btn-grid-4" data-toggle="tooltip" title="4"></button>

        <button data-role="grid_list" type="button"  class="btn-list" data-toggle="tooltip" title="List"></button>
    </div>
    <div class=" niceselect_option">

            <select id="input-sort" class="form-control" onchange="location = this.value;">
                <?php
                $values = [
                    '' => 'Без сортировки',
                    'name' => 'Имя (А - Я)',
                    '-name' => 'Имя (Я - А)',
                    'price' => 'Цена (низкая &gt; высокая)',
                    '-price' => 'Цена (высокая &gt; низкая)',
                    '-rating' => 'Рейтинг (высокий)',
                    'rating' => 'Рейтинг (низкий)',
                ];
                $current = Yii::$app->request->get('sort');
                ?>
                <?php foreach ($values as $value => $label): ?>
                    <option value="<?= Html::encode(Url::current(['sort' => $value ?: null])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>

    </div>
    <?php 
        $searchForm = ActiveForm::begin(['method' => 'GET']);
           echo  $searchForm->field($search, 'storon')->textInput(['maxlength' => true]);

          ActiveForm::end();              
    ?>
    <div class="page_amount">
        <select id="input-limit" class="form-control" onchange="location = this.value;">
            <?php
            $values = [3, 25, 50, 75, 100];
            $current = $dataProvider->getPagination()->getPageSize();
            ?>
            <?php foreach ($values as $value): ?>
                <option value="<?= Html::encode(Url::current(['per-page' => $value])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $value ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<!--shop toolbar end-->

<div class="row shop_wrapper">
    <?php foreach ($dataProvider->getModels() as $product): ?>
        <?= $this->render('_product', [
            'product' => $product
        ]) ?>
    <?php endforeach; ?>
</div>

<div class="shop_toolbar t_bottom">

    <div class="pagination">
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
        ]) ?>
    </div>
    <div><p>Показано <?= $dataProvider->getCount() ?> из <?= $dataProvider->getTotalCount() ?></p></div>

</div>
<!--shop toolbar end-->
<!--shop wrapper end-->
