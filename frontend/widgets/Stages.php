<?php


namespace frontend\widgets;


use yii\base\Widget;

class Stages extends Widget
{

    public function run()
    {
        return $this->render('stages');
    }
}