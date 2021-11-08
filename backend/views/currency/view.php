<?php

use common\helpers\GeneralHelper;
use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Currency */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Валюта курси'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo GeneralHelper::oneRow([
    Html::tag('h2', $model->rate),
    Html::a(Html::icon('pencil') . ' ' . Yii::t('yii', 'Update'), ['update', 'id' => $model->id, 'ci' => Yii::$app->request->get('ci')], ['class' => 'view-button btn btn-primary pull-right']) .
    Html::a(Html::icon('plus') . ' ' . Yii::t('yii', 'Create'), ['create', 'ci' => Yii::$app->request->get('ci')], ['class' => 'view-button btn btn-success pull-right']) .
    Html::a(Html::icon('list') . ' ' . Yii::t('main', 'Рўйхат'), ['index', 'ci' => Yii::$app->request->get('ci')], ['class' => 'view-button btn btn-info pull-right'])
]);

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'rate',
        'enable',
        'created_at',
        'updated_at',
        'creator.full_name',
        'modifier.full_name',
    ],
]);
