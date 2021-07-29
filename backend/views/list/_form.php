<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lists */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lists-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_oz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview_oz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_uz')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_oz')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_ru')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_en')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'preview_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gallery')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'region_id')->textInput() ?>

    <?= $form->field($model, 'inner_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'enabled')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'creator_id')->textInput() ?>

    <?= $form->field($model, 'modifier_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
