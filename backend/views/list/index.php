<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Lists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lists-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'title_uz',
            'title_oz',
            'title_ru',
            //'title_en',
            //'preview_uz',
            //'preview_oz',
            //'preview_ru',
            //'preview_en',
            //'description_uz:ntext',
            //'description_oz:ntext',
            //'description_ru:ntext',
            //'description_en:ntext',
            //'preview_image',
            //'gallery',
            //'order',
            //'region_id',
            //'inner_image',
            //'video',
            //'link',
            //'date',
            //'enabled',
            //'created_at',
            //'updated_at',
            //'creator_id',
            //'modifier_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
