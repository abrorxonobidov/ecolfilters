<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MenusLinks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menus-links-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'menu_id')->dropDownList(common\models\Menus::getList('name')) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($model->getParentList(), [
            'prompt' => Yii::t('main', 'Танланг')
    ]) ?>

    <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_oz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link_in')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link_out')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'icon')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'enabled')->dropDownList($model::listsEnabled()) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>
<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>
<!--    --><?//= $form->field($model, 'creator_id')->textInput() ?>
<!--    --><?//= $form->field($model, 'modifier_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Сақлаш'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
