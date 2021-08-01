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

    public function actionIndex()
    {
        $searchModel = new ListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Lists();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->uploadImage('previewImageHelper', 'preview_image', 'list');
                $model->uploadGallery('helpGallery', 'gallery', 'list');
                return $this->redirect(['view', 'id' => $model->id]);
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
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Lists::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
