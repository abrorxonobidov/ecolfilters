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
    $form->field($model, 'category_id')
        ->dropDownList(common\models\ListCategory::getList(), [
            'prompt' => $model->selectText(),
            'disabled' => Yii::$app->request->get('ci'),
            'class' => Yii::$app->request->get('ci') ? 'hidden' : 'form-control'
        ])
        ->label(Yii::$app->request->get('ci') ? false : $model->getAttributeLabel('category_id')),
    $form->field($model, 'date')->widget(kartik\date\DatePicker::class, [
        'type' => 3,
        'attribute' => 'date',
        'model' => $model,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]),
    $form->field($model, 'order')->textInput(['value' => $model->getOrder()]),
    $form->field($model, 'enabled')->dropDownList($model::listsEnabled())
]);


echo Yii::$app->request->get('ci') == 1 ? common\helpers\GeneralHelper::oneRow([
    $form->field($model, 'link')->textInput(['maxlength' => true])->label('Page code'),
    $form->field($model, 'video')->textInput(['maxlength' => true]),
    ''
]) : '';

$previewConfig = $model->inputImageConfig('preview_image', 'list/file-remove');

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
            'browseLabel' => Html::icon('folder-open') . ' ' . $model->selectText(),
            'browseIcon' => '',
            'fileActionSettings' => [
                'removeIcon' => Html::icon('trash'),
                'showZoom' => false,
            ]
        ]
    ]);

$galleyConfig = $model->inputGalleryConfig('list/gallery-remove');

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
            $form->field($model, "preview_$lang_code")->widget(dosamigos\ckeditor\CKEditor::class, $model->ckEditorConfig('p_' . $lang_code)) .
            $form->field($model, "description_$lang_code")->widget(dosamigos\ckeditor\CKEditor::class, $model->ckEditorConfig('d_' . $lang_code))
    ];

echo yii\bootstrap\Tabs::widget(['items' => $items]);

echo Html::tag('div', Html::submitButton(Yii::t('main', 'Сақлаш'), ['class' => 'btn btn-success']), ['class' => 'form-group']);

ActiveForm::end();
