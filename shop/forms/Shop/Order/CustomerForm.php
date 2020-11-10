<?php

namespace shop\forms\Shop\Order;

use yii\base\Model;

class CustomerForm extends Model
{
    public $phone;
    public $first_name;
    public $last_name;
    public $email;


    public function rules(): array
    {
        return [
            [['phone', 'first_name', 'last_name', 'email'], 'required', 'message' => 'это поле не может быть пустым'],
            [['phone', 'first_name', 'last_name', 'email'], 'string', 'max' => 255],

        ];
    }
}