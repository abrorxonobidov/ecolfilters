<?php

use kartik\file\FileInput;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\ProductCategory
 * @var $form yii\widgets\ActiveForm
 */
?>

<? $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'title_oz')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'order')->textInput() ?>

<?php

$image = $model->inputImageConfig('image', 'product-category/file-remove');

echo $form->field($model, 'imageHelper')
    ->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'previewFileType' => 'image',
            'allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg'],
            'initialPreview' => $image['path'],
            'initialPreviewAsData' => true,
            'initialPreviewConfig' => $image['config'],
            'showUpload' => false,
            'showRemove' => false,
            'browseClass' => 'btn btn-success',
            'browseLabel' => Html::icon('folder-open') . ' ' . $model->selectText(),
            'browseIcon' => '',
            'fileActionSettings' => [
                'removeIcon' => Html::icon('trash'),
                'showZoom' => false,
            ]
        ]
    ]);
?>

<?= $form->field($model, 'test_drive')->checkbox() ?>

<?= $form->field($model, 'enabled')->checkbox() ?>

<?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>

<? ActiveForm::end(); ?>
