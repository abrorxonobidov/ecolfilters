<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $searchModel common\models\ProductSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('main', 'Маҳсулотлар');
$this->params['breadcrumbs'][] = $this->title; ?>
<?= $this->render('_search', ['searchModel' => $searchModel]) ?>
<section class="product">
    <div class="container has_width">
        <?= yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_product',
            'options' => ['tag' => false],
            'itemOptions' => ['tag' => false],
            'layout' =>
                Html::tag('div', '{items}', ['class' => 'flex-row row']) .
                Html::tag('div', '{pager}', ['class' => 'text-center']),
            'emptyText' => Yii::t('main', 'Маълумот топилмади'),
            'emptyTextOptions' => [
                'class' => 'product-alert alert alert-info'
            ]
        ]); ?>
    </div>
</section>