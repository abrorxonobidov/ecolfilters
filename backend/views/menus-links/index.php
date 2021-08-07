<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenusLinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yii', 'Menus Links');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-links-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'id','contentOptions' => ['width' => '5%']],
            [
                'attribute' => 'menu_id',
                'filter' => \common\models\Menus::getList('name'),
                'value' => function ($data) {
                    /** @var $data \common\models\MenusLinks */
                    return $data->menu->name ?? $data->menu_id;
                }
            ],
            [
                'attribute' => 'parent_id',
                'filter' => \common\models\MenusLinks::getList(),
                'value' => function ($data) {
                    /** @var $data \common\models\MenusLinks */
                    return $data->parent->titleLang ?? $data->parent_id;
                }
            ],
            'title_uz',
//            'title_oz',
//            'title_ru',
//            'title_en',
            'link_in',
            'link_out:ntext',
            'order',
            'icon:ntext',
            [
                'attribute' => 'enabled',
                'filter' => $searchModel::listsEnabled(),
                'value' => 'enable'
            ],
            //'created_at',
            //'updated_at',
            //'creator_id',
            //'modifier_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
