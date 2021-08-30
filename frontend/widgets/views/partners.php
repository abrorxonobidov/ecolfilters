<?php

use yii\helpers\Html;

/**
 * @var $partners common\models\Lists[]
 * @var $title string
 */
?>
<h3>
    <span class="view_product_title"><?= $title ?></span>
</h3>

<div class="row">
    <? foreach ($partners as $key => $partner) { ?>
        <div class="col-md-3 col-sm-6 text-center">
            <div class="partner-item">
                <?= Html::img('/uploads/' . $partner->preview_image) ?>
            </div>
            <p class="simple-text"><b><?= $partner->titleLang ?></b></p>
        </div>
        <?
        if ($key % 4 == 3) echo '</div><br><br><div class="row">';
    } ?>
</div>
