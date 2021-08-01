<?php
namespace frontend\widgets;

use yii\base\Widget;

class LanguageWidget extends Widget
{

    public function run()
    {
        return $this->render('language', [
            'menus' => []
        ]);
    }
}