<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use common\helpers\GeneralHelper;

/**
 * @var $this yii\web\View
 * @var $model common\models\MetaTags
 * @var $form yii\widgets\ActiveForm
 */

$form = ActiveForm::begin();

echo GeneralHelper::oneRow([
    $form->field($model, 'target_class')
        ->dropDownList($model::typeList(), [
            'prompt' => Yii::t('main', 'Танланг') . ' ...',
            'disabled' => $model->isNewRecord && $model->target_class
        ]),
    $form->field($model, 'target_id')
        ->widget(DepDrop::class, [
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => [
                'theme' => Select2::THEME_BOOTSTRAP,
                'pluginOptions' => [
                    'language' => Yii::t('main', 'select2_language'),
                ],
                'disabled' => $model->isNewRecord && $model->target_id
            ],
            'pluginOptions' => [
                'depends' => [
                    Html::getInputId($model, 'target_class')
                ],
                'initialize' => true,
                'url' => Url::to(['/meta-tags/target-list']),
                'placeholder' => Yii::t('main', 'Танланг') . ' ...'
            ]
        ])
]);


echo $form->field($model, 'name')->textInput(['maxlength' => true]);

echo $form->field($model, 'content')->textarea(['rows' => 6]);

//echo $form->field($model, 'url')->textInput();

echo $form->field($model, 'enabled')->dropDownList($model::listsEnabled());

echo Html::tag('div', Html::submitButton(Yii::t('main', 'Сақлаш'), ['class' => 'btn btn-success']), ['class' => 'form-group']);

ActiveForm::end();
