<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $this yii\web\View
 * @var $searchModel common\models\ProductCategorySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('main', 'Маҳсулот категориялари');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a(Yii::t('main', 'Яратиш'), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title_uz',
        'title_oz',
        'title_ru',
        'title_en',
        [
            'attribute' => 'image',
            'value' => function ($model) {
                return $model->image ?
                    Html::img($model::imageSourcePath() . $model->image, ['class' => 'img-responsive img-thumbnail']) .
                    Html::tag('p', $model->image, ['style' => 'font-size:10px;'])

                    : '';
            },
            'format' => 'raw',
            'headerOptions' => [
                'class' => 'col-md-2'
            ],
        ],
        'order',
        'test_drive:boolean',
        'enabled:boolean',
        ['class' => 'yii\grid\ActionColumn']
    ]
]) ?>


