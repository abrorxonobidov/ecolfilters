<?php

use yii\helpers\Url;

/**
 * @var $model common\models\Lists
 * @var $searchModel common\models\ProductSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = $model->titleLang;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Янгиликлар'), 'url' => ['page/news-list']];
$this->params['breadcrumbs'][] = $this->title;

echo frontend\widgets\MetaTagsWidget::widget(['target_class' => $model::className(), 'target_id' => $model->id]);
?>

<section class="place-model view_product">
    <div class="container has_width">
        <h1>
            <span class="view_product_title">
                <?= $model->titleLang ?>
            </span>
        </h1>
        <div class="bread_crumb">
            <nav aria-label="breadcrumb">
                <?= yii\widgets\Breadcrumbs::widget(
                    [
                        'tag' => 'ol',
                        'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                        'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]
                ); ?>
            </nav>
        </div>
        <table class="static-banner-table" style="background: url('<?= $model::imageSourcePath() . $model->preview_image ?>') center no-repeat; height: 480px" cellspacing="0" cellpadding="0" border="0">
            <tr class="row">
                <td class="col-md-4"></td>
                <td class="col-md-8 text-right"></td>
            </tr>
        </table>
    </div>
</section>

<section class="place-model about_product">
    <div class="container has_width">
        <div class="tab_box">
            <div class="tab-content about_product_b">
                <?= $model->descriptionLang ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-4 col-md-4 text-center">
                <a class="order_link pjaxModalButton" href="<?= Url::to(['order/create']) ?>">
                    <?= Yii::t('main', 'Буюртма бериш') ?>
                </a>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-md-12">
        <div class="image-row">
            <? foreach ($model->galleryItems() as $galleryItem) { ?>
                <a href="<?= $galleryItem ?>" data-lightbox="roadtrip">
                    <img src="<?= $galleryItem ?>" alt="">
                </a>
            <? } ?>
        </div>
    </div>
</div>
