<?php

use yii\grid\GridView;

/**
 * @var $this yii\web\View
 * @var $searchModel common\models\MetaTagsSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('main', 'Meta Tag');
$this->params['breadcrumbs'][] = $this->title;

echo common\helpers\GeneralHelper::titleAndCreateBtn($this->title);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        [
            'attribute' => 'id',
            'contentOptions' => [
                'class' => 'col-md-1'
            ]
        ],
        [
            'attribute' => 'target_class',
            'value' => 'targetClassTitle',
            'filter' => $searchModel::typeList()
        ],
        [
            'attribute' => 'target_id',
            'value' => 'targetIdTitle',
            'contentOptions' => [
                'class' => 'col-md-3'
            ]
        ],
        [
            'attribute' => 'content',
            'value' => function ($model) {
                return yii\helpers\Html::ul([
                    "<b>UZ:</b> $model->content_uz",
                    "<b>OZ:</b> $model->content_oz",
                    "<b>RU:</b> $model->content_ru",
                    "<b>EN:</b> $model->content_en",
                ], ['encode' => false]);
            },
            'format' => 'raw'
        ],
        //'url:url',
        [
            'attribute' => 'enabled',
            'filter' => $searchModel::listsEnabled(),
            'value' => 'enable'
        ],
        ['class' => 'yii\grid\ActionColumn']
    ]
]);
