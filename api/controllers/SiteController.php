<?php
namespace api\controllers;

use shop\entities\User\User;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpHeaderAuth;
use yii\web\Controller;

class SiteController extends Controller
{
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