<?php

namespace shop\forms\User;

use shop\entities\User\User;
use yii\base\Model;
use shop\forms\CompositeForm;
use shop\forms\manage\User\UserPhotoForm;
class ProfileEditForm  extends CompositeForm
{
    public $phone;
    public $email;

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->photo = new UserPhotoForm();
        $this->_user = $user;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['phone', 'email'], 'required'],
            ['email', 'email'],
            [['email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 255],
            [['phone', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
        ];
    }

    protected function internalForms(): array
    {
        return ['photo'];
    }
}