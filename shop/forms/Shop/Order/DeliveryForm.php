<?php

namespace shop\forms\Shop\Order;

use shop\entities\Shop\DeliveryMethod;
use shop\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DeliveryForm extends Model
{
    public $method;
    public $index;
    public $address;


    private $_weight;

    public function __construct(int $weight, array $config = [])
    {
        $this->_weight = $weight;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['method'], 'integer'],
            [['index', 'address', ], 'required', 'message' => 'это поле не может быть пустым'],
            [['index', 'address', ], 'string', 'max' => 255],

        ];
    }

    public function deliveryMethodsList(): array
    {
        $methods = DeliveryMethod::find()->availableForWeight($this->_weight)->orderBy('sort')->all();

        return ArrayHelper::map($methods, 'id', function (DeliveryMethod $method) {
            if ($method->cost){
            return $method->name . ' (' . PriceHelper::format($method->cost) . ')';}
            else {return $method->name;}
        });
    }

    public function description($value){
        if ($value == 1){return 'Почтой';}
        if ($value == 2){return 'Сдэк';}

    }
}