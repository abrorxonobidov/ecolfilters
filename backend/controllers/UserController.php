<?php

namespace backend\controllers;

use backend\models\UserForm;
use common\models\UserSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => (new UserSearch())->search($this->request->queryParams)
        ]);
    }


    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }


    public function actionCreate()
    {
        $model = new UserForm();

        $model->scenario = 'create';

        if ($model->load($this->request->post())) {
            $model->setPassword($model->password);
            $model->generateAuthKey();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Маълумотлар сақланди');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('danger', 'Хатолик юз берди');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->setScenario('update');

        if ($model->id != Yii::$app->user->id) {
            Yii::$app->session->setFlash('danger', 'Рухсат берилмаган');
            return $this->redirect(['/user/index']);
        }

        if ($model->load($this->request->post())) {
            if ($model->password) {
                if ($model->validatePassword($model->password)) {
                    $model->setPassword($model->new_password);
                    $model->generateAuthKey();
                } else {
                    $model->addError('password', 'Парол мос келмади');
                    $model->password = '';
                    $model->new_password = '';
                    $model->repeat_password = '';
                }
            }
            if (empty($model->errors) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Маълумотлар сақланди');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('danger', 'Хатолик юз берди');
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
        if (($model = UserForm::findOne($id)) === null)
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        return $model;

    }

}
