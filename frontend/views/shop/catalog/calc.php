<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category shop\entities\Shop\Category */
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use frontend\widgets\shop\TagShopWidget;
use frontend\widgets\Shop\FilterWidget;
use shop\entities\Shop\Characteristic;
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

//var_dump($product->values);
?>






<!--product details start-->

<h1 style='padding-left:15px;'>Калькулятор световых панелей</h1>
            <div class="col-lg-6 col-md-6">
        
                <div class="product_d_right">


                    

                     



                            <?php $form = ActiveForm::begin([]) ?>

                          


<div class="for-select-activeform">
    <h4>Категория:</h4>
        <?php echo $form->field($model, 'category')->radioList(['Кристалайт' => 'Кристалайт'])->label(false) ?>
</div>


<div class="for-select-activeform">
  <h4>Способ крепления:</h4>
    <?php echo $form->field($model, 'krepl')->radioList(['Настенная' => 'Настенная', 'Подвесная' => 'Подвесная'],['onchange'=>"change(this)"] )->label(false) ?>
</div>

<div class="for-select-activeform">
<h4>Количество сторон:</h4>

    <?php echo $form->field($model, 'storon')->radioList(['Односторонняя' => 'Односторонняя', 'Двухсторонняя' => 'Двухсторонняя'],['onchange'=>"change(this)"] )->label(false) ?>
</div>

<div class="for-select-activeform">
<h4>Размер панели:</h4>
    <?php echo $form->field($model, 'size')->radioList($sizeArray,['onchange'=>"change(this)"] )->label(false) ?>
</div>

<div class ='size-choise' style='display:none; margin-bottom: 20px;'>
    
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
<h4>Количество панелей:</h4>
        <div class="quantity_inner">
                                    
            <?= $form->field($model, 'qty', ['template' => "<button class='btn-qty bt_minus'>-</button>{input}<button class='btn-qty bt_plus'>+</button>\n{error}",  'options' => [
                'tag' => false, // Don't wrap with "form-group" div
            ],])->input('number', ['min' => 1, 'class' => 'input-quantity']) ?>               
        </div>

</div>



<div class="product_variant quantity">
                                <!-- <label>Колличество</label> -->
                               
                                <?= Html::submitButton('Применить', ['class' => 'button']) ?>
    <?= Html::Button('Отправить заявку', ['class' => 'button', 'onclick' => 'sendModal()']) ?>
<!--                <a href="#calcFormModal" data-toggle="modal" class="moreinfo" >Отправить заявку</a></div>-->                            
                            </div>


                            <?php ActiveForm::end() ?>

                </div>
           

            </div>

            <div class="col-lg-6 col-md-6">
                <h3>Характеристики:</h3>
            <div class="product_info_content">
                    <?php 
                        $charMapFlip = array_flip($charMap);                      
                        $arraValues = [];
                        foreach($product->values as $value){
                            if( in_array($value->characteristic_id, $charMapFlip)){
                          
                                $arraValues[$charMap[$value->characteristic_id]] = $value->value;
                            }   
                        }
          

                    ?>
                                  <?= DetailView::widget([
                                        'model' => $product,
                                        // 'attributes' => array_map(function (Value $value) {
                                        //     return [
                                        //         'label' => $value->characteristic->name,
                                        //         'value' => $value->value,
                                        //     ];
                                        // }, $product->values),
                                        'attributes' =>
                                        [
                                            [
                                                'label' => 'Категория',
                                               'attribute' => 'category.name'
                                            ],
                                            [
                                                'label' => 'Способ крепления',
                                                'value' => $arraValues['krepl']
                                            ],
                                            [
                                                'label' => 'Количество сторон',
                                                'value' => $arraValues['storon']
                                            ],
                                            [
                                                'label' => 'Размер',
                                                'value' => $arraValues['size']
                                            ],
                                            [
                                                'label' => 'Ширина панели',
                                                'value' => $arraValues['wight']
                                            ],
                                            [
                                                'label' => 'Высота панели',
                                                'value' => $arraValues['height']
                                            ],

                                            [
                                                'label' => 'Ширина постера',
                                                'value' => $arraValues['pwight']
                                            ],

                                            [
                                                'label' => 'Высота постера',
                                                'value' => $arraValues['phight']
                                            ],

                                            [
                                                'label' => 'Толщина',
                                                'value' => $arraValues['thiknes']
                                            ],

                                            [
                                                'label' => 'Вес',
                                                'value' => $product->weight
                                            ],

                                            [
                                                'label' => 'Потребляемая мощность',
                                                'value' => $arraValues['power']
                                            ],

                                            
                                            [
                                                'label' => 'Напряжение питания',
                                                'value' => $arraValues['voltage']
                                            ],
                                        ]
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
<?php echo 'Цена товара - '.$product->price_new;?>