<?php

use yii\helpers\Html;

/**
 * @var $page common\models\Lists
 * @var $searchModel common\models\ProductSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = $page->titleLang;


?>


<section class="place-page view_product">
    <div class="container has_width">
        <h1>
            <span class="view_product_title">
                <?= $page->titleLang ?>
            </span>
        </h1>
        <table class="static-banner-table" style="background: url('<?= $page::imageSourcePath() . $page->preview_image ?>') center" cellspacing="0" cellpadding="0" border="0">
            <tr class="row">
                <td class="col-md-4">
                    <div class="simple-text service-preview">
                        <?= $page->previewLang ?>
                    </div>
                </td>
                <td class="col-md-8 text-right">
                    <button type="button" class="my-order-link">
                        <?= Yii::t('main', 'Буюртма бериш') ?>
                    </button>
                </td>
            </tr>
        </table>
    </div>
</section>

<section class="place-page about_product">
    <div class="container has_width">
        <div class="tab_box">
            <div class="tab-content about_product_b">
                <?= $page->descriptionLang ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" class="my-order-link">
                    <?= Yii::t('main', 'Буюртма бериш') ?>
                </button>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-md-12">
        <div class="image-row">
            <? foreach ($page->galleryItems() as $galleryItem) { ?>
                <a href="<?= $galleryItem ?>" data-lightbox="roadtrip">
                    <img src="<?= $galleryItem ?>" alt="">
                </a>
            <? } ?>
        </div>
    </div>
</div>

<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })
</script>
