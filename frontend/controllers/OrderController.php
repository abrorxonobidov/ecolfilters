<?php

namespace frontend\controllers;

use common\models\Product;
use Yii;
use common\models\Order;
use common\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param null $pid
     * @return mixed
     */
    public function actionCreate($pid = null)
    {
        $model = new Order();
        if ($pid !== null && Product::find()->where(['id' => (int)$pid])->exists())
            $model->product_id = (int)$pid;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success',Yii::t('main','Сизнинг буюртмангиз муваққиятли юборилди!'));
            if (!empty($model->product_id))
                return $this->redirect(['product/view', 'id' => $model->product_id]);
            return $this->redirect(['/site/index']);
        }

        if (Yii::$app->request->isAjax)
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        else
            return $this->render('create', [
                'model' => $model,
            ]);
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
