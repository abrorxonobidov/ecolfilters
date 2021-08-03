<?php
/**
 * Created by PhpStorm.
 * User: a_isokov
 * Date: 26.12.2015
 * Time: 16:30
 */

namespace backend\widgets;

use common\models\generated\TasksMovements;
use common\models\User;
use Yii;
use yii\bootstrap\Widget;
use yii\helpers\Url;

/**
 * @property \common\models\User $user
 */
class AccountMenu extends Widget
{
    public $user;

    /**
     * @return string
     */
    public function run()
    {
        $items = [
            [
                'label' => '<i class="fa fa-user"></i> ' . Yii::t('app', 'Менинг аккоунтим'),
                'url' => ['/user/view','id'=>$this->user->id],
                'icon' => 'fa fa-user',
                'linkOptions' => ['data-method' => 'post', 'class' => ' ink-reaction'],
            ],
            [
                'label' => '<i class="fa fa-sign-out"></i> ' . Yii::t('app', 'Чиқиш'),
                'url' => ['/site/logout'],
                'icon' => 'fa fa-sign-out',
                'linkOptions' => ['data-method' => 'post', 'class' => ' ink-reaction'],
            ]
        ];
        return $this->render('accountMenu',
            [
                'items' => $items
            ]);
    }
}
