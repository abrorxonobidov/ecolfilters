<?php

namespace frontend\widgets;

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
                'url' => "CASE WHEN (link_in > '') THEN link_in ELSE '#' END",
            ])
            ->where(['enabled' => 1])
            ->andWhere("title_$lang > ''")
            ->orderBy(['order' => SORT_ASC, 'id' => SORT_ASC])
            ->asArray()
            ->all();

        return $this->render('main_menu', [
            'menus' => $menus
        ]);
    }
}