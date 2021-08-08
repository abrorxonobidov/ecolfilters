<?php

/**
 * @var $services common\models\Lists[]
 */
?>

<section class="our_services">
    <div class="container has_width">
        <div class="title"><?= Yii::t('main', 'Бизнинг хизматларимиз') ?></div>
        <ul class="service_list">
            <? foreach ($services as $service) { ?>
                <li>
                    <a href="<?= yii\helpers\Url::to([$service->link]) ?>">
                        <span class="ser_img">
                            <img src="/img/<?= $service->preview_image ?>" alt=""/>
                        </span>
                        <span class="ser_name">
                            <?= $service->titleLang ?>
                        </span>
                    </a>
                </li>
            <? } ?>
        </ul>
    </div>
</section>
