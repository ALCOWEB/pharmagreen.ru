<?php
namespace shop\forms\manage\User;
use shop\entities\User\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use shop\forms\CompositeForm;


class UserCreateForm extends CompositeForm
{

    public $email;
    public $phone;
    public $password;
    public $role;

    public function __construct($config = [])
    {

        $this->photo = new UserPhotoForm();

        parent::__construct($config);
    }
    public function rules(): array
    {
        return [
            [['email', 'phone', 'role'], 'required'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email', 'phone'], 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
            ['phone', 'integer'],
        ];
    }

    public function rolesList(): array
    {
        return ArrayHelper::map(\Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    protected function internalForms(): array
    {
        return ['photo'];
    }
}