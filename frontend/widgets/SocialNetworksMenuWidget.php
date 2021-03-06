<?php

namespace frontend\widgets;

use common\helpers\GeneralHelper;
use Yii;
use common\models\MenusLinks;
use yii\base\Widget;
use yii\db\ActiveQuery;

class SocialNetworksMenuWidget extends Widget
{

    public function run()
    {
        $lang = Yii::$app->language;
        $menus = MenusLinks::find()->alias('p')
            ->select([
                'label' => "p.title_$lang",
                'url' => 'p.link_out',
                'p.id',
            ])
            ->where(['p.enabled' => 1, 'p.menu_id' => 3, 'p.parent_id' => null])
            ->with(['children' => function (ActiveQuery $q) use ($lang) {
                $q->alias('m');
                $q->select([
                    'label' => "m.title_$lang",
                    'url' => 'm.link_out',
                    'm.icon',
                    'm.parent_id',
                ]);
            }])
            ->andWhere("p.title_$lang > ''")
            ->orderBy(['p.order' => SORT_ASC, 'p.id' => SORT_ASC])
            ->asArray()
            ->all();
        $this->setUrls($menus);
        return $this->render('social_networks_menu', [
            'menus' => $menus
        ]);
    }

    private function setUrls(&$menus)
    {
        foreach ($menus as &$menu) {
            $menu['url'] = $menu['url'] > '' ? $menu['url'] : '#';
            if (isset($menu['children']))
                $this->setUrls($menu['children']);
        }
    }
}