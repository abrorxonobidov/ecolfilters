<?php

/**
 * @var $page common\models\Lists
 */

$this->title = Yii::t('main', 'Бизнинг ҳамкорларимиз');
?>

<section class="place-page view_product">
    <div class="container has_width">
        <div class="row">
            <div class="col-md-12">
                <?= frontend\widgets\Partners::widget() ?>
                <br>
            </div>
        </div>
    </div>
</section>
