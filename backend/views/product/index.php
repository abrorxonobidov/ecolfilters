<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('main', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_category_id',
            'place_id',
            'gallery',
            'title_uz',
            //'title_oz',
            //'title_ru',
            //'title_en',
            //'price',
            //'preview_uz:ntext',
            //'preview_oz:ntext',
            //'preview_ru:ntext',
            //'preview_en:ntext',
            //'description_uz:ntext',
            //'description_oz:ntext',
            //'description_ru:ntext',
            //'description_en:ntext',
            //'technic_uz:ntext',
            //'technic_oz:ntext',
            //'technic_ru:ntext',
            //'technic_en:ntext',
            //'video_uz',
            //'video_oz',
            //'video_ru',
            //'video_en',
            //'enabled',
            //'created_at',
            //'updated_at',
            //'creator_id',
            //'modifier_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
