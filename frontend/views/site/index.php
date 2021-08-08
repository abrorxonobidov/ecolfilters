<?php

use yii\helpers\Url;

/**
 * @var $this yii\web\View
 * @var $news common\models\Lists[]
 */

$this->title = Yii::t('main', 'Тоза сув бу — ECOFILTERS');
?>

<section class="news_block">
    <div class="container has_width">
        <div class="title">
            <?= Yii::t('main', 'Янгиликлар') ?>
        </div>
        <div class="news_list">
            <? foreach ($news as $model) { ?>
                <div class="news_box">
                    <a href="<?= Url::to(['page/news', 'id' => $model->id]) ?>">
                        <span class="news_img"><img src="/uploads/<?= $model->preview_image ?>" alt=""/></span>
                        <span class="news_link">
                            <?= $model->titleLang ?>
                        </span>
                        <i class="date">
                            <?= date('d.m.Y', strtotime($model->date)) ?>
                        </i>
                    </a>
                </div>
            <? } ?>
        </div>
    </div>
</section>