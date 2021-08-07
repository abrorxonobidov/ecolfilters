<?php
/** @var array|string $url */

use yii\bootstrap\Modal;

?>

<div class="col-md-4 col-sm-4 col-xs-6">
    <span class="prof_service"><?= Yii::t('main', 'Профессионал таҳлил ва хизмат кўрматиш') ?></span>
    <?= \yii\helpers\Html::a(Yii::t('main', 'Буюртма бериш'), $url, ['class' => 'order_link pjaxModalButton']) ?>
</div>
<?
Modal::begin([
    'id' => 'PjaxModal',

    'size' => Modal::SIZE_LARGE,
    'options' => ['tabindex' => ''],
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => true, 'validateonsubmit' => true,],
]);
Modal::end(); ?>
<?php
$js = <<<JS
        $(document).ready(function() {
          $('.pjaxModalButton').click(function(e){
                callAjaxModal(e,this);
           });
        });
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>
