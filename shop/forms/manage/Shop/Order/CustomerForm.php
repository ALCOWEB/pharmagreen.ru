<?php

namespace shop\forms\manage\Shop\Order;

use shop\entities\Shop\Order\Order;
use yii\base\Model;

class CustomerForm extends Model
{
    public $phone;
    public $first_name;
    public $last_name;
    public $email;

    public function __construct(Order $order, array $config = [])
    {
        $this->phone = $order->customerData->phone;
        $this->first_name = $order->customerData->first_name;
        $this->last_name = $order->customerData->last_name;
        $this->email = $order->customerData->email;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['phone', 'first_name', 'last_name', 'email',], 'required'],
            [['phone', 'first_name', 'last_name', 'email',], 'string', 'max' => 255],
        ];
    }
}