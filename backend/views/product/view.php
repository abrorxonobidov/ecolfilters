<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\Product
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_category_id',
            'place_id',
            'gallery',
            'title_uz',
            'title_oz',
            'title_ru',
            'title_en',
            'price',
            'preview_uz:ntext',
            'preview_oz:ntext',
            'preview_ru:ntext',
            'preview_en:ntext',
            'description_uz:ntext',
            'description_oz:ntext',
            'description_ru:ntext',
            'description_en:ntext',
            'technic_uz:ntext',
            'technic_oz:ntext',
            'technic_ru:ntext',
            'technic_en:ntext',
            'video_uz',
            'video_oz',
            'video_ru',
            'video_en',
            'enabled',
            'created_at',
            'updated_at',
            'creator_id',
            'modifier_id',
        ],
    ]) ?>

</div>
