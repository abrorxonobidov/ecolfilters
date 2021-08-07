<?php

use common\models\Product;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ReviewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['class' => 'form',],
        'method' => 'get',
        'fieldConfig' => ['options' => ['class' => 'form-group col-md-3']],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'modifier_id') ?>

    <?php echo $form->field($model, 'product_id')->widget(Select2::className(), [
        'data' => Product::getList(),
        'options' => ['prompt' => Product::selectText()],
        'pluginOptions' => ['allowClear' => true,]
    ]) ?>

    <?php echo $form->field($model, 'status')->widget(Select2::className(), [
        'data' => $model::getStatusList(),
        'options' => ['prompt' => $model::selectText()],
        'pluginOptions' => ['allowClear' => true,]
    ]) ?>

    <?= $form->field($model, 'created_at_from')->widget(DateControl::classname(), [
        'type' => DateControl::FORMAT_DATE,
        'widgetOptions' => ['type' => \kartik\date\DatePicker::TYPE_INPUT],
    ]) ?>

    <?= $form->field($model, 'created_at_to')->widget(DateControl::classname(), [
        'type' => DateControl::FORMAT_DATE,
        'widgetOptions' => ['type' => \kartik\date\DatePicker::TYPE_INPUT],
    ]) ?>

    <?= $form->field($model, 'updated_at_from')->widget(DateControl::classname(), [
        'type' => DateControl::FORMAT_DATE,
        'widgetOptions' => ['type' => \kartik\date\DatePicker::TYPE_INPUT],
    ]) ?>

    <?= $form->field($model, 'updated_at_to')->widget(DateControl::classname(), [
        'type' => DateControl::FORMAT_DATE,
        'widgetOptions' => ['type' => \kartik\date\DatePicker::TYPE_INPUT],
    ]) ?>

    <?php echo $form->field($model, 'type_id')->widget(Select2::className(), [
        'data' => $model::getTypeList(),
        'options' => ['prompt' => $model::selectText()],
        'pluginOptions' => ['allowClear' => true,]
    ]) ?>
    <?php echo $form->field($model, 'name') ?>
    <?php echo $form->field($model, 'description') ?>
    <?php echo $form->field($model, 'phone') ?>

    <div class='clearfix'></div>
    <div class="form-group pull-right">
        <?= Html::submitButton(Yii::t('main','Қидириш'), ['id' => '_search', 'class' => 'btn btn-success ink-reaction']);?>
        <?= ' '; ?>
        <?= Html::a('Тозалаш', ['/reviews'], ['class' => 'btn btn-danger ink-reaction']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
