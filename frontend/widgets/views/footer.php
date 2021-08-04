<?php

use frontend\widgets\FooterMenuWidget;
use frontend\widgets\SocialNetworksMenuWidget; ?>

<section class="footer">
    <div class="container has_width">

        <div class="contacts d_flex">
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="contact_b">
                    Bog`lanish
                    <i>+998 90 123-45-67</i>
                    <i>info@ecofilters.uz</i>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                        <span class="question_offer">
                            Savol va takliflaringiz bo'lsa hoziroq biz bilan bog'laning
                        </span>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <span class="prof_service">Professional tahlil va xizmat ko'rsatish</span>
                <a href="#" class="order_link">Buyurtma berish</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <?= FooterMenuWidget::widget() ?>
        <div class="col-md-4">
            <?= SocialNetworksMenuWidget::widget() ?>
            <div class="clearfix"></div>
            <div class="address_b">
                <p>Manzil: Toshkent shahri,</p>
                <p>Navoiy ko'chasi, 158 B</p>
                <a href="#"><img src="/img/location.png" alt=""/>Xaritada ko`rsatish</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="company_name">
            "ecofilters" kompaniyasi
            <i>©2021</i>
        </div>

    </div>
</section>