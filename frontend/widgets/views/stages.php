<?php

use yii\helpers\Url;

?>

<section class="block_7">
    <div class="container has_width">
        <div class="title">
            <i>Suvni tozalsh uchun</i>
            5ta bosqich
        </div>
        <ul class="step_list">
            <li>
                <a href="<?= Url::to(['order/create']) ?>" class="pjaxModalButton">
                    <span class="step_img"><img src="/img/step_1.jpg" alt=""/></span>
                    <span class="mini_logo"><img src="/img/messenger.png" alt=""/></span>
                    <span class="step_text"><?= Yii::t('main', 'Буюртма') ?></span>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['order/create']) ?>" class="pjaxModalButton">
                    <span class="step_img"><img src="/img/step_2.jpg" alt=""/></span>
                    <span class="mini_logo"><img src="/img/search_filter.png" alt=""/></span>
                    <span class="step_text">
                        <?=Yii::t('main', 'Сувни таҳлил қилиш')?>
                    </span>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['page/service', 'code' => 'selection']) ?>">
                    <span class="step_img"><img src="/img/step_3.jpg" alt=""/></span>
                    <span class="mini_logo"><img src="/img/file.png" alt=""/></span>
                    <span class="step_text">
                        <?= Yii::t('main', 'Ускунани танлаш') ?>
                    </span>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['page/service', 'code' => 'mounting']) ?>">
                    <span class="step_img"><img src="/img/step_4.jpg" alt=""/></span>
                    <span class="mini_logo"><img src="/img/montaj.png" alt=""/></span>
                    <span class="step_text">
                        <?= Yii::t('main', 'Монтаж ишлари') ?>
                    </span>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['order/create']) ?>" class="pjaxModalButton">
                    <span class="step_img"><img src="/img/step_5.jpg" alt=""/></span>
                    <span class="mini_logo"><img src="/img/result.png" alt=""/></span>
                    <span class="step_text">
                        <?= Yii::t('main', 'Натижа') ?>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</section>
