<?php

/**
 * @var $content string
 */

use yii\bootstrap\Modal;

?>
<div class="content-wrapper">
    <section class="content">
        <?= dmstr\widgets\Alert::widget() ?>
        <?= $content ?>
    </section>
</div>
<?
Modal::begin([
    'id' => 'PjaxModal',

    'size' => Modal::SIZE_LARGE,
    'options' => ['tabindex' => ''],
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false, 'validateonsubmit' => true,],
]);
Modal::end(); ?>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Талқин</b> 1.0
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Ecofilters.uz</a>.</strong>
    Барча ҳуқуқлар ҳимояланган.
</footer>

<?php
$js = <<<JS
        $(document).ready(function() {
          $('.pjaxModalButton').click(function(e){
                callAjaxModal(e,this);
           });
        });
JS;
$this->registerJs($js, 3);
?>
