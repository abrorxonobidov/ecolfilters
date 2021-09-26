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

    public function actionIndex()
    {
        return $this->render('index');
    }

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

    public function actionCompare($c_id)
    {
        $s = new ProductSearch();
        $searchModel = clone $s;
        $s->id = $c_id;
        $mainDataProvider = $s->searchFrontend([]);

        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->searchFrontend($params);

        return $this->render('compare', [
            'searchModel' => $searchModel,
            's' => $s,
            'mainDataProvider' => $mainDataProvider,
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionCompareView($c_id, $x_id)
    {
        return $this->render('compare_view', [
            'c' => $this->findModel($c_id),
            'x' => $this->findModel($x_id),
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
