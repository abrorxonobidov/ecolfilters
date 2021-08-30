<?php
/**
 * Created by PhpStorm.
 * User: a_isokov
 * Date: 03.08.2021
 * Time: 20:00
 *
 * Modifier Abrorxon Obidov
 */

namespace backend\widgets;

use common\models\Order;
use common\models\Reviews;
use common\models\User;
use Yii;
use yii\base\Widget;

/**
 * Class ActionButtons
 * @package frontend\widgets
 * @property User $user
 * @property string $type
 * @property array $arTypes
 * @property array $items
 */
class HeaderNotifications extends Widget
{
    public $user;
    public $type;
    public $arTypes;
    public $items = [];

    public function init()
    {
        if (Yii::$app->user->isGuest)
            return null;
        foreach ($this->arTypes as $type)
            switch ($type) {
                case 'new-orders':
                    $count = Order::find()->where(['status' => 'new'])->count();
                    if ($count > 0) {
                        $this->items[] = [
                            'icon' => 'fa fa-cart-arrow-down',
                            'title' => Yii::t('main', 'Янги буюртмалар'),
                            'url' => ['/order/index', 'OrderSearch[status]' => 'new'],
                            'count' => $count,
                        ];
                    }
                    break;
                case 'new-reviews':
                    $count = Reviews::find()->where(['status' => 'new', 'type_id' => Reviews::TYPE_PRODUCT])->count();
                    if ($count > 0) {
                        $this->items[] = [
                            'icon' => 'fa fa-comments-o',
                            'title' => Yii::t('main', 'Янги фикрлар'),
                            'url' => ['/reviews/index', 'ReviewsSearch[status]' => 'new'],
                            'count' => $count,
                        ];
                    }
                    break;
                case 'feedback':
                    $count = Reviews::find()->where(['status' => 'new', 'type_id' => Reviews::TYPE_FEEDBACK])->count();
                    if ($count > 0) {
                        $this->items[] = [
                            'icon' => 'fa fa-envelope',
                            'title' => Yii::t('main', 'Қайта алоқа'),
                            'url' => ['/reviews/feedback', 'ReviewsSearch[status]' => Reviews::STATUS_NEW],
                            'count' => $count
                        ];
                    }
                    break;
                case 'orders':
                {
                    $count1 = $count = Order::find()->where(['status' => 'new'])->count();
                    $count2 = $count = Order::find()->where(['status' => 'process'])->count();
                    $count = $count1 + $count2;
                    if ($count > 0) {
                        $subItems = [];
                        if ($count1 > 0)
                            $subItems[] = [
                                'icon' => 'fa fa-shopping-cart text-red',
                                'title' => Yii::t('main', 'Янги буюртмалар {count} та', ['count' => $count1]),
                                'url' => ['/order/index', 'OrderSearch[status]' => 'new'],
                                'count' => $count1,
                            ];
                        if ($count2 > 0)
                            $subItems[] = [
                                'icon' => 'fa fa-shopping-cart text-blue',
                                'title' => Yii::t('main', 'Жараёндаги буюртмалар {count} та', ['count' => $count2]),
                                'url' => ['/order/index', 'OrderSearch[status]' => 'process'],
                                'count' => $count2,
                            ];
                        if (count($subItems) === 1) {
                            $item = $subItems[0];
                            $this->items[] = [
                                'icon' => $item['icon'],
                                'title' => $item['title'],
                                'url' => $item['url'],
                                'count' => $count,
                            ];
                        } else
                            $this->items[] = [
                                'icon' => 'fa fa-bell-o',
                                'title' => Yii::t('main', 'Буюртмалар'),
//                                'url' => '/tasks/resend',
                                'count' => $count,
                                'items' => $subItems
                            ];
                    }
                    break;
                }
                default:
                    break;
            }
    }

    public function run()
    {
        return $this->render('headerNotifications', [
            'items' => $this->items
        ]);
    }
}