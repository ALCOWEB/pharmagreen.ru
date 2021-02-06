<?php

namespace shop\forms\Shop\Order;

use yii\base\Model;

class CustomerForm extends Model
{
    public $phone;
    public $name;
    public $email;


    public function rules(): array
    {
        return [
            [['phone', 'name', 'email'], 'required', 'message' => 'это поле не может быть пустым'],
            [['phone', 'name', 'email'], 'string', 'max' => 255],

        ];
    }
}