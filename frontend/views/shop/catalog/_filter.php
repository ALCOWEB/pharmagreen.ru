<?php
use kartik\widgets\ActiveForm;
use frontend\widgets\Shop\TagShopWidget;
use yii\helpers\Url;
use yii\helpers\Html;

$price = explode(' - ', $search->price );
?>
<script>
    var low = <?php echo $search->priceRange[0]; ?>; // Don't forget the extra semicolon!
    var max = <?php echo $search->priceRange[1]; ?>; // Don't forget the extra semicolon!

    var lowSearch = <?php echo $price[0]; ?>; // Don't forget the extra semicolon!
    var maxSearch = <?php echo $price[1]; ?>; // Don't forget the extra semicolon!
    
</script>



<div class="col-lg-3 col-md-12">
                    <!--sidebar widget start-->
                    <aside class="sidebar_widget">
                        <div class="widget_inner">
                            <!-- <div class="widget_list widget_categories">
                                <h3>Women</h3>
                                
                                <ul>
                                    <li class="widget_sub_categories sub_categories1"><a href="javascript:void(0)">Shoes</a>
                                        <ul class="widget_dropdown_categories dropdown_categories1">
                                            <li><a href="#">Document</a></li>
                                            <li><a href="#">Dropcap</a></li>
                                            <li><a href="#">Dummy Image</a></li>
                                            <li><a href="#">Dummy Text</a></li>
                                            <li><a href="#">Fancy Text</a></li>
                                        </ul>
                                    </li>
                                    <li class="widget_sub_categories sub_categories2"><a href="javascript:void(0)">Bags</a>
                                        <ul class="widget_dropdown_categories dropdown_categories2">
                                            <li><a href="#">Flickr</a></li>
                                            <li><a href="#">Flip Box</a></li>
                                            <li><a href="#">Cocktail</a></li>
                                            <li><a href="#">Frame</a></li>
                                            <li><a href="#">Flickrq</a></li>
                                        </ul>
                                    </li>
                                    <li class="widget_sub_categories sub_categories3"><a href="javascript:void(0)">Clothing</a>
                                        <ul class="widget_dropdown_categories dropdown_categories3">
                                            <li><a href="#">Platform Beds</a></li>
                                            <li><a href="#">Storage Beds</a></li>
                                            <li><a href="#">Regular Beds</a></li>
                                            <li><a href="#">Sleigh Beds</a></li>
                                            <li><a href="#">Laundry</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div> -->
          
                            
                            <?php

 $action = [''];

 isset(Yii::$app->request->queryParams['id']) ? $action['id'] = Yii::$app->request->queryParams['id'] : '';
 ?>   

    <?php $searchForm = ActiveForm::begin(['method' => 'GET', 'action' => $action]);?>
           <div class="widget_list widget_filter">
                <h3>Розничная цена</h3>
                <div id="slider-range"></div>   
                <?=   $searchForm->field( $search, 'price')->textInput(['maxlength' => true, 'id' => 'amount', 'class' => null])->label(false);   ?>
                    
            </div>
<!--            --><?php //foreach ( as $item):?>
            <div class="widget_list widget_filter">
                <h3>Количество сторон</h3>
                <?php echo  $searchForm->field( $search, 'storon')->checkboxList(['Односторонняя' => 'Одна сторона', 'Двухсторонняя' => 'Две стороны'])->label(false); ?>
                </div>
<!--            --><?php //endforeach;?>
            <div class="widget_list widget_filter">
            <h3>Вариант крепления</h3>
            <?php echo  $searchForm->field( $search, 'krepl')->checkboxList(['Настенная' => 'Настенный', 'Подвесная' => 'Подвесной'])->label(false); ?>
                    
            </div>   

<!--            <div class="widget_list widget_filter">-->
<!--            <h3>Размер</h3>-->
<!--            --><?php //echo  $searchForm->field( $search, 'size')->checkboxList([
//                    'A4+' => 'A4+ (постер - 210x297)',
//                    'A3+' => 'A3+ (постер - 297x420)',
//                    'A2+' => 'A2+ (постер - 420x594)',
//                    'A1+' => 'A1+ 594x841',
//                    'A0+' => 'A0+ 841x1189',
//                    'AA' => 'AA 990x1500',
//                    '2AA' => '2AA 1200x1800',
//                     ])->label(false); ?>
<!--                    -->
<!--            </div>   -->

     <?php
      echo Html::submitButton('Применить', ['class' => 'button']);
        ActiveForm::end();
     ?>
                            <div class="widget_list tags_widget">
                            <h3>Тэги</h3>
                                <?= TagShopWidget::widget();?>
                            </div>
                            <div class="widget_list banner_widget">
                                <div class="banner_thumb">
                                    <a href="#"><img src="assets/img/bg/banner17.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </aside>
                    
                    <!--sidebar widget end-->
                </div>