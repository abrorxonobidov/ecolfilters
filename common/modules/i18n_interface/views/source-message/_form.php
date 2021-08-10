<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\i18n_interface\models\SourceMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="source-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->dropDownList($model->getCategories()) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <div class="row">
        <?
        foreach (common\modules\i18n_interface\models\SourceMessage::languages() as $code => $language) {
            echo
            Html::tag('div',
                $form->field($model, "translates_ar[$code]")->textarea(['rows' => 6])->label($language),
                ['class' => 'col-md-3']);
        }
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('main', 'Create') : Yii::t('main', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
