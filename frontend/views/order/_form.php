<?php

use common\models\Product;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(['options' => ['class'=>'rev_form']]); ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'phone')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Юбориш'), ['class' => 'btn btn-success send_btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>
