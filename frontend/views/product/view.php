<?php

use yii\bootstrap\Html;
use yii\widgets\Breadcrumbs;

/**
 * @var $this yii\web\View
 * @var $model common\models\Product
 */

$this->title = $model->titleLang;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Маҳсулотлар'), 'url' => ['category']];
$this->params['breadcrumbs'][] = $this->title;
$arVideoLink = $model->video_ru ? explode('/', $model->video_ru) : null;

echo frontend\widgets\MetaTagsWidget::widget(['target_class' => $model::className(), 'target_id' => $model->id]);
?>
<section class="view_product">
    <div class="container has_width">
        <div class="bread_crumb">
            <nav aria-label="breadcrumb">
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]); ?>
            </nav>
        </div>
        <div class="col-md-7 product-page-zoom">
            <?
            $gallery = $model->galleryItems();
            if (count($gallery) < 1)
                $gallery = [
                    $model->preview_image ?
                        '/uploads/' . $model->preview_image
                        : '/img/product_default_image.jpg'
                ];
            echo frontend\widgets\MagicZoom::widget(['items' => $gallery]) ?>
        </div>
        <div class="col-md-5">
            <span class="view_product_title"><?= $model->titleLang ?></span>
            <span class="product_price product_price_in">
                <? $price = $model->actualPrice; ?>
                <i><?= $price ?></i>
                <?= $price ? Yii::t('main', 'сўм') : '' ?>
            </span>
            <?= Html::a(Yii::t('main', 'Буюртма бериш'),
                ['order/create',
                    'pid' => Yii::$app->request->get('id')],
                ['class' => 'my-order-link pjaxModalButton'])
            ?>
            <div class="characteristics_info">
                <span><?= Yii::t('main', 'Тавсифи') ?></span>
                <div><?= $model->previewLang ?></div>
            </div>
            <p class="text-center">
                <?= Html::a(Html::icon('transfer') . ' ' . Yii::t('main', 'Таққослаш'),
                    ['product/compare', 'c_id' => $model->id],
                    ['class' => 'order_link']);
                ?>
            </p>
            <br>
            <br>
        </div>

    </div>
</section>
<section class="about_product">
    <div class="container has_width">
        <div class="tab_box">
            <?= yii\bootstrap\Tabs::widget([
                'id' => 'product-detail-tab',
                'linkOptions' => ['role' => 'presentation'],
                'tabContentOptions' => [
                    'class' => 'tab-content about_product_b'
                ],
                'items' => [
                    [
                        'label' => Yii::t('main', 'Маълумот'),
                        'content' => Html::tag('div', $model->descriptionLang)
                    ],
                    [
                        'label' => Yii::t('main', 'Техник тавсифи'),
                        'content' => Html::tag('div', $model->technicLang),
                        'active' => true
                    ],
                    [
                        'label' => Yii::t('main', 'Видео'),
                        'content' => $arVideoLink ? Html::tag('iframe', '', [
                            'width' => '100%',
                            'height' => '500',
                            'src' => 'https://www.youtube.com/embed/' . end($arVideoLink),
                        ]) : ''
                    ]
                ]
            ]); ?>
        </div>
    </div>
</section>
<section class="product_reviews">
    <div class="container has_width">
        <?= frontend\widgets\ProductReviews::widget(['product' => $model]) ?>
    </div>
</section>
