<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\Order
 * @var $form yii\widgets\ActiveForm
 */
?>

<?php $form = ActiveForm::begin(['options' => ['class' => 'rev_form']]); ?>
<?= $form->field($model, 'name')->textInput() ?>
<?= $form->field($model, 'phone')->widget(yii\widgets\MaskedInput::class, [
    'mask' => '\+\9\9\8-99-999-99-99',
]) ?>
<?= $form->field($model, 'email')->textInput() ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('main', 'Буюртмани юбориш'), ['class' => 'btn btn-success send_btn']) ?>
</div>

<?php ActiveForm::end(); ?>
