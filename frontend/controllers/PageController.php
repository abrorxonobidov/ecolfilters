<?php

namespace frontend\controllers;

use common\models\Lists;
use common\models\ListSearch;
use common\models\Place;
use common\models\ProductSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class PageController extends Controller
{

    public function actionPlace($code)
    {

        $params = Yii::$app->request->queryParams;
        $searchModel = new ProductSearch();
        $params['pli'] = Place::getIdByCode($code);
        $dataProvider = $searchModel->searchFrontend($params);

        return $this->render('place', [
            'page' => $this->findPageByCode($code),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($code)
    {
        return $this->render('view', [
            'page' => $this->findPageByCode($code)
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

        $model = $this->findModel($id);
        return $this->render('news', [
            'model' => $model,
        ]);
    }

    public function actionNewsList()
    {

        $dataProvider = ListSearch::searchNews();

        return $this->render('/site/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionService($code)
    {
        $this->layout = 'service';
        return $this->render('service', [
            'page' => $this->findPageByCode($code)
        ]);
    }

    protected function findPageByCode($code)
    {
        if (($page = Lists::findOne(['link' => $code, 'enabled' => 1, 'category_id' => 1])) !== null)
            return $page;
        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }

    protected function findModel($id, $category = 3)
    {
        if (($page = Lists::findOne(['id' => $id, 'enabled' => 1, 'category_id' => $category])) !== null)
            return $page;
        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
