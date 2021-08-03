<?php
/**
 * Created by PhpStorm.
 * User: a_isokov
 * Date: 12.08.2016
 * Time: 13:05
 */

namespace backend\widgets;

use common\helpers\DebugHelper;
use common\models\Order;
use common\models\User;
use yii\bootstrap\Widget;
use yii\db\Query;
use Yii;

/**
 * Class ActionButtons
 * @package frontend\widgets
 * @property User $user
 * @property string $type
 */
class HeaderNotifications extends Widget
{
    public $user;
    public $type;
    public $arTypes;

    /**
     * @return string
     */
    public function run()
    {
        $items = false;
        if (!Yii::$app->user->isGuest) {
            foreach ($this->arTypes as $type)
                switch ($type) {
                    case 'new-orders':
                        $count = Order::find()->where(['status' => 'new'])->count();
                        if ($count > 0) {
                            $items[] = [
                                'icon' => 'fa fa-bell-o',
                                'title' => Yii::t('main', 'Янги буюртмалар'),
                                'url' => ['/order/index', 'OrderSearch[status]' => 'new'],
                                'count' => $count,
                            ];
                        }
                        break;
                    case 'orders':{
                        $count1 = $count = Order::find()->where(['status' => 'new'])->count();
                        $count2 = $count = Order::find()->where(['status' => 'process'])->count();
                        $count = $count1 + $count2;
                        if ($count > 0) {
                            $subItems = [];
                            if ($count1 > 0)
                                $subItems[] = [
                                    'icon' => 'fa fa-shopping-cart text-red',
                                    'title' => Yii::t('app', 'Янги буюртмалар {count} та',['count' => $count1]),
                                    'url' => ['/order/index', 'OrderSearch[status]' => 'new'],
                                    'count' => $count1,
                                ];
                            if ($count2 > 0)
                                $subItems[] = [
                                    'icon' => 'fa fa-shopping-cart text-blue',
                                    'title' => Yii::t('app', 'Жараёндаги буюртмалар {count} та',['count' => $count2]),
                                    'url' => ['/order/index', 'OrderSearch[status]' => 'process'],
                                    'count' => $count2,
                                ];
                            if (count($subItems) === 1) {
                                $item = $subItems[0];
                                $items[] = [
                                    'icon' => $item['icon'],
                                    'title' => $item['title'],
                                    'url' => $item['url'],
                                    'count' => $count,
                                ];
                            } else
                                $items[] = [
                                    'icon' => 'fa fa-bell-o',
                                    'title' => Yii::t('app', 'Буюртмалар'),
//                                'url' => '/tasks/resend',
                                    'count' => $count,
                                    'items' => $subItems
                                ];
                        }
                        break;
                    }
                    default :
                        break;
                }
        }

        if ($items) {
            return $this->render('headerNotifications',
                [
                    'items' => $items,
                ]
            );
        }
    }
}