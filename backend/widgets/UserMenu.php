<?php
/**
 * Created by PhpStorm.
 * User: a_isokov
 * Date: 26.12.2015
 * Time: 16:30
 */

namespace backend\widgets;

use dmstr\widgets\Menu;
use Yii;
use yii\bootstrap\Widget;
use yii\web\User;

/**
 */
class UserMenu extends Widget
{
    /** @var User $user */
    public $user;

    /**
     * @return string
     */
    public function run()
    {
        $items = [
            ['label' => '&nbsp;', 'options' => ['class' => 'header'], 'encode' => false],
            [
                'label' => Yii::t('main', 'Сайтга ўтиш'),
                'url' => 'http://' . Yii::$app->params['domainName'],
                'icon' => 'globe'
            ]
        ];

        if ($this->user->isGuest) {
            $items[] = ['label' => Yii::t('main', 'Вход'), 'icon' => 'sign-in', 'url' => ['/site/login']];
        } else {
            $items = array_merge($items, [
                ['label' => 'Маҳсулотлар', 'icon' => 'gift', 'url' => ['/product/index']],
                ['label' => 'Менюлар', 'icon' => 'navicon', 'url' => ['/menus-links/index']],
                ['label' => 'Буюртмалар', 'icon' => 'cart-arrow-down', 'url' => ['/order/index']],
                ['label' => 'Янгиликлар', 'icon' => 'newspaper-o', 'url' => ['/list/index', 'ci' => 3]],
                ['label' => 'Саҳифалар', 'icon' => 'address-book-o', 'url' => ['/list/index', 'ci' => 1]],
                ['label' => 'Бизнинг ҳамкорларимиз', 'icon' => 'users', 'url' => ['/list/index', 'ci' => 6]],
                ['label' => 'Хизматлар', 'icon' => 'truck', 'url' => ['/list/index', 'ci' => 2]],
                ['label' => 'Фикрлар', 'icon' => 'comments-o', 'url' => ['/reviews/index']],
                ['label' => 'Қайта алоқа', 'icon' => 'envelope', 'url' => ['/reviews/feedback']],
                ['label' => 'Cўзлар таржималари', 'icon' => 'language', 'url' => ['/i18n_interface/source-message/index']],
            ]);
        }
        return Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => $items
            ]
        );
    }
}
