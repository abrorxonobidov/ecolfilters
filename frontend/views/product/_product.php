<?php

/**
 * @var $model common\models\Product
 */
?>
<a href="<?= yii\helpers\Url::to(['/product/view', 'id' => $model->id]) ?>" class="col-md-3 product_b">
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
    <?
    $price = $model->actualPrice;
    if ($price) { ?>
        <span class="product_price">
            <i><?= $price ?></i>
            <?= Yii::t('main', 'сўм') ?>
        </span>
    <? } ?>
</a>
