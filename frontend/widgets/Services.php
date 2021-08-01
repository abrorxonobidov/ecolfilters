<?php


namespace frontend\widgets;


use yii\base\Widget;

class Services extends Widget
{

    public function run()
    {
        return $this->render('services');
    }
}