<?php
/**
 * Created by PhpStorm.
 * User: a_isokov
 * Date: 03.09.2017
 * Time: 14:21
 */

use common\models\generated\Regions;
use common\models\Product;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

$model->scenario = 'search';
$form = ActiveForm::begin([
    'id' => 'search',
    'options' => ['class' => 'form',],
    'method' => 'get',
    'fieldConfig' => ['options' => ['class' => 'form-group col-md-4']],


]);
echo $form->field($model, 'id')->textInput();
echo $form->field($model, 'name')->textInput();
echo $form->field($model, 'email')->textInput();
echo "<div class='clearfix'></div>";
echo $form->field($model, 'phone')->textInput();
echo $form->field($model, 'product_id')
    ->widget(Select2::className(), [
        'data' => Product::getList(),
        'options' => ['prompt' => Product::selectText()],
        'pluginOptions' => ['allowClear' => true,]
    ]);
echo $form->field($model, 'status')
    ->widget(Select2::className(), [
        'data' => $model::getStatusList(),
        'options' => ['prompt' => $model::selectText()],
        'pluginOptions' => ['allowClear' => true,]
    ]);
echo "<div class='clearfix'></div>";
echo "<div class='pull-right'>";
echo Html::a('Тозалаш', ['/order'], ['class' => 'btn btn-danger ink-reaction']);
echo ' ';
echo Html::submitButton('Қидириш', ['id' => '_search', 'class' => 'btn btn-success ink-reaction']);
echo "</div>";
ActiveForm::end();
?>
