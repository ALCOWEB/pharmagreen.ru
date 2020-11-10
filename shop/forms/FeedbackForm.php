<?php


namespace shop\forms;
use yii\base\Model;

class FeedbackForm extends Model
{
   public $mailOrPhone;

   public function rules(){

       return [
           ['mailOrPhone', 'required', 'message' => 'Это поле не должно быть пустым']
       ];

   }


}