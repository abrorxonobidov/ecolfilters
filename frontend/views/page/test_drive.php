<?php

use yii\helpers\Html;

/**
 * @var $page common\models\Lists
 * @var $searchModel common\models\ProductSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = $page->titleLang;

echo frontend\widgets\MetaTagsWidget::widget(['target_class' => $page::className(), 'target_id' => $page->id]);
?>

<section class="place-page view_product">
    <div class="container has_width">
        <h1>
            <span class="view_product_title">
                <?= Yii::t('main', 'Test drive') ?>
            </span>
        </h1>
        <div class="row">
            <div class="col-md-6">
                <div class="simple-text characteristics_info">
                    <!--<span><? /*= Yii::t('main', 'Характеристика') */ ?></span>-->
                    <?= $page->titleLang ?>
                </div>
                <br>
            </div>
            <div class="col-md-6 text-center">
                <?= $page->preview_image ? Html::img('/uploads/' . $page->preview_image) : '' ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <!--<button type="button" class="order_link_2">
                    <?/*= Yii::t('main', 'Буюртма бериш') */?>
                </button>-->
                <br>
                <br>
                <?= yii\helpers\Html::a(Yii::t('main', 'Буюртма бериш'),
                    ['order/create'],
                    ['class' => 'my-order-link pjaxModalButton'])
                ?>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-6 text-center">
                <?
                $gallery = $page->galleryItems();
                if (count($gallery) >= 1)
                    echo Html::img($gallery[0]);
                ?>
                <br>
            </div>
            <div class="col-md-6">
                <div class="simple-text characteristics_info">
                    <!--<span><? /*= Yii::t('main', 'Характеристика') */ ?></span>-->
                    <?= $page->previewLang ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="simple-text characteristics_info">
                    <!--<span><? /*= Yii::t('main', 'Характеристика') */ ?></span>-->
                    <?= $page->descriptionLang ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="place-page product">
    <p class="text-center">
        <span class="view_product_title">
            <?= Yii::t('main', 'Маҳсулотлар') ?>
        </span>
    </p>
    <div class="container has_width">
        <?= yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '/product/_product',
            'options' => ['tag' => false],
            'itemOptions' => ['tag' => false],
            'emptyTextOptions' => [
                'class' => 'text-center'
            ],
            'layout' => "<div class='flex-row row'> {items}</div><div class='text-center'>{pager}</div>"
        ]); ?>

        <div class="col-md-offset-4 col-md-4 text-center">
            <?= Html::a(Yii::t('main', 'Яна маҳсулотлар'),
                ['product/category', 'pli' => $searchModel['pli']],
                ['class' => 'order_link', 'style' => 'margin: 50px 0;']
            ) ?>
        </div>
    </div>
</section>
