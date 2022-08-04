<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category shop\entities\Shop\Category */
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use frontend\widgets\shop\TagShopWidget;
use frontend\widgets\Shop\FilterWidget;
use shop\PanelList\PanelList;
use yii\widgets\DetailView;
use shop\entities\Shop\Product\Value;
$this->title = 'Калькулятор';
$this->params['breadcrumbs'][] = $this->title;

//echo 'price_new = ' . $product->price_new . '<br />';
$list = new PanelList();
$sizeArray = [];
foreach($list->sizes as $key => $val){
    if (strpos($key, '+')){
        $sizeArray[$key] = $key . ' (постер - '.$val.')';
    } else {$sizeArray[$key] = $key . ' (габарит - '.$val.')';}

}
$sizeArray['Свой размер'] = 'Свой размер';
//var_dump($model);
echo 'Цена товара - '.$product->price_new;
//var_dump($product->values);
?>






<!--product details start-->


            <div class="col-lg-6 col-md-6">
               
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product_d_right">


                        <h1>Калькулятор световых панелей</h1>

                     



                            <?php $form = ActiveForm::begin([]) ?>

                          

                            <div id="position"  style="display: none" onclick="hideFilterButton(this)">  <?= Html::submitButton('Применить', ['class' => 'arrow-5 arrow-5-right']) ?></div>

<div class="for-select-activeform">
        <?php echo $form->field($model, 'category')->radioList(['Кристалайт' => 'Кристалайт']) ?>
</div>


<div class="for-select-activeform">
    <p class="choise-tag">Способ крепления:</p>
    <?php echo $form->field($model, 'krepl')->radioList(['Настенная' => 'Настенная', 'Подвесная' => 'Подвесная'],['onchange'=>"change(this)"] )->label(false) ?>
</div>

<div class="for-select-activeform">
    <p class="choise-tag">Количество сторон:</p>
    <?php echo $form->field($model, 'storon')->radioList(['Односторонняя' => 'Односторонняя', 'Двусторонняя' => 'Двусторонняя'],['onchange'=>"change(this)"] )->label(false) ?>
</div>

<div class="for-select-activeform">
    <p class="choise-tag">Размер панели:</p>
    <?php echo $form->field($model, 'size')->radioList($sizeArray,['onchange'=>"change(this)"] )->label(false) ?>
</div>

<div class ='size-choise'>
    
<?= $form->field($model, 'wight', [
        'template' => '{label}{input}',
        'options' => [
            'tag'=>false
        ],
        'inputOptions' => [
            'placeholder' => 'Ширина, мм',
            'class' => 'quantity-num',
            'size' => 8
        ]

    ])->textInput(['onchange' => 'change(this)'])->label('Ширина: ') ?>

    <?= $form->field($model, 'height', [
        'template' => '{label}{input}',
        'options' => [
            'tag'=>false
        ],
        'inputOptions' => [
            'placeholder' => 'Высота, мм',
            'class' => 'quantity-num',
            'size' => 7
        ]

    ])->textInput(['onchange' => 'change(this)'])->label('Высота: ') ?>

 
</div>


<div class="for-select-activeform">
    <p class="choise-tag">Количество панелей:</p>
        <div class="quantity_inner">
                                    
            <?= $form->field($model, 'qty', ['template' => "<button class='btn-qty bt_minus'>-</button>{input}<button class='btn-qty bt_plus'>+</button>\n{error}",  'options' => [
                'tag' => false, // Don't wrap with "form-group" div
            ],])->input('number', ['min' => 1, 'class' => 'input-quantity']) ?>
                                
        </div>
</div>





<div class="productcardmoreinfo" id="goHere">
    <?= Html::submitButton('Применить', ['class' => 'moreinfo']) ?>
    <?= Html::Button('Отправить заявку', ['class' => 'moreinfo', 'onclick' => 'sendModal()']) ?>
<!--                <a href="#calcFormModal" data-toggle="modal" class="moreinfo" >Отправить заявку</a></div>-->
</div>


                            <?php ActiveForm::end() ?>

                </div>
                <div class="product_info_content">
                                  <?= DetailView::widget([
                                        'model' => $product,
                                        'attributes' => array_map(function (Value $value) {
                                            return [
                                                'label' => $value->characteristic->name,
                                                'value' => $value->value,
                                            ];
                                        }, $product->values),
                                    ]) ?>
                            </div>

            </div>


<!--product details end-->

<!--product info start-->
<!-- <div class="product_d_info mb-65">
    <div class="container">
        
        </div>
    </div> -->
<!--product info end-->
