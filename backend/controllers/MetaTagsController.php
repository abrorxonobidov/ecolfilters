<?php

namespace backend\controllers;

use common\helpers\DebugHelper;
use Yii;
use common\models\MetaTags;
use common\models\MetaTagsSearch;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

/**
 * MetaTagsController implements the CRUD actions for MetaTags model.
 */
class MetaTagsController extends BaseController
{

    public function actionIndex()
    {
        $searchModel = new MetaTagsSearch();
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

    public function actionCreate($tcl = null, $tid = null)
    {
        $model = new MetaTags();

        $model->target_class = $tcl;
        $model->target_id = $tid;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                DebugHelper::printSingleObject($model->errors, 1);
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
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                DebugHelper::printSingleObject($model->errors, 1);
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
        if (($model = MetaTags::findOne($id)) === null)
            throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
        return $model;
    }

    public function actionTargetList()
    {
        Yii::$app->response->format = 'json';
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $target_class = empty($ids[0]) ? null : $ids[0];
            if ($target_class != null) {
                $data = (new ActiveQuery($target_class::className()))
                    ->select([
                        'id',
                        'name' => 'title_' . Yii::$app->language
                    ])
                    ->orderBy('id')
                    ->asArray()
                    ->all();
                return ['output' => $data, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

}
