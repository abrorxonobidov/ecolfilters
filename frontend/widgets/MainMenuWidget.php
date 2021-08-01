<?php
namespace frontend\widgets;

use yii\base\Widget;

class MainMenuWidget extends Widget
{

    public function run()
    {
        return $this->render('main_menu', [
            'menus' => []
        ]);
    }
}