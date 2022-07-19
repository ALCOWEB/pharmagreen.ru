<?php

namespace shop\forms\Shop\Order;

use yii\base\Model;

class CustomerForm extends Model
{
    public $phone;
    public $name;
    public $email;
    public $companyName;
    public $inn;
    public $urAddress;
 

    public function rules(): array
    {
        return [
            [['phone'], 'required', 'message' => '"Телефон" не может быть пустым'],
            [['name'], 'required', 'message' => '"Имя" не может быть пустым'],
            [['companyName'], 'required', 'message' => '"Название компании" не может быть пустым'],
            [['inn'], 'required', 'message' => '"ИНН" не может быть пустым'],
            [['email'], 'required', 'message' => '"E-Mail" не может быть пустым'],
            [['phone', 'name', 'email', 'companyName', 'urAddress'], 'string', 'max' => 255],
            [['inn'], 'integer'],

        ];
    }
}