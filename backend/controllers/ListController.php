<?php

namespace backend\controllers;

use common\models\BaseActiveRecord;
use common\models\Product;
use Yii;
use common\models\Lists;
use common\models\ListSearch;
use yii\web\NotFoundHttpException;

class ListController extends BaseController
{

    public function actionIndex($ci = null)
    {
        $searchModel = new ListSearch();
        $queryParams = Yii::$app->request->queryParams;
        if ($ci) $queryParams['ListSearch']['category_id'] = $ci;
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id, $ci = null)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $ci),
        ]);
    }

    public function actionCreate($ci = null)
    {
        $model = new Lists();
        $model->category_id = $ci;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->uploadImage('previewImageHelper', 'preview_image', 'list');
                $model->uploadGallery('helpGallery', 'gallery', 'list');
                return $this->redirect(['view', 'id' => $model->id, 'ci' => $model->category_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->uploadImage('previewImageHelper', 'preview_image', 'list');
                $model->uploadGallery('helpGallery', 'gallery', 'list');
                return $this->redirect(['view', 'id' => $model->id, 'ci' => $model->category_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id, $ci = null)
    {
        $this->findModel($id, $ci)->delete();

        return $this->redirect(['index', 'ci' => $ci]);
    }

    protected function findModel($id, $ci = null)
    {
        $model = Lists::find()
            ->where(['id' => $id])
            ->andFilterWhere(['category_id' => $ci])
            ->one();
        if ($model !== null) return $model;
        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
