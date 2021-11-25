<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\User
 */

$this->title = $model->username . ' ' . Yii::t('main', 'ни таҳрирлаш');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Фойдаланувчилар'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('main', 'Таҳрирлаш');

echo Html::tag('h2', $this->title);

$form = ActiveForm::begin([
    'options' => [
        'autocomplete' => 'off'
    ]
]);

echo $form->field($model, 'username')->textInput(['maxlength' => true]);

if ($model->id == Yii::$app->user->id) {
    echo $form->field($model, 'password')->passwordInput(['autocomplete' => 'off'])->label(Yii::t('main', 'Эски парол'));
    echo $form->field($model, 'new_password')->passwordInput(['autocomplete' => 'off']);
    echo $form->field($model, 'repeat_password')->passwordInput(['autocomplete' => 'off']);
}

echo $form->field($model, 'full_name')->textInput(['maxlength' => true]);

echo $form->field($model, 'email')->textInput(['maxlength' => true]);

echo $form->field($model, 'status')->widget(kartik\select2\Select2::class, ['data' => $model::statusList()]);

echo Html::submitButton(Yii::t('main', 'Сақлаш'), ['class' => 'btn btn-success']);

ActiveForm::end();
