<?php
namespace shop\forms\auth;
use yii\base\Model;
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;
    public function rules()
    {
        return [
            [['email', 'password'], 'required', 'message' => 'это поле необходимо заполнить'],
            ['rememberMe', 'boolean'],
        ];
    }
}