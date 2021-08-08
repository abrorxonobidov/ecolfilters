<?php

namespace frontend\controllers;

use common\models\ListSearch;
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
class SiteController extends Controller
{

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

    public function actionIndex()
    {
        $this->layout = 'mainPage';
        $lang = Yii::$app->language;
        $news = ListSearch::find()
            ->select([
                'id',
                'date',
                "title_$lang",
                "preview_$lang",
                'preview_image',
            ])
            ->where([
                'category_id' => 3,
                'enabled' => 1,
            ])
            ->orderBy([
                'date' => SORT_DESC,
                'order' => SORT_ASC
            ])
            ->limit(6)
            ->all();

        return $this->render('index', [
            'news' => $news
        ]);
    }

}
