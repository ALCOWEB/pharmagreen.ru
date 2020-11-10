<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 15.07.2020
 * Time: 15:03
 *
 *
 */
use yii\helpers\Html;
use shop\entities\Shop\Category;
?>

<?php

?>

<div class="categories_menu">
                            <div class="categories_title">
                                <h2 class="categori_toggle">Все категории</h2>
                            </div>
                            <div class="categories_menu_toggle">
                                <ul>
                                <?php foreach ($categories->getTreeWithSubsOf($active instanceof shop\entities\Shop\Category ? $active : null) as $category): ?>
                                    <li class="menu_item_children">
                                    <?php
                                    if($category->children){$linkText = Html::encode($category->name) . '<i class="fa fa-angle-right"></i>';} else {$linkText = Html::encode($category->name);}
                                    echo Html::a($linkText,
                                    ['/shop/catalog/category', 'id' => $category->id],
                                        ['class' => $active && $active->id == $category->id ? 'active' : '']);?>
                                    <?php if ($category->children): ?>
                                         <ul class="categories_mega_menu column_5">
                                            <li class="menu_item_children"><?php echo
                                                    Html::a(Html::encode($category->children[0]->name),
                                                        ['/shop/catalog/category', 'id' => $category->children[0]->id],
                                                        ['class' => $active && $active->id == $category->id ? 'current-category' : '']); ?>
                                            </li>

                                        </ul>
                                    <?php endif ?>


                                    </li>
                                <?php endforeach ?>
                                </ul>

                            </div>
                        </div>