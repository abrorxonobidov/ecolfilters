<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\i18n_interface\models\Message */

$this->title = Yii::t('main', 'Create Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
