<?php
namespace frontend\controllers;

use common\models\Order;
use common\models\Product;
use common\models\ProductSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class ProductController extends Controller
{

    public function actionCategory()
    {
        $params = Yii::$app->request->queryParams;
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->searchFrontend($params);
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return Product|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }

    public function actionCreateOrder($pid)
    {
        $model = new Order();
        $model->product_id = $pid;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        if (Yii::$app->request->isAjax)
            return $this->renderAjax('create-order', [
                'model' => $model,
            ]);
        else
            return $this->render('create-order', [
                'model' => $model,
            ]);
    }

    /**
     * @param $id
     * @return Order|null
     * @throws NotFoundHttpException
     */
    protected function findOrder($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }

}
