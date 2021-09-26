<?php

use yii\widgets\ListView;
use yii\bootstrap\Html;

/**
 * @var $this yii\web\View
 * @var $searchModel common\models\ProductSearch
 * @var $s common\models\ProductSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $mainDataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('main', 'Таққослаш');
$this->params['breadcrumbs'][] = $this->title; ?>

<section class="">
    <div class="container has_width">
        <?= ListView::widget([
            'dataProvider' => $mainDataProvider,
            'itemView' => '_product',
            'options' => ['tag' => false],
            'itemOptions' => ['tag' => false],
            'layout' =>
                Html::tag('div', '{items}', ['class' => 'flex-row row']) .
                Html::tag('div', '{pager}', ['class' => 'text-center'])
        ]); ?>
    </div>
    <div class="container has_width">
        <?= $this->render('_search_compare', [
            'searchModel' => $searchModel,
            's' => $s
        ]) ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_product_compare',
            'viewParams' => [
                'c_id' => $s->id
            ],
            'options' => ['tag' => false],
            'itemOptions' => ['tag' => false],
            'layout' =>
                Html::tag('div', '{items}', ['class' => 'flex-row row']) .
                Html::tag('div', '{pager}', ['class' => 'text-center']),
            'emptyText' => Yii::t('main', 'Маълумот топилмади'),
            'emptyTextOptions' => [
                'class' => 'alert alert-info'
            ]
        ]); ?>
    </div>
</section>