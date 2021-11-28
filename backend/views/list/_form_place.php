<?php

use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/**
 * @var $this yii\web\View
 * @var $model common\models\Lists
 * @var $form yii\widgets\ActiveForm
 */

$form = ActiveForm::begin();


echo common\helpers\GeneralHelper::oneRow([
    $form->field($model, 'order')->textInput(['value' => $model->getOrder()]),
    $form->field($model, 'enabled')->dropDownList($model::listsEnabled()),
    $form->field($model, 'category_id')->hiddenInput()->label(false),
    $form->field($model, 'date')->hiddenInput()->label(false)
]);


echo Yii::$app->request->get('ci') == 1 ? common\helpers\GeneralHelper::oneRow([
    $form->field($model, 'link')->textInput(['maxlength' => true])->label('Page code'),
    $form->field($model, 'video')->textInput(['maxlength' => true]),
    ''
]) : '';

echo Yii::$app->request->get('ci') == 1 ? $form->field($model, 'map')
    ->textarea(['maxlength' => true, 'rows' => 5])
    ->label(Yii::t('main', 'Google Харита')) : '';

$previewConfig = $model->inputImageConfig('preview_image', 'list/file-remove');

echo $form->field($model, 'previewImageHelper')
    ->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'previewFileType' => 'image',
            'allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg', 'svg'],
            'initialPreview' => $previewConfig['path'],
            'initialPreviewAsData' => true,
            'initialPreviewConfig' => $previewConfig['config'],
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

$galleyConfig = $model->inputGalleryConfig('list/gallery-remove', 'gallery_inner');

echo $form->field($model, 'helpGalleryInner[]')
    ->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
            'multiple' => true
        ],
        'pluginOptions' => [
            'allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg', 'mp4', 'svg'],
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
            $form->field($model, "title_inner_1_$lang_code")->textarea(['rows' => 2]) .
            $form->field($model, "title_inner_2_$lang_code")->textarea(['rows' => 2]) .
            $form->field($model, "preview_$lang_code")->widget(dosamigos\ckeditor\CKEditor::class, $model->ckEditorConfig('p_' . $lang_code)) .
            $form->field($model, "description_$lang_code")->widget(dosamigos\ckeditor\CKEditor::class, $model->ckEditorConfig('d_' . $lang_code)) .
            $form->field($model, "content_1_$lang_code")->widget(dosamigos\ckeditor\CKEditor::class, $model->ckEditorConfig('c_1_' . $lang_code)) .
            $form->field($model, "content_2_$lang_code")->widget(dosamigos\ckeditor\CKEditor::class, $model->ckEditorConfig('c_2_' . $lang_code)) .
            $form->field($model, "content_3_$lang_code")->widget(dosamigos\ckeditor\CKEditor::class, $model->ckEditorConfig('c_3_' . $lang_code))
    ];

echo yii\bootstrap\Tabs::widget(['items' => $items]);

echo Html::tag('div', Html::submitButton(Yii::t('main', 'Сақлаш'), ['class' => 'btn btn-success']), ['class' => 'form-group']);

ActiveForm::end();
