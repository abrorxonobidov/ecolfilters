<?php
/**
 * Created by PhpStorm.
 * User: a_obidov
 * Date: 09.01.2021
 * Time: 18:37
 */

namespace backend\controllers;

use common\models\BaseActiveRecord;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * Class BaseController
 * @package backend\controllers
 */
class BaseController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionFileRemove()
    {
        $return = false;
        $file = BaseActiveRecord::uploadImagePath() . Yii::$app->request->post('key');
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
        $className = Yii::$app->request->post('className');
        $path = BaseActiveRecord::uploadImagePath()
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
            $model = $className::findOne(Yii::$app->request->post('id'));
            $model->gallery = '';
            $model->save();
        }

        return $return;
    }
};