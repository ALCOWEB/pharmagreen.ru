<?php
namespace shop\services\auth;

use shop\access\Rbac;
use shop\entities\User\User;
use shop\forms\auth\SignupForm;
use shop\forms\Shop\Order\OrderForm;
use shop\repositories\UserRepository;
use shop\services\RoleManager;
use shop\services\TransactionManager;
use yii\mail\MailerInterface;
use Yii;

class SignupService
{
    private $mailer;
    private $users;
    private $roles;
    private $transaction;

    public function __construct(
        UserRepository $users,
        MailerInterface $mailer,
        RoleManager $roles,
        TransactionManager $transaction
    )
    {
        $this->mailer = $mailer;
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }
    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->email,
            $form->phone,
            $form->username,
            $form->password,
        );

        $this->users->save($user);
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $user, 'password' => $form->password]
            )
            ->setTo($form->email)
            ->setFrom(['info@pharmagreen.ru' => 'Письмо с сайта'])
            ->setSubject('Signup confirm for ' . \Yii::$app->name)
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }
    }



    public function getByEmail($email){
       return $this->users->getByEmail($email);
    }

    public function getByPhone($phone){
        return $this->users->getByPhone($phone);
    }

    public function getByEmailorPhone($email, $phone){
        return $this->users->getByEmailorPhone($email, $phone);
    }

    public function gen_password($length = 8)
    {				
	$chars = 'qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP'; 
	$size = strlen($chars) - 1; 
	$password = ''; 
	while($length--) {
		$password .= $chars[random_int(0, $size)]; 
	}
	return $password;
    }


    public function signup_order(OrderForm $form)
    {

        $password = $this->gen_password();
        $user = User::requestSignup(
            $form->customer->email,
            $form->customer->phone,
            $password
        );

        $this->users->save($user);

//        $sent = $this->mailer
//            ->compose(
//                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
//                ['user' => $user, 'password' => $password]
//            )
//            ->setTo($form->customer->email)
//            ->setFrom(['info@pharmagreen.ru' => 'Письмо с сайта'])
//            ->setSubject('Signup confirm for ' . \Yii::$app->name)
//            ->send();
//        if (!$sent) {
//            throw new \RuntimeException('Email sending error.');
//        }
        return $password;
    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }
        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });
        if(Yii::$app->user->isGuest){
            Yii::$app->user->login($user);
        }
        else {
            if (Yii::$app->user->id != $user->id) {
                Yii::$app->user->logout();
                Yii::$app->user->login($user);
            }

          }



    }
}