<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var $this yii\web\View
 * @var $searchModel common\modules\i18n_interface\models\SourceMessageSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('main', 'Сўзлар таржималари');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a(Yii::t('main', 'Яратиш'), ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a(Yii::t('main', 'Файл ҳосил қилиш'), ['build'], ['class' => 'btn btn-success']) ?>
</p>
<?
Pjax::begin();
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'category',
        'message:ntext',
        'concat_massage',
        'languages',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);

Pjax::end();
?>
