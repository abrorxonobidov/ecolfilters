<?php

use yii\helpers\Html;

/**
 * @var $page common\models\Lists
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
        <div class="row">
            <div class="col-md-8 col-sm-6">
                <?= $page->map ?>
                <br>
                <br>
            </div>
            <div class="col-md-4 col-sm-6 text-center">
                <?= Html::img("/uploads/{$page->preview_image}", ['class' => 'img-responsive img-thumbnail', 'style' => 'max-width:400px;']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= frontend\widgets\Partners::widget() ?>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 simple-text" >
                <br>
                <?= $page->previewLang ?>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12  simple-text">
                <?= $page->descriptionLang ?>
            </div>
        </div>
    </div>
</section>
