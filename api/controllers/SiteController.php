<?php
namespace api\controllers;

use shop\entities\User\User;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpHeaderAuth;
use yii\web\Controller;
use shop\entities\User\Session;
use Yii;
use yii\web\IdentityInterface;
use thamtech\uuid\helpers\UuidHelper;

class SiteController extends Controller
{
    protected $user;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $headers = Yii::$app->request->headers;
        $token = $accept = $headers->get('X-Api-Key');
        $session = Session::find()->where(['uuid' => $token])->one();
        if ($session) {
            $this->user = User::find()->where(['id' => $session->user_id])->one();
        } else {
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
        return [
            User::find()->one(),
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpHeaderAuth::class,
        ];
        return $behaviors;
    }
}