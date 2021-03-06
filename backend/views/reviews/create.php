<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reviews */

$this->title = Yii::t('main', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
