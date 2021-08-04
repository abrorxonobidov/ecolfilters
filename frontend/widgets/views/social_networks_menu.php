<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/**
 * @var $menus array
 */
foreach ($menus as $menu) {
    echo Html::beginTag('ul',['class' => 'social_network']);
    echo Html::tag('li',$menu['label']);
    foreach ($menu['children'] as $subMenu)
    {
        echo Html::tag('li',Html::a(Html::img($subMenu['icon']).$subMenu['label'],$subMenu['url']));
    }
    echo Html::endTag('ul');
}
?>
