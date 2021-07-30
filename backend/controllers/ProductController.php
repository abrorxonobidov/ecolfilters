<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductSearch;
use common\models\BaseActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BaseController
{

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
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
     * Deletes an existing Product model.
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

    public function actionFileRemove()
    {
        $return = false;
        $file = Yii::getAlias('@frontend') . '/web/uploads/' . Yii::$app->request->post('key');
        $id = Yii::$app->request->post('id');
        $field = Yii::$app->request->post('field');
        $className = Yii::$app->request->post('className');
        $model = $className::findOne($id);
        /** @var $model yii\db\ActiveRecord */
        $model->$field = '';
        $model->updateAttributes([$field]);

        if (isset($file) && file_exists($file)) {
            unlink($file);
            $return = true;
        }
        return $return;
    }


    public function actionGalleryRemove()
    {
        $return = false;
        $path = Yii::$app->params['imageUploadPath']
            . Yii::$app->request->post('key')
            . '/';
        $file = $path . Yii::$app->request->post('imageName');
        if (isset($file) && file_exists($file)) {
            unlink($file);
            $return = true;
        }

        $images = glob($path . Yii::$app->params['allowedImageExtension'], GLOB_BRACE);

        if (count($images) == 0) {
            BaseActiveRecord::deleteDir($path);
            $model = Product::findOne(Yii::$app->request->post('id'));
            $model->gallery = '';
            $model->save();
        }

        return $return;
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
    }
}
