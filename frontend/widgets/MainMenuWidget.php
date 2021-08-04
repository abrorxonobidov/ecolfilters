<?php

namespace frontend\widgets;

use common\helpers\DebugHelper;
use Yii;
use common\models\MenusLinks;
use yii\base\Widget;

class MainMenuWidget extends Widget
{

    public function run()
    {
        $lang = Yii::$app->language;
        $menus = MenusLinks::find()
            ->select([
                'label' => "title_$lang",
                'url' => 'link_in',
            ])
            ->where(['enabled' => 1,'menu_id' => 1])
            ->andWhere("title_$lang > ''")
            ->orderBy(['order' => SORT_ASC, 'id' => SORT_ASC])
            ->asArray()
            ->all();

        foreach ($menus as &$menu)
            $menu['url'] = $menu['url'] > '' ? [$menu['url']] : '#';

        return $this->render('main_menu', [
            'menus' => $menus
        ]);
    }
}