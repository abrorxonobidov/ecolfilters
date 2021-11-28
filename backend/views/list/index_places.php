<?php

use yii\helpers\Html;
use common\models\Lists;

/**
 * @var $this yii\web\View
 * @var $searchModel common\models\ListSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('main', 'Жойлар');
$this->params['breadcrumbs'][] = $this->title;

echo yii\bootstrap\Html::tag('h2', $this->title);

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'title_uz',
        'link',
        'preview_uz:raw',
        [
            'attribute' => 'preview_image',
            'value' => function (Lists $model) {
                return $model->preview_image ?
                    Html::img($model::imageSourcePath() . $model->preview_image, ['class' => 'img-responsive img-thumbnail']) .
                    Html::tag('p', $model->preview_image, ['style' => 'font-size:10px;'])
                    : '';
            },
            'format' => 'raw',
            'headerOptions' => [
                'class' => 'col-md-2'
            ],
        ],
        'order',
        [
            'attribute' => 'enabled',
            'filter' => $searchModel::listsEnabled(),
            'value' => 'enable'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}'
        ]
    ]
]);
