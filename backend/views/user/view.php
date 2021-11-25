<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\User
 */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Фойдаланувчилар'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::tag('h2', $this->title);

if ($model->id == Yii::$app->user->id)
    echo Html::a(Yii::t('main', 'Таҳрирлаш'),
        ['update', 'id' => $model->id],
        ['class' => 'btn btn-primary pull-right']
    );

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'username',
        'full_name',
        'email:email',
        'statusName',
        'created_at:datetime',
        'updated_at:datetime'
    ]
]);