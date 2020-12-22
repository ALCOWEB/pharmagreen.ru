<?php
namespace frontend\controllers;
use yii\web\Controller;
/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'home';
        return $this->render('index');
    }

    public function actionPjaxtest()
    {

        return 'Привет ajax';
    }

    public function actionAbout()
    {
        $this->layout = 'blank';
        return $this->render('about');
    }

    public function actionContacts()
    {
        $this->layout = 'blank';
        return $this->render('contacts');
    }


}