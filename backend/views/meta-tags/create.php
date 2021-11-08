<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MetaTags */

$this->title = Yii::t('main', 'Create Meta Tags');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Meta Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meta-tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
