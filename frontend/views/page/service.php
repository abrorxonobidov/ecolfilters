<?php

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
        <div class="static-banner-table"
             style="background: url('<?= $page::imageSourcePath() . $page->preview_image ?>')">
            <div class="row">
                <div class="col-md-6">
                    <div class="simple-text service-preview">
                        <?= $page->previewLang ?>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <a type="button" class="order_link pjaxModalButton"
                       href="<?= yii\helpers\Url::to(['order/create']) ?>">
                        <?= Yii::t('main', 'Буюртма бериш') ?>
                    </a>
                </div>
            </div>
        </div>
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
                <a type="button" class="my-order-link pjaxModalButton"
                   href="<?= yii\helpers\Url::to(['order/create']) ?>">
                    <?= Yii::t('main', 'Буюртма бериш') ?>
                </a>
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
