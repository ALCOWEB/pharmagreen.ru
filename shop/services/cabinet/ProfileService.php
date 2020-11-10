<?php

namespace shop\services\cabinet;

use shop\forms\User\ProfileEditForm;
use shop\repositories\UserRepository;

class ProfileService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function edit($id, ProfileEditForm $form): void
    {
        $user = $this->users->get($id);
        $user->editProfile($form->email, $form->phone);
        if ($form->photo->file[0] != null){
        $user->addPhoto($form->photo->file[0]);
        $user->photo->user_id = $user->id;
        $user->photo->sort = 1;}

        $this->users->save($user);
    }

    public function removePhoto($id): void
    {
        $user = $this->users->get($id);
        $user->photo->delete();
        $this->users->save($user);
    }
}