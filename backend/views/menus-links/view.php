<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MenusLinks */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Menus links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="menus-links-view">

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
            'menu_id',
            'parent_id',
            'title_uz',
            'title_oz',
            'title_ru',
            'title_en',
            'link_in',
            'link_out:ntext',
            'order',
            'icon:ntext',
            'enabled',
            'created_at',
            'updated_at',
            'creator_id',
            'modifier_id',
        ],
    ]) ?>

</div>
