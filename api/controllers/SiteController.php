<?php
namespace api\controllers;

use shop\entities\User\User;
use shop\forms\auth\LoginForm;
use shop\services\auth\AuthService;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpHeaderAuth;
use yii\web\Controller;
use shop\entities\User\Session;
use Yii;
use yii\web\HttpException;
use yii\web\IdentityInterface;
use thamtech\uuid\helpers\UuidHelper;
use yii\web\Request;

class SiteController extends Controller
{
    protected $user;
    protected ?Session $session;
    protected ?string $token;
    protected $service;

    public function __construct($id, $module, AuthService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $headers = Yii::$app->request->headers;
        $this->token = $headers->get('X-Api-Key');
        $this->session = Session::find()->where(['uuid' => $this->token])->one();
//        if ($this->token && !$this->session) {
//            return;
//        }
        if ($this->session && $this->session->logged) {
            $this->user = User::find()->where(['id' => $this->session->user_id])->one();
            Yii::$app->user->login($this->user, 0);
        } else if (!$this->session && !$this->token) {
            $session = new Session();
            $session->uuid = md5(
                microtime() . "\n" .
                ($_SERVER['SERVER_ADDR'] ?? '-') . "\n" .
                ($_SERVER['REMOTE_ADDR'] ?? '-') . "\n" .
                ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? '-') . "\n" .
                ($_SERVER['X-ORIGINAL-FORWARDED-FOR'] ?? '-') . "\n" .
                join('.', array_keys(getallheaders())) . "\n" .
                join('.', getallheaders())
            );
            $session->save();
            $responseHeaders = Yii::$app->response->headers;
            $responseHeaders->set('X-Api-Key', $session->uuid);
            $this->session = $session;
        }
    }


    public function actionIndex(): array
    {
        return [
            'version' => '1.0.0',
        ];
    }

    public function actionTest(): array
    {
       return ['1.0.0'];
    }

    public function actionLogin(Request $request): array
    {
        if (!$this->session) {
            throw new HttpException(400,'no session', 10);
        }
        if ($this->session->uuid != $this->token) {
            throw new HttpException(400,'validation error', 11);
        }
        if ($this->session->logged == true) {
            throw new HttpException(400,'already logged', 12);
        } else {
            $form = new LoginForm();
            $form->rememberMe = false;
            $form->email = $request->post('email');
            $form->password = $request->post('password');

            if ($form->validate()) {
                try {
                    $user = $this->service->auth($form);
                    $this->session->logged = true;
                    $this->session->user_id = $user->id;
                    $date = new \DateTime('now');
                    $date->add(new \DateInterval('P7D'));
                    $this->session->expires = $date->format('Y-m-d H:i:s');
                    try {
                        $this->session->save();
                    } catch (\Exception $exception) {
                        throw $exception;
                    }
                    return ['X-Api-Key' => $this->session->uuid];
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            } else {
                throw new HttpException(400,'wrong password or email', 13);
            }
        }
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }
}