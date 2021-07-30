<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Products');
$this->params['breadcrumbs'][] = $this->title;

echo common\helpers\GeneralHelper::titleAndCreateBtn($this->title);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'title_uz',
        [
            'attribute' => 'product_category_id',
            'value' => 'productCategory.titleLang',
            'filter' => common\models\ProductCategory::getList()
        ],
        [
            'attribute' => 'place_id',
            'value' => 'place.titleLang'
        ],
        [
            'attribute' => 'preview_image',
            'value' => function (common\models\Product $model) {
                return $model->preview_image ? Html::img($model::imageSourcePath() . $model->preview_image, ['class' => 'col-md-3']) : '';
            },
        ],
        'price',
        ['class' => 'yii\grid\ActionColumn']
    ]
]);
