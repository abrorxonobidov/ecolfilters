<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;
use common\helpers\GeneralHelper;

/**
 * @var $this yii\web\View
 * @var $model common\models\MetaTags
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Meta Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo GeneralHelper::oneRow([
    Html::tag('h2', $model->name),
    Html::a(Html::icon('pencil') . ' ' . Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'view-button btn btn-primary pull-right']) .
    Html::a(Html::icon('plus') . ' ' . Yii::t('yii', 'Create'), ['create'], ['class' => 'view-button btn btn-success pull-right']) .
    Html::a(Html::icon('list') . ' ' . Yii::t('main', 'Рўйхат'), ['index'], ['class' => 'view-button btn btn-info pull-right'])
]);

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'target_class',
        'target_id',
        'content_uz',
        'content_oz',
        'content_ru',
        'content_en',
        //'url:url',
        'enable',
        'created_at',
        'updated_at',
        'creator.full_name',
        'modifier.full_name',
    ],
]);
