<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $page common\models\Lists
 * @var $review frontend\models\Feedback
 */

$this->title = $page->titleLang;
?>

<section class="place-page view_product">
    <div class="container has_width">
        <h1>
            <span class="view_product_title">
                <?= $page->titleLang ?>
            </span>
        </h1>
        <div class="row">
            <div class="col-sm-6">
                <?= $page->previewLang ?>
                <br>
                <br>
            </div>
            <div class="col-sm-6">
                <?= frontend\widgets\SocialNetworksMenuWidget::widget() ?>
            </div>
        </div>
    </div>
</section>
<section class="product_reviews">
    <div class="container has_width">

        <div class="product_rev_form_box">
            <span class="review_title">
                <?= Yii::t('main', 'Қайта алоқа') ?>
            </span>
            <?
            $form = ActiveForm::begin([
                'id' => 'review-form',
                'options' => [
                    'class' => 'rev_form',
                    'data-url' => 'api/send-feedback'
                ],
                'enableClientValidation' => true
            ]);

            echo $form->field($review, 'name')->textInput(['maxlength' => true]);
            echo $form->field($review, 'phone')
                ->widget(yii\widgets\MaskedInput::class, [
                    'mask' => '\+\9\9\8-99-999-99-99',
                ]);
            echo $form->field($review, 'description')->textarea(['rows' => 5, 'maxlength' => 1000]);

            echo $form->field($review, 'type_id')->hiddenInput(['value' => $review::TYPE_FEEDBACK])->label(false);

            echo $form->field($review, 'verifyCode', [
                'template' => '{label} {input} <div class="text-right"> {error}</div>'
            ])
                ->widget(yii\captcha\Captcha::class,
                    [
                        'template' =>
                            '<div class="row"><div class="col-sm-4">{image}</div>'
                            .
                            '<div class="col-sm-8">{input}</div></div>',
                    ]);

            echo Html::submitButton(Yii::t('main', 'Юбориш'), ['class' => 'btn send_btn']);

            ActiveForm::end();
            ?>
        </div>
    </div>
</section>
