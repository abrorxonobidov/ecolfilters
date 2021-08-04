<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/**
 * @var $menus array
 */
echo Html::beginTag('div', ['class' => 'col-md-8']);
foreach ($menus as $menu) {
    echo Html::beginTag('ul',['class' => 'footer_list']);
    echo Html::tag('li',$menu['label']);
    foreach ($menu['children'] as $subMenu)
    {
        echo Html::tag('li',Html::a($subMenu['label'],$subMenu['url']));
    }
    echo Html::endTag('ul');
}
echo Html::tag('div', '', ['class' => 'clearfix']);
echo Html::endTag('div');
?>
