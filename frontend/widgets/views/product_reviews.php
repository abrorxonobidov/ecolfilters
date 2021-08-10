<?

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var $review common\models\Reviews
 */
?>
<div class="row">
    <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="product_rev_form_box">
            <span class="review_title">
                <?= Yii::t('main', 'Изоҳ қолдириш') ?>
            </span>
            <?
            $form = ActiveForm::begin([
                'id' => 'review-form',
                'options' => [
                    'class' => 'rev_form'
                ]
            ]);

            echo $form->field($review, 'name')->textInput();
            echo $form->field($review, 'phone')
                ->widget(yii\widgets\MaskedInput::class, [
                    'mask' => '\+\9\9\8-99-999-99-99',
                ]);
            echo $form->field($review, 'description')->textarea([
                'rows' => 5
            ]);

            echo $form->field($review, 'product_id')->hiddenInput()->label(false);

            echo Html::submitButton(Yii::t('main', 'Юбориш'), ['class' => 'btn send_btn']);

            ActiveForm::end();
            ?>
        </div>
    </div>
    <div class="col-md-7 col-sm-7 col-xs-12">
        <div id="review-list" class="rev_users">
        </div>
        <a href="#" data-offset="0" data-pid="<?= $review->product_id ?>" class="link_show_more">Показать ещё</a>
    </div>
</div>
