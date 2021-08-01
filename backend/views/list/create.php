<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $model common\models\Lists
 */

$this->title = Yii::t('yii', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::$app->request->get('ci') ? $model->category->titleLang : Yii::t('main', 'Рўйхат'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


echo Html::tag('h1', $this->title);

echo $this->render('_form', [
    'model' => $model,
]);
