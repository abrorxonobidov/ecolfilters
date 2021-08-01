<?php


namespace frontend\widgets;


use yii\base\Widget;

class Statistic extends Widget
{

    public function run()
    {
        return $this->render('statistic');
    }
}