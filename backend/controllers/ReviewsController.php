<?php

namespace backend\controllers;

use Yii;
use common\models\Reviews;
use common\models\ReviewsSearch;
use yii\web\NotFoundHttpException;

/**
 * ReviewsController implements the CRUD actions for Reviews model.
 */
class ReviewsController extends BaseController
{

    /**
     * Lists all Reviews models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviewsSearch();
        $searchModel->type_id = ReviewsSearch::TYPE_PRODUCT;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Reviews models.
     * @return mixed
     */
    public function actionFeedback()
    {
        $searchModel = new ReviewsSearch();
        $searchModel->type_id = ReviewsSearch::TYPE_FEEDBACK;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('feedback', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reviews model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reviews();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reviews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Reviews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reviews::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
    }

    /**
     * Set status an existing Order model.
     * If set status is successful, the browser will be redirected to the 'index' page.
     * @param $route
     * @param integer $id
     * @param string $status
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSetStatus($route, $id, $status)
    {
        $model = $this->findModel($id);
        if (!in_array($status, [$model::STATUS_NEW, $model::STATUS_ACCEPTED, $model::STATUS_REJECTED]))
            throw new NotFoundHttpException(Yii::t('main', 'Бундай буюртма ҳолати мавжуд эмас'));
        $model->setAttributes(['status' => (string)$status]);
        if (!$model->save())
            Yii::$app->session->setFlash('error', Yii::t('main', 'Формани сақлашда хатолик'));
        return $this->redirect($route);
    }
}
