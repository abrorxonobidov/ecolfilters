<?php

namespace frontend\widgets;

use common\helpers\DebugHelper;
use Yii;
use common\models\MenusLinks;
use yii\base\Widget;
use yii\db\ActiveQuery;

class MainMenuWidget extends Widget
{

    public function run()
    {
        $lang = Yii::$app->language;
        $menus = MenusLinks::find()
            ->select([
                'id',
                'label' => "title_$lang",
                'url' => 'link_in'
            ])
            ->with(['items' => function (ActiveQuery $query) use ($lang) {
                return $query->select([
                    'label' => "title_$lang",
                    'url' => 'link_in',
                    'parent_id'
                ]);
            }])
            ->where(['enabled' => 1, 'menu_id' => 1])
            ->andWhere("title_$lang > '' AND parent_id IS NULL")
            ->orderBy(['order' => SORT_ASC, 'id' => SORT_ASC])
            ->asArray()
            ->all();

        $this->setUrls($menus);

        return $this->render('main_menu', [
            'menus' => $menus
        ]);
    }

    private function setUrls(&$menus)
    {
        foreach ($menus as &$menu) {
            $menu['url'] = $menu['url'] > '' ? [$menu['url']] : '#';
            if (isset($menu['items']))
                $this->setUrls($menu['items']);
        }
    }
}