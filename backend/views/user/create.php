<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\User
 */

$this->title = Yii::t('main', 'Қўшиш');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Фойдаланувчилар'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::tag('h2', $this->title);

$form = ActiveForm::begin([
    'options' => [
        'autocomplete' => 'off'
    ]
]);

echo $form->field($model, 'username')->textInput(['maxlength' => true]);

echo $form->field($model, 'password')->passwordInput();

echo $form->field($model, 'repeat_password')->passwordInput();

echo $form->field($model, 'full_name')->textInput(['maxlength' => true]);

echo $form->field($model, 'email')->textInput(['maxlength' => true]);

echo $form->field($model, 'status')->dropDownList($model::statusList());

echo Html::submitButton(Yii::t('main', 'Сақлаш'), ['class' => 'btn btn-success']);

ActiveForm::end();
