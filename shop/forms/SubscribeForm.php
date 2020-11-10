<?php
namespace shop\forms;
use yii\base\Model;
class SubscribeForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'это поле не может быть пустым'],
            ['email', 'email'],
        ];
    }

}