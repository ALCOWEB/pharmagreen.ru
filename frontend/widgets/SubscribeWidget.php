<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 08.10.2020
 * Time: 22:06
 */


namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use shop\forms\SubscribeForm;


class SubscribeWidget extends Widget
{
    public $subscribe;
    public function init() {
        $this->subscribe = new SubscribeForm();
            parent::init();
    }

    public function run(): string
    {

        return $this->render('subscribe',[
            'model' => $this->subscribe,
        ]);
    }



}