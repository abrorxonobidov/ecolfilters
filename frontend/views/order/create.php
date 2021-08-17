<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = Yii::t('main', 'Буюртма бериш');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product_rev_form_box ordering">
    <div class="review_title"><?=$this->title?></div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
