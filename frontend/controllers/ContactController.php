<?php
namespace frontend\controllers;
use shop\forms\FeedbackForm;
use shop\services\ContactService;
use Yii;
use yii\web\Controller;
use shop\forms\ContactForm;
use shop\forms\SubscribeForm;
class ContactController extends Controller
{
    private $service;

    public function __construct($id, $module, ContactService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->send($form);
                Yii::$app->session->setFlash('success', 'Спасибо, что написали нам, мы ответим в ближайшее время');
                return $this->goHome();
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        }
        return $this->render('index', [
            'model' => $form,
        ]);
    }

    public function actionSubscribe()
    {
        $form = new SubscribeForm();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($form->load(Yii::$app->request->post()) && $form->validate()) {



                return [

                        'success' => true,
                        'form' => $form,
                        'message' => 'Model has been saved.',

                ];
            }

            $result = [];
            // The code below comes from ActiveForm::validate(). We do not need to validate the model
            // again, as it was already validated by save(). Just collect the messages.
            foreach ($form->getErrors() as $attribute => $errors) {
                $result[yii\helpers\Html::getInputId($form, $attribute)] = $errors;
            }

            return $this->asJson(['validation' => $result]);
        }
    }


    public function actionFeedback()
    {
        $form = new FeedbackForm();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($form->load(Yii::$app->request->post()) && $form->validate()) {



                return [

                    'success' => true,
                    'form' => $form,
                    'message' => 'Model has been saved.',

                ];
            }

            $result = [];
            // The code below comes from ActiveForm::validate(). We do not need to validate the model
            // again, as it was already validated by save(). Just collect the messages.
            foreach ($form->getErrors() as $attribute => $errors) {
                $result[yii\helpers\Html::getInputId($form, $attribute)] = $errors;
            }

            return $this->asJson(['validation' => $result]);
        }
    }

}