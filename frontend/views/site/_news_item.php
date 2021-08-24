<?php
/**
 * @var $model common\models\Lists
 */
?>

<a href="<?= yii\helpers\Url::to(['page/news', 'id' => $model->id]) ?>">
    <span class="news_img"><img src="/uploads/<?= $model->preview_image ?>" alt=""/></span>
    <span class="news_link">
        <?= $model->titleLang ?>
    </span>
    <i class="date">
        <?= date('d.m.Y', strtotime($model->date)) ?>
    </i>
</a>