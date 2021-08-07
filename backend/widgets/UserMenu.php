<?php
/**
 * Created by PhpStorm.
 * User: a_isokov
 * Date: 26.12.2015
 * Time: 16:30
 */

namespace backend\widgets;

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
                'url' => 'http://'.Yii::$app->params['domainName'],
                'icon' => 'globe'
            ]
        ];

        if ($this->user->isGuest) {
            $items[] = ['label' => Yii::t('main', 'Вход'), 'url' => ['/site/login']];
        } else {
            $items[] = ['label' => 'Маҳсулотлар', 'icon' => 'gift', 'url' => ['product/index']];
            $items[] = ['label' => 'Менюлар', 'icon' => 'navicon', 'url' => ['menus-links/index']];
            $items[] = ['label' => 'Буюртмалар', 'icon' => 'cart-arrow-down', 'url' => ['order/index']];
            $items[] = ['label' => 'Янгиликлар', 'icon' => 'newspaper-o', 'url' => ['list/index', 'ci' => 3]];
            $items[] = ['label' => 'Саҳифалар', 'icon' => 'address-book-o', 'url' => ['list/index', 'ci' => 1]];
            $items[] = ['label' => 'Хизматлар', 'icon' => 'truck', 'url' => ['list/index', 'ci' => 2]];
            $items[] = ['label' => 'Фикрлар', 'icon' => 'comments-o', 'url' => ['/reviews']];
            $items[] = ['label' => 'Cўзлар таржималари', 'icon' => 'language', 'url' => ['/i18n_interface/source-message/index']];
        }
        return $this->render('userMenu',
            [
                'items' => $items
            ]);
    }
}
