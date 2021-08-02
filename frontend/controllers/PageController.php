<?php

namespace frontend\controllers;

use common\models\Lists;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class PageController extends Controller
{

    public function actionView($code)
    {
        return $this->render('view', [
            'page' => $this->findPage($code)
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

    protected function findPage($code)
    {
        if (($page = Lists::findOne(['link' => $code, 'enabled' => 1, 'category_id' => 1])) !== null)
            return $page;
        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
