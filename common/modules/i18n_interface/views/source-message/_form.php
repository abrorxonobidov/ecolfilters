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
        foreach ($model->translates_ar as $code => $message)
            echo $form->field($model, "translates_ar[$code]", [
                'options' => ['class' => 'col-md-3']
            ])
                ->textarea(['rows' => 6, 'value' => $message])
                ->label($code)
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('yii', 'Create') : Yii::t('main', 'Сақлаш'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
