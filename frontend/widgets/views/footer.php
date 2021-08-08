<?php

use frontend\widgets\FooterMenuWidget;
use frontend\widgets\Ordering;
use frontend\widgets\SocialNetworksMenuWidget;
use yii\helpers\Url; ?>

<section class="footer">
    <div class="container has_width">
        <div class="contacts d_flex">
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="contact_b">
                    <?= Yii::t('main', 'Боғланиш') ?>
                    <i><?= Yii::t('main', 'contactPhone') ?></i>
                    <i><?= Yii::t('main', 'contactEmail') ?></i>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <span class="question_offer">
                    <?= Yii::t('main', 'Савол ва таклифларингиз бўлса ҳозироқ биз билан боғланинг') ?>
                </span>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <span class="prof_service">
                    <?= Yii::t('main', 'Профессионал таҳлил ва хизмат кўрсатиш') ?>
                </span>
                <?= yii\helpers\Html::a(Yii::t('main', 'Буюртма бериш'),
                    ['order/create', 'pid' => Yii::$app->request->get('id')],
                    ['class' => 'order_link pjaxModalButton'])
                ?>
            </div>
            <?= Ordering::widget() ?>
            <div class="clearfix"></div>
        </div>
        <?= FooterMenuWidget::widget() ?>
        <div class="col-md-4">
            <?= SocialNetworksMenuWidget::widget() ?>
            <div class="clearfix"></div>
            <div class="address_b">
                <?= Yii::t('main', '<p><strong>Манзил:</strong> Тошкент шаҳри,</p><p>Навоий кўчаси 158Б</p>') ?>
                <a href="#"><img src="/img/location.png" alt=""/><?= Yii::t('main', 'Харитада кўрсатиш') ?></a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="company_name">
            <?= Yii::t('main', '"ecofilters" компанияси') ?>
            <i>&copy; <?= date('Y') > 2021 ? '2021-' . date('Y') : date('Y') ?></i>
        </div>

    </div>
</section>