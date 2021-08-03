<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/** @var $model \common\models\Product */
/** @var $index integer */
?>
<a href="<?= \yii\helpers\Url::to(['/product/view', 'id' => $model->id]) ?>" class="col-md-3 product_b">
    <div class="thumbnail">
        <div class="caption">
            <span class="product_img"><?= Html::img($model->preview_image ? '/uploads/' . $model->preview_image : '/uploads/default_p_i.jpg') ?></span>
            <span class="product_text"><?= $model->titleLang ?></span>
        </div>
    </div>
    <?php if ($model->price): ?>
        <span class="product_price"><i><?= $model->price ?></i> <?= Yii::t('main', 'сўм') ?></span>
    <?php endif; ?>
</a>