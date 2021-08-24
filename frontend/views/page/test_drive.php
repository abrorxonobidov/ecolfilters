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
                <?= $page->link ?>
            </span>
        </h1>
        <div class="row">
            <div class="col-md-6">
                <div class="simple-text characteristics_info">
                    <!--<span><? /*= Yii::t('main', 'Характеристика') */ ?></span>-->
                    <?= $page->titleLang ?>
                </div>
            </div>
            <div class="col-md-6">
                <img src="/img/naqsh.png" alt="">
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
        <div class="row">
            <div class="col-md-6">
                <img src="/img/naqsh.png" alt="">
            </div>
            <div class="col-md-6">
                <div class="simple-text characteristics_info">
                    <!--<span><? /*= Yii::t('main', 'Характеристика') */ ?></span>-->
                    <?= $page->titleLang ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="simple-text characteristics_info">
                    <!--<span><? /*= Yii::t('main', 'Характеристика') */ ?></span>-->
                    <?= $page->titleLang ?>
                </div>
            </div>
            <div class="col-md-6">
                <img src="/img/naqsh.png" alt="">
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
