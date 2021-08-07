<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\i18n_interface\models\Message */

$this->title = Yii::t('main', 'Update') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'language' => $model->language]];
$this->params['breadcrumbs'][] = Yii::t('main', 'Update');
?>
<div class="message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
