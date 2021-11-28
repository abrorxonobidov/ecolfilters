<?php

use yii\helpers\Html;

/**
 * @var $page common\models\Lists
 * @var $searchModel common\models\ProductSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

echo frontend\widgets\MetaTagsWidget::widget(['target_class' => $page::className(), 'target_id' => $page->id]);

$this->title = $page->titleLang;
$tab_items = [];
if ($page->descriptionLang)
    $tab_items[] = [
        'label' => Yii::t('main', 'Маълумот'),
        'content' =>
        //Html::tag('span', Yii::t('main', 'Техник тавсифи'), ['class' => 'about_product_title']) .
            Html::tag('div', $page->descriptionLang)
    ];

if ($page->video) {
    $embed_link_ar = explode('/', $page->video);
    $tab_items[] = [
        'label' => Yii::t('main', 'Видео'),
        'content' =>
        //Html::tag('span', Yii::t('main', 'Видео'), ['class' => 'about_product_title']) .
            Html::tag('iframe', '', [
                'width' => '100%',
                'height' => '500',
                'src' => 'https://www.youtube.com/embed/' . end($embed_link_ar),
            ])
    ];
}

?>

<style>
    .static-banner-table {
        height: 550px;
    }

    .static-banner-table .col-xs-6 {
        height: 550px;
    }
    @media screen and (max-width: 991px) {
        .static-banner-table .order_link {
            top: 50%;
            right: 10%;
            position: absolute;
            transform: translate(0, -50%);
            margin: 0;
            width: auto;
        }
    }
</style>

<section class="place-page view_product">
    <div class="container has_width">
        <h1>
            <span class="view_product_title">
                <?= $page->titleLang ?>
            </span>
        </h1>
        <div class="static-banner-table hidden-xs"
             style="background: url('<?= $page::imageSourcePath() . $page->preview_image ?>') no-repeat center; background-size: cover">
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <div class="simple-text service-preview">
                        <?= $page->previewLang ?>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6 text-center">
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
            <?= $tab_items ? yii\bootstrap\Tabs::widget([
                'id' => 'place-page-tab',
                'tabContentOptions' => [
                    'class' => 'tab-content about_product_b'
                ],
                'items' => $tab_items
            ]) : '' ?>
        </div>
    </div>
</section>

<section class="place-page view_product">
    <div class="container has_width">
        <div class="row">
            <div class="col-md-6">
                <div class="simple-text characteristics_info">
                    <!--<span><? /*= Yii::t('main', 'Характеристика') */ ?></span>-->
                    <?= $page->previewLang ?>
                </div>
            </div>
            <div class="col-md-6">
                <?= frontend\widgets\MagicZoom::widget(['items' => $page->galleryItems()]) ?>
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
