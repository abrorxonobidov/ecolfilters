<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\Currency
 * @var $form yii\widgets\ActiveForm
 */

echo Html::beginTag('div', ['class' => 'col-md-offset-4 col-md-4']);

$form = ActiveForm::begin();

echo $form->field($model, 'rate')->textInput();

echo $form->field($model, 'enabled')->dropDownList($model::listsEnabled());

echo Html::tag('div', Html::submitButton(Yii::t('main', 'Сақлаш'), ['class' => 'btn btn-success']), ['class' => 'form-group']);

ActiveForm::end();

echo Html::endTag('div');
