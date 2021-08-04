<?php
namespace frontend\controllers;

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

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }

}
