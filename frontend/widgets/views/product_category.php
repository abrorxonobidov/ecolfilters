<?php

use yii\helpers\Html;

/**
 * @var $cats common\models\ProductCategory[]
 *
 */

foreach ($cats as $cat) { ?>

    <section class="block_<?= $cat->id + 2 ?> product-category-block" data-url="<?= \yii\helpers\Url::to(['product/category', 'pci' => $cat->id]) ?>">
        <span><img src="/img/product_category_<?= $cat->id ?>.jpg" alt=""/></span>
        <div class="sec_<?= $cat->id + 2 ?>_text">
            <?= $cat->title ?>
            <i> </i>
            <?
            if ($cat->test_drive) {
                echo Html::a('Test drive' . Html::tag('i', '', ['class' => 'glyphicon glyphicon-menu-right']),
                    ['page/test-drive', 'id' => $cat->id],
                    ['class' => 'test_link']);
            }
            ?>
        </div>
    </section>

<? } ?>
