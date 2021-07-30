<?php


namespace common\helpers;

use Yii;
use yii\bootstrap\Html;

class GeneralHelper
{
    public static function oneRow($items)
    {
        foreach ($items as &$item)
            $item = Html::tag('div', $item, ['class' => 'col-md-' . round(12 / count($items))]);
        return Html::tag('div', implode('', $items), ['class' => 'row']);
    }

    public static function titleAndCreateBtn($title = '')
    {
        return GeneralHelper::oneRow([
            Html::tag('h2', $title),
            Html::a(Html::icon('plus') . ' ' . Yii::t('common', 'Yaratish'), ['create'], ['class' => 'btn btn-success pull-right'])
        ]);
    }
}