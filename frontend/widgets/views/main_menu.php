<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
/**
 * @var $menus array
 */
echo Html::beginTag('div', ['class' => 'main_menu']);
NavBar::begin([
    'id' => false,
    'options' => [
        'class' => 'navbar',
    ],
    'renderInnerContainer' => false,
    'containerOptions' => [
        'id' => 'bs-navbar-collapse-1',
        'class' => 'collapse navbar-collapse nopade'
    ],
    'headerContent' => Html::tag('span', Yii::t('main', 'Меню'))
]);
$menuItems = [
    ['label' => 'Home', 'url' => ['/site/sex']],
    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
];
echo Nav::widget([
    'options' => ['class' => 'nav navbar-nav'],
    'items' => $menus,
]);
NavBar::end();
echo Html::endTag('div')
?><!--

<div class="main_menu">
    <nav class="navbar">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar first_icon"></span>
                <span class="icon-bar second_icon"></span>
                <span class="icon-bar third_icon"></span>
            </button>
            <span>Меню</span>
        </div>

        <div class="collapse navbar-collapse nopade" id="bs-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Xonadonda <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Ofisda</a></li>
                        <li><a href="#">Korxonada</a></li>
                        <li><a href="#">Xizmat turlari</a></li>
                    </ul>
                </li>
                <li><a href="#">Ofisda</a></li>
                <li><a href="#">Kottejda</a></li>
                <li><a href="#">Korxonada</a></li>
                <li><a href="#">Katalog</a></li>
                <li><a href="#">Xizmat turlari</a></li>
                <li><a href="#">Biz haqimizda</a></li>
                <li><a href="#">Bog`lanish</a></li>
            </ul>
        </div>
    </nav>
</div>
-->