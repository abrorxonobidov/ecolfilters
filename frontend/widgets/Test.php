<?php


namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Test extends Widget
{
    public function run()
    {
        return Html::tag('marquee',
            Yii::t('main', 'Сайт тест режимида ишламоқда') . '...',
            [
                'style' => '
                    position: fixed; 
                    bottom: 0; color: red; 
                    font-size: 11px;
                    background: #d5d5d5;
                    z-index: 10000;
                    padding: 2px 0;
                    '
            ]);
    }
}