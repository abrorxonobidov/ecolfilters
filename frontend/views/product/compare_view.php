<?php

use yii\bootstrap\Html;

/**
 * @var $this yii\web\View
 * @var $c common\models\Product
 * @var $x common\models\Product
 */

$this->title = Yii::t('main', 'Таққослаш') . ': ' . $c->id . ' | ' . $x->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Таққослаш'), 'url' => ['category']];
$this->params['breadcrumbs'][] = $c->titleLang . ' | ' . $x->titleLang;
$cArVideoLink = $c->video_ru ? explode('/', $c->video_ru) : null;
$xArVideoLink = $x->video_ru ? explode('/', $x->video_ru) : null;
?>
<div class="container-fluid">
    <div class="bread_crumb">
        <nav aria-label="breadcrumb">
            <?= yii\widgets\Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]); ?>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <section class="view_product">
            <div class="container-fluid">
                <div class="col-lg-7 product-page-zoom hidden-sm hidden-xs">
                    <?
                    $gallery = $c->galleryItems();
                    if (count($gallery) < 1)
                        $gallery = [
                            $c->preview_image ?
                                '/uploads/' . $c->preview_image
                                : '/img/product_default_image.jpg'
                        ];
                    echo frontend\widgets\MagicZoom::widget(['items' => $gallery]) ?>
                </div>
                <div class="col-lg-5 col-sm-12">
                    <h2><?= $c->titleLang ?></h2>
                    <span class="product_price product_price_in">
                        <? $price = $c->actualPrice; ?>
                        <i><?= $price ?></i>
                        <?= $price ? Yii::t('main', 'сўм') : '' ?>
                    </span>
                    <?= Html::a(Yii::t('main', 'Буюртма бериш'),
                        ['order/create', 'pid' => $c->id],
                        ['class' => 'my-order-link pjaxModalButton'])
                    ?>
                    <div class="characteristics_info">
                        <span><?= Yii::t('main', 'Тавсифи') ?></span>
                        <div><?= $c->previewLang ?></div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </section>
    </div>
    <div class="col-sm-6">
        <section class="view_product">
            <div class="container-fluid">
                <div class="col-lg-7 product-page-zoom hidden-sm hidden-xs">
                    <?
                    $gallery = $x->galleryItems();
                    if (count($gallery) < 1)
                        $gallery = [
                            $x->preview_image ?
                                '/uploads/' . $x->preview_image
                                : '/img/product_default_image.jpg'
                        ];
                    echo frontend\widgets\MagicZoom::widget(['items' => $gallery]) ?>
                </div>
                <div class="col-lg-5 col-sm-12">
                    <h2><?= $x->titleLang ?></h2>
                    <span class="product_price product_price_in">
                        <? $price = $x->actualPrice; ?>
                        <i><?= $price ?></i>
                        <?= $price ? Yii::t('main', 'сўм') : '' ?>
                    </span>
                    <?= Html::a(Yii::t('main', 'Буюртма бериш'),
                        ['order/create', 'pid' => $x->id],
                        ['class' => 'my-order-link pjaxModalButton'])
                    ?>
                    <div class="characteristics_info">
                        <span><?= Yii::t('main', 'Тавсифи') ?></span>
                        <div><?= $x->previewLang ?></div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row compare-about-product">
    <div class="col-sm-6">
        <section class="about_product">
            <div class="container-fluid">
                <div class="tab_box">
                    <?= yii\bootstrap\Tabs::widget([
                        'id' => 'product-detail-tab-c',
                        'linkOptions' => ['role' => 'presentation'],
                        'tabContentOptions' => [
                            'class' => 'tab-content about_product_b'
                        ],
                        'items' => [
                            [
                                'label' => Yii::t('main', 'Маълумот'),
                                'content' => Html::tag('div', $c->descriptionLang)
                            ],
                            [
                                'label' => Yii::t('main', 'Техник тавсифи'),
                                'content' => Html::tag('div', $c->technicLang),
                                'active' => true
                            ],
                            [
                                'label' => Yii::t('main', 'Видео'),
                                'content' => $cArVideoLink ? Html::tag('iframe', '', [
                                    'width' => '100%',
                                    'height' => '500',
                                    'src' => 'https://www.youtube.com/embed/' . end($cArVideoLink),
                                ]) : ''
                            ]
                        ]
                    ]); ?>
                </div>
            </div>
        </section>
    </div>
    <div class="col-sm-6">
        <section class="about_product">
            <div class="container-fluid">
                <div class="tab_box">
                    <?= yii\bootstrap\Tabs::widget([
                        'id' => 'product-detail-tab-x',
                        'linkOptions' => ['role' => 'presentation'],
                        'tabContentOptions' => [
                            'class' => 'tab-content about_product_b'
                        ],
                        'items' => [
                            [
                                'label' => Yii::t('main', 'Маълумот'),
                                'content' => Html::tag('div', $x->descriptionLang)
                            ],
                            [
                                'label' => Yii::t('main', 'Техник тавсифи'),
                                'content' => Html::tag('div', $x->technicLang),
                                'active' => true
                            ],
                            [
                                'label' => Yii::t('main', 'Видео'),
                                'content' => boolval($xArVideoLink) ? Html::tag('iframe', '', [
                                    'width' => '100%',
                                    'height' => '500',
                                    'src' => 'https://www.youtube.com/embed/' . end($xArVideoLink),
                                ]) : ''
                            ]
                        ]
                    ]); ?>
                </div>
            </div>
        </section>
    </div>
</div>
