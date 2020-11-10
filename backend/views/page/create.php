<?php

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\PageForm */

$this->title = 'Create Page';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="page-create">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 26.07.2020
 * Time: 22:47
 */