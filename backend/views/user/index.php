<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $this yii\web\View
 * @var $searchModel common\models\UserSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('app', 'Фойдаланувчилар');
$this->params['breadcrumbs'][] = $this->title;

echo Html::tag('h2', $this->title);

echo Html::a(Yii::t('app', 'Қўшиш'), ['create'], ['class' => 'btn btn-success pull-right']);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => false,
    'columns' => [
        [
            'attribute' => 'username',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a($data->username, ['view', 'id' => $data->id], ['class' => 'pjaxModalButton']);
            }
        ],
        'full_name',
        'email:text',
        [
            'attribute' => 'status',
            'value' => 'statusName'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}',
            'visibleButtons' => [
                'update' => function ($model) {
                    return $model->id === Yii::$app->user->id;
                }
            ]
        ]
    ]
]);
