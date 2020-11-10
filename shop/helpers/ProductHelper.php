<?php
namespace shop\helpers;
use shop\entities\Shop\Product\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
class ProductHelper
{
    public static function statusList(): array
    {
        return [
            Product::STATUS_DRAFT => 'Draft',
            Product::STATUS_ACTIVE => 'Active',
        ];
    }


    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusNew(Product $product): string
    {
            if ($product->new){
                return Html::tag('span', 'Новинка', [
                    'class' => 'label label-success',
                ]);
            } else { return Html::tag('span', 'Обычный', [
                'class' => 'label label-default']);
            }
    }
    public static function statusSale(Product $product): string
    {
        if ($product->sale){
            return Html::tag('span', 'Скидка', [
                'class' => 'label label-success',
            ]);
        } else { return Html::tag('span', 'Обычный', [
            'class' => 'label label-default']);
        }
    }





    public static function statusLabel($status): string
    {
        switch ($status) {
            case Product::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Product::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}