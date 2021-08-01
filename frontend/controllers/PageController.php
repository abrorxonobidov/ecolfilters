<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class PageController extends Controller
{

    public function actionView($code)
    {
        return $this->render('/site/error', [
            'message' => Yii::t('main', 'Маълумот тўлдирилмоқда'),
            'name' => '',
        ]);
    }

    public function actionTestDrive($id)
    {
        return $this->render('/site/error', [
            'message' => Yii::t('main', 'Маълумот тўлдирилмоқда'),
            'name' => '',
        ]);
    }

    public function actionStages($id)
    {
        return $this->render('/site/error', [
            'message' => Yii::t('main', 'Маълумот тўлдирилмоқда'),
            'name' => '',
        ]);
    }

    public function actionNews($id)
    {
        return $this->render('/site/error', [
            'message' => Yii::t('main', 'Маълумот тўлдирилмоқда'),
            'name' => '',
        ]);
    }

}
