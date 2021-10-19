<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\ProductCategory
 */

$this->title = $model->titleLang;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Маҳсулот категориялари'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-view">

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
            'title_uz',
            'title_oz',
            'title_ru',
            'title_en',
            'order',
            [
                'attribute' => 'image',
                'value' => Html::img($model::imageSourcePath() . $model->image, ['class' => 'col-md-4'])
                    . ' ' . Html::tag('p', $model->image),
                'format' => 'raw'
            ],
            'test_drive:boolean',
            'enabled:boolean',
            'created_at',
            'updated_at',
            'creator.full_name',
            'modifier.full_name',
        ],
    ]) ?>

</div>
