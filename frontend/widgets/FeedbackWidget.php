<?php


namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use shop\forms\FeedbackForm;

class FeedbackWidget extends Widget
{
    public $feedbackForm;
    public function init()
    {
     $this->feedbackForm = new FeedbackForm();
    }

    public function run(){
        return $this->render('feedback', [
            'feedbackForm' => $this->feedbackForm
        ]);
    }

}