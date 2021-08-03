<?php

namespace backend\controllers;

use Yii;
use common\models\Order;
use common\models\OrderSearch;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends BaseController
{

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $params = Yii::$app->request->queryParams;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($params);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

//    /**
//     * Creates a new Order model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreate()
//    {
//        $model = new Order();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $route)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($route);
        }

        if (Yii::$app->request->isAjax)
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        else
            return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Active or Deactivate an existing Order model.
     * If activation or deactivation is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActivate($id)
    {
        $model = $this->findModel($id);
        $model->updateAttributes(['enabled' => $model->enabled === 1 ? 0 : 1]);
        return $this->redirect(['index']);
    }


    /**
     * Set status an existing Order model.
     * If set status is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $status
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSetStatus($route, $id, $status)
    {
        $model = $this->findModel($id);
        if (!in_array($status, [$model::STATUS_NEW, $model::STATUS_PROCESS, $model::STATUS_ACCEPTED, $model::STATUS_REJECTED]))
            throw new NotFoundHttpException(Yii::t('main', 'Бундай буюртма ҳолати мавжуд эмас'));
        $model->updateAttributes(['status' => (string)$status]);
        return $this->redirect($route);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
