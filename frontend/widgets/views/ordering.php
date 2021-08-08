<?php
/** @var array|string $url */

use yii\bootstrap\Modal;

Modal::begin([
    'id' => 'PjaxModal',
    'size' => Modal::SIZE_LARGE,
    'options' => ['tabindex' => ''],
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => true, 'validateonsubmit' => true]
]);
Modal::end();
