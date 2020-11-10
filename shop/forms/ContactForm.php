<?php
namespace shop\forms;
use Yii;
use yii\base\Model;
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required', 'message' => 'это поле не может быть пустым'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
}