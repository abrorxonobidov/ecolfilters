<?php

/**
 * @var $this yii\web\View
 * @var $name string
 * @var $message string
 */

use yii\bootstrap\Html;

$this->title = nl2br(Html::encode($message));
?>

<section class="news_block">
    <div class="container has_width">
        <div class="title">
            <?= Html::encode($this->title) ?>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="not-found-page">
                    <?= $name  ?>
                    <br>
                    <br>
                    <?=Html::a(
                            Html::icon('home') . ' ' .
                            Yii::t('main', 'Бош саҳифа'), ['site/index'], ['class' => 'btn btn-default'])?>

                </div>
            </div>

        </div>

    </div>
</section>

<style>

.not-found-page {
    width: 100%;
    padding: 50px 0 100px 0;
    text-align: center;
    font-size: 30px;
}

.not-found-page a {
    font-size: 40px;

}
</style>
