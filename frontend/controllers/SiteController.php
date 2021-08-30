<?php

namespace frontend\controllers;

use common\models\ListSearch;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction'
            ]
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'mainPage';

        return $this->render('index', [
            'dataProvider' => ListSearch::searchNews(6)
        ]);
    }

}
