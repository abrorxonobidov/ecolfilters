<?php

use yii\helpers\Html;

/**
 * @var $page common\models\Lists
 */

$this->title = $page->titleLang;

$tab_items = [
    [
        'label' => Yii::t('main', 'Техник тавсифи'),
        'content' =>
            Html::tag('span', Yii::t('main', 'Техник тавсифи'), ['class' => 'about_product_title']) .
            Html::tag('div', $page->descriptionLang)
    ]
];

if ($page->video) {
    $embed_link_ar = explode('/', $page->video);
    $tab_items[] = [
        'label' => Yii::t('main', 'Видео'),
        'content' =>
            Html::tag('span', Yii::t('main', 'Видео'), ['class' => 'about_product_title']) .
            Html::tag('iframe', '', [
                'width' => '100%',
                'height' => '500',
                'src' => 'https://www.youtube.com/embed/' . end($embed_link_ar),
            ])
    ];
}

?>

<section class="place-page view_product">
    <div class="container has_width">
        <h1>
            <span class="view_product_title">
                <?= $page->titleLang ?>
            </span>
        </h1>
        <div class="row">
            <div class="col-md-6">
                <div class="characteristics_info">
                    <span><?= Yii::t('main', 'Характеристика') ?></span>
                    <?= $page->previewLang ?>
                </div>
            </div>
            <div class="col-md-6">
                <?= frontend\widgets\MagicZoom::widget(['items' => $page->galleryItems()]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" class="order_link_2">
                    <?= Yii::t('main', 'Буюртма бериш') ?>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="place-page about_product">
    <div class="container has_width">
        <div class="tab_box">
            <?= yii\bootstrap\Tabs::widget([
                'id' => 'place-page-tab',
                'tabContentOptions' => [
                    'class' => 'tab-content about_product_b'
                ],
                'items' => $tab_items
            ]) ?>
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
        <div class="flex-row row">
            <a href="#" class="col-md-3 product_b">
                <div class="thumbnail">
                    <div class="caption">
                        <span class="product_img"><img src="/img/product_img_1.jpg" alt=""/></span>
                        <span class="product_text">Uy va ofis uchun innovatsion suvni tozalash tizimlari</span>
                    </div>
                </div>
                <span class="product_price"><i>7 235 650</i> сўм</span>
            </a>
            <a href="#" class="col-md-3 product_b">
                <div class="thumbnail">
                    <div class="caption">
                        <span class="product_img"><img src="/img/product_img_2.jpg" alt=""/></span>
                        <span class="product_text">Uy va ofis uchun innovatsion suvni tozalash tizimlari</span>
                    </div>
                </div>
                <span class="product_price"><i>7 235 650</i> сўм</span>
            </a>
            <a href="#" class="col-md-3 product_b">
                <div class="thumbnail">
                    <div class="caption">
                        <span class="product_img"><img src="/img/product_img_3.jpg" alt=""/></span>
                        <span class="product_text">Uy va ofis uchun innovatsion suvni tozalash tizimlari</span>
                    </div>
                </div>
                <span class="product_price"><i>7 235 650</i> сўм</span>
            </a>
            <a href="#" class="col-md-3 product_b">
                <div class="thumbnail">
                    <div class="caption">
                        <span class="product_img"><img src="/img/product_img_1.jpg" alt=""/></span>
                        <span class="product_text">Uy va ofis uchun innovatsion suvni tozalash tizimlari</span>
                    </div>
                </div>
                <span class="product_price"><i>7 235 650</i> сўм</span>
            </a>
            <a href="#" class="col-md-3 product_b">
                <div class="thumbnail">
                    <div class="caption">
                        <span class="product_img"><img src="/img/product_img_1.jpg" alt=""/></span>
                        <span class="product_text">Uy va ofis uchun innovatsion suvni tozalash tizimlari</span>
                    </div>
                </div>
                <span class="product_price"><i>7 772 650</i> сўм</span>
            </a>
            <a href="#" class="col-md-3 product_b">
                <div class="thumbnail">
                    <div class="caption">
                        <span class="product_img"><img src="/img/product_img_2.jpg" alt=""/></span>
                        <span class="product_text">Uy va ofis uchun innovatsion suvni tozalash tizimlari</span>
                    </div>
                </div>
                <span class="product_price"><i>7 772 650</i> сўм</span>
            </a>
            <a href="#" class="col-md-3 product_b">
                <div class="thumbnail">
                    <div class="caption">
                        <span class="product_img"><img src="/img/product_img_3.jpg" alt=""/></span>
                        <span class="product_text">Uy va ofis uchun innovatsion suvni tozalash tizimlari</span>
                    </div>
                </div>
                <span class="product_price"><i>7 772 650</i> сўм</span>
            </a>
            <a href="#" class="col-md-3 product_b">
                <div class="thumbnail">
                    <div class="caption">
                        <span class="product_img"><img src="/img/product_img_1.jpg" alt=""/></span>
                        <span class="product_text">Uy va ofis uchun innovatsion suvni tozalash tizimlari</span>
                    </div>
                </div>
                <span class="product_price"><i>7 772 650</i> сўм</span>
            </a>
        </div>
    </div>
</section>
