<?php

use common\modules\i18n_interface\models\Message;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\i18n_interface\models\SourceMessage */

$this->title = $model->message;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Сўзлар таржималари'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'category',
            'message:ntext',
        ],
    ]) ?>
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider([
            'query' => Message::find()->where(['id'=>$model->id])->orderBy(['language' => SORT_DESC])
        ]),
        'summary' => false,
        'columns' => [
            'language',
            'translation:ntext',
            /*[
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'message',
            ],*/
        ],
    ]); ?>

</div>
