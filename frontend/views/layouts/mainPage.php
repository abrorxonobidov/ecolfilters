<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\MainPageAsset;
use common\widgets\Alert;

/**
 * @var $this yii\web\View
 * @var $content string
 */

MainPageAsset::register($this);
?>

<? $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <? $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <? $this->head() ?>
</head>
<body>
<? $this->beginBody() ?>


<div class="wrapper">
    <section class="header">
        <div class="container has_width d_flex">
            <div class="col-md-2 col-xs-6">
                <a href="#" class="logo_img">
                    <img src="/img/logo.png" alt=""/>
                </a>
            </div>
            <div class="col-md-8 col-xs-12">
                <?= frontend\widgets\MainMenuWidget::widget() ?>
            </div>
            <div class="col-md-2 col-xs-6 mobile_style">
                <?= frontend\widgets\LanguageWidget::widget() ?>
            </div>
        </div>
    </section>
    <section class="block_2">
        <span><img src="/img/section_2_image.jpg" alt=""/></span>
        <div class="sec_2_text">
            Toza suv - <br>bu EcoFilters
            <i>Uy va ofis uchun innovatsion<br> suvni tozalash tizimlari</i>
        </div>
    </section>

    <?= frontend\widgets\ProductCategoryWidget::widget()?>

    <?= frontend\widgets\Stages::widget()?>

    <?= $content ?>

    <?= frontend\widgets\Statistic::widget()?>

    <?= frontend\widgets\Footer::widget()?>

</div>

<? $this->endBody() ?>
</body>
</html>
<? $this->endPage() ?>