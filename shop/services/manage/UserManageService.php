<?php
namespace shop\services\manage;
use shop\entities\User\User;
use shop\forms\manage\User\UserCreateForm;
use shop\forms\manage\User\UserEditForm;
use shop\forms\manage\User\UserPhotoForm;
use shop\repositories\UserRepository;
use shop\services\RoleManager;
use shop\services\TransactionManager;

class UserManageService
{
    private $repository;
    private $roles;
    private $transaction;

    public function __construct(UserRepository $repository, RoleManager $roles, TransactionManager $transaction)
    {
        $this->repository = $repository;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(

            $form->email,
            $form->phone,
            $form->password
        );
        $user->addPhoto($form->photo->file[0]);
        $user->photo->user_id = $user->id;
        $user->photo->sort = 1;

        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
        return $user;
    }
    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(

            $form->phone,
            $form->email
        );
       $user->addPhoto($form->photo->file[0]);
       $user->photo->user_id = $user->id;
       $user->photo->sort = 1;



        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
    }

    public function addPhotos($id, UserPhotoForm $form): void
    {
        $user = $this->repository->get($id);
        $user->addPhoto($form->file[0]);
        $user->photo->user_id = $id;
        $user->photo->sort = 1;
        $this->repository->save($user);
    }

    public function removePhoto($id): void
    {
        $user = $this->repository->get($id);
        $user->photo->delete();

        $this->repository->save($user);
    }

    public function assignRole($id, $role): void
    {
        $user = $this->repository->get($id);
        $this->roles->assign($user->id, $role);
    }


    public function remove($id): void
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
    }
}