<?php

namespace shop\forms\Shop\Order;

use yii\base\Model;
use shop\entities\Shop\PaymentMethod;
use yii\helpers\ArrayHelper;

class PaymentForm extends Model
{
    public $method;

    public function paymentMethodsList(): array
    {
        $methods = PaymentMethod::find()->all();

        return ArrayHelper::map($methods, 'id', function (PaymentMethod $method) {
            return $method->name;
        });
    }

    public function description($value){
        if ($value == 1){return 'Наличка';}
        if ($value == 2){return 'БК онлайн';}
    }

    public function rules(): array
    {
        return [
            [['method'], 'string', 'message' => 'это поле не может быть пустым'],

        ];
    }
}