<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 19.09.2020
 * Time: 15:23
 */

namespace shop\entities\Shop;
use yii\db\ActiveRecord;

class PaymentMethod extends ActiveRecord
{
    public static function create($name): self
    {
        $payment = new static();
        $payment->name = $name;
        return $payment;
    }

    public function edit($name): void
    {
        $this->name = $name;

    }

    public static function tableName(): string
    {
        return '{{%shop_payment_method}}';
    }

}