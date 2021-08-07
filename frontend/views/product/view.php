<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\Product
 */

$this->title = $model->titleLang;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Маҳсулотлар'), 'url' => ['category']];
$this->params['breadcrumbs'][] = $this->title;
$arVideoLink = explode('/', $model->videoLang);
?>
<section class="view_product">
    <div class="container has_width">
        <div class="bread_crumb">
            <nav aria-label="breadcrumb">
                <?= Breadcrumbs::widget(
                    [
                        'tag' => 'ol',
                        'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                        'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]
                ); ?>
            </nav>
        </div>
        <div class="col-md-6 product-page-zoom">
            <?= frontend\widgets\MagicZoom::widget(['items' => $model->galleryItems()]) ?>
        </div>
        <div class="col-md-6">
            <span class="view_product_title"><?= $model->titleLang ?></span>
            <span class="product_price product_price_in"><i><?= $model->price ?></i> <?= Yii::t('main', 'сўм') ?></span>
            <button type="button" class="order_link_2"><?= Yii::t('main', 'Буюртма бериш') ?></button>
            <div class="characteristics_info">
                <span><?= Yii::t('main', 'Тавсифи') ?></span>
                <?= $model->previewLang ?>
            </div>
        </div>

    </div>
</section>
<section class="about_product">
    <div class="container has_width">
        <div class="tab_box">
            <?= yii\bootstrap\Tabs::widget([
                'id' => 'product-detail-tab',
                'linkOptions' => ['role'=>'presentation'],
                'tabContentOptions' => [
                    'class' => 'tab-content about_product_b'
                ],
                'items' => [
                    [
                        'label' => Yii::t('main', 'Маълумот'),
                        'content' =>
                        //Html::tag('span', Yii::t('main', 'Техник тавсифи'), ['class' => 'about_product_title']) .
                            Html::tag('div', $model->descriptionLang)
                    ],
                    [
                        'label' => Yii::t('main', 'Техник тавсифи'),
                        'content' =>
                        //Html::tag('span', Yii::t('main', 'Техник тавсифи'), ['class' => 'about_product_title']) .
                            Html::tag('div', $model->technicLang)
                    ],
                    [
                        'label' => Yii::t('main', 'Видео'),
                        'content' =>
                        //Html::tag('span', Yii::t('main', 'Видео'), ['class' => 'about_product_title']) .
                            Html::tag('iframe', '', [
                                'width' => '100%',
                                'height' => '500',
                                'src' => 'https://www.youtube.com/embed/' . end($arVideoLink),
                            ])
                    ]
                ]
            ]); ?>
        </div>
    </div>
</section>
<section class="product_reviews">
    <div class="container has_width">
        <?=\frontend\widgets\ProductReviews::widget(['product' => $model])?>
    </div>
</section>
