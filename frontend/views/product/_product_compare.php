<?php

/**
 * @var $model common\models\Product
 * @var $c_id int
 */
?>
<a href="<?= yii\helpers\Url::to(['/product/compare-view', 'c_id' => $c_id, 'x_id' => $model->id]) ?>"
   class="col-md-3 product_b">
    <div class="thumbnail">
        <div class="caption">
            <span class="product_img">
                <?= yii\helpers\Html::img($model->preview_image
                    ? '/uploads/' . $model->preview_image
                    : '/img/product_default_image.jpg') ?>
            </span>
            <span class="product_text"><?= $model->titleLang ?></span>
        </div>
    </div>
    <? if ($model->price) { ?>
        <span class="product_price">
            <i><?= $model->price ?></i>
            <?= Yii::t('main', 'сўм') ?>
        </span>
    <? } ?>
</a>