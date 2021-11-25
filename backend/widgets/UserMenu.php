<?php
/**
 * Created by PhpStorm.
 * User: a_isokov
 * Date: 08.08.2021
 * Time: 16:30
 */

namespace backend\widgets;

use dmstr\widgets\Menu;
use Yii;
use yii\bootstrap\Widget;

class UserMenu extends Widget
{

    public function run()
    {
        $items = [
            [
                'label' => Yii::t('main', 'Сайтга ўтиш'),
                'url' => 'http://' . Yii::$app->params['domainName'],
                'icon' => 'globe'
            ]
        ];

        if (Yii::$app->user->isGuest) {
            $items[] = ['label' => Yii::t('main', 'Вход'), 'icon' => 'sign-in', 'url' => ['/site/login']];
        } else {
            $items = array_merge($items, [
                ['label' => 'Маҳсулотлар', 'icon' => 'gift', 'url' => ['/product/index']],
                ['label' => 'Маҳсулот категориялари', 'icon' => 'gift', 'url' => ['/product-category/index']],
                ['label' => 'Менюлар', 'icon' => 'navicon', 'url' => ['/menus-links/index']],
                ['label' => 'Буюртмалар', 'icon' => 'cart-arrow-down', 'url' => ['/order/index']],
                ['label' => 'Янгиликлар', 'icon' => 'newspaper-o', 'url' => ['/list/index', 'ci' => 3]],
                ['label' => 'Саҳифалар', 'icon' => 'address-book-o', 'url' => ['/list/index', 'ci' => 1]],
                ['label' => 'Бизнинг ҳамкорларимиз', 'icon' => 'users', 'url' => ['/list/index', 'ci' => 6]],
                ['label' => 'Хизматлар', 'icon' => 'truck', 'url' => ['/list/index', 'ci' => 2]],
                ['label' => 'Фикрлар', 'icon' => 'comments-o', 'url' => ['/reviews/index']],
                ['label' => 'Қайта алоқа', 'icon' => 'envelope', 'url' => ['/reviews/feedback']],
                ['label' => 'Cўзлар таржималари', 'icon' => 'language', 'url' => ['/i18n_interface/source-message/index']],
                ['label' => 'Валюта курси', 'icon' => 'dollar', 'url' => ['/currency/index']],
                ['label' => 'Meta Tag', 'icon' => 'code', 'url' => ['/meta-tags/index']],
                ['label' => 'Фойдаланувчилар', 'icon' => 'user', 'url' => ['/user/index']],
            ]);
        }

        return Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
            'items' => $items
        ]);
    }
}
