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
        [
            'attribute' => 'id',
            'contentOptions' => [
                'class' => 'col-md-1'
            ]
        ],
        'name',
        'content',
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
        //'url:url',
        [
            'attribute' => 'enabled',
            'filter' => $searchModel::listsEnabled(),
            'value' => 'enable'
        ],
        ['class' => 'yii\grid\ActionColumn']
    ]
]);
