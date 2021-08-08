<?php


namespace frontend\widgets;


use common\helpers\DebugHelper;
use Yii;
use yii\base\Widget;

class Ordering extends Widget
{

    public function run()
    {
        return $this->render('ordering');
    }
}