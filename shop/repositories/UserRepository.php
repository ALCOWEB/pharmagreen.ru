<?php
namespace shop\repositories;
use shop\entities\User\User;
class UserRepository
{
    public function findByPhoneOrEmail($value): ?User
    {
        return User::find()->andWhere(['or', ['phone' => $value], ['email' => $value]])->one();
    }
    public function getByEmailConfirmToken($token): User
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }
    public function findByNetworkIdentity($network, $identity): ?User
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }

    public function getByEmail($email): User
    {
        return $this->getBy(['email' => $email]);
    }

    public function getByPhone($phone): User
    {
        return $this->getBy(['phone' => $phone]);
    }

    public function getByEmailorPhone($email, $phone)
    {
        return User::find()->andWhere(['or', ['email' => $email], ['phone' => $phone]])->one();
    }


    public function getByPasswordResetToken($token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }
    public function existsByPasswordResetToken(string $token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }
    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
    private function getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }



    public function get($id): User
    {
        return $this->getBy(['id' => $id]);
    }

    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }


}