<?php

use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\bootstrap\Html;
use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\Product
 * @var $form yii\widgets\ActiveForm
 */

echo $model->errors ? Html::ul($model->errors, [
    'class' => 'list-group',
    'itemOptions' => 'list-group-item'
]) : '';

$form = ActiveForm::begin();

echo common\helpers\GeneralHelper::oneRow([
    $form->field($model, 'product_category_id')->dropDownList(common\models\ProductCategory::getList(), ['prompt' => $model->selectText()]),
    $form->field($model, 'place_id')->dropDownList(common\models\Place::getList(), ['prompt' => $model->selectText()]),
    $form->field($model, 'price')->textInput(['maxlength' => true]),
    $form->field($model, 'enabled')->dropDownList($model::listsEnabled())
]);

$previewConfig = $model->inputImageConfig('preview_image', 'product/file-remove');

echo $form->field($model, 'previewImageHelper')
    ->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'previewFileType' => 'image',
            'allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg'],
            'initialPreview' => $previewConfig['path'],
            'initialPreviewAsData' => true,
            'initialPreviewConfig' => $previewConfig['config'],
            'showUpload' => false,
            'showRemove' => false,
            'browseClass' => 'btn btn-success',
            'browseLabel' => Html::icon('folder-open') . $model->selectText(),
            'browseIcon' => '',
            'fileActionSettings' => [
                'removeIcon' => Html::icon('trash'),
                'showZoom' => false,
            ]
        ]
    ]);

$galleyConfig = $model->inputGalleryConfig();

echo $form->field($model, 'helpGallery[]')
    ->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
            'multiple' => true
        ],
        'pluginOptions' => [
            'allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg', 'mp4'],
            'initialPreview' => $galleyConfig['path'],
            'initialPreviewAsData' => true,
            'initialPreviewConfig' => $galleyConfig['config'],
            'showUpload' => false,
            'showRemove' => false,
            'browseClass' => 'btn btn-success',
            'browseLabel' => Html::icon('folder-open') . '&nbsp;Tanlang...',
            'browseIcon' => '',
            'overwriteInitial' => false,
            'fileActionSettings' => [
                'removeIcon' => Html::icon('trash'),
                'showZoom' => false,
            ]
        ]
    ]);


$items = [];
foreach (Yii::$app->params['languages'] as $lang_code => $language)
    $items[] = [
        'label' => $language,
        'content' => '<br>' .
            $form->field($model, "title_$lang_code")->textarea(['rows' => 2]) .
            $form->field($model, "preview_$lang_code")->textarea(['rows' => 3]) .
            $form->field($model, "description_$lang_code")->widget(CKEditor::class, $model->ckEditorConfig('d_' . $lang_code)) .
            $form->field($model, "technic_$lang_code")->widget(CKEditor::class, $model->ckEditorConfig('t_' . $lang_code)) .
            $form->field($model, "video_$lang_code")->textInput(),
    ];

echo Tabs::widget(['items' => $items]);

echo Html::tag('div', Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']), ['class' => 'form-group']);

ActiveForm::end();