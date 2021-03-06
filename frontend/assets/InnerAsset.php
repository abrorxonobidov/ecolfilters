<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class InnerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/chosen.css',
        'css/magiczoomplus.css',
        'css/jquery-ui.css',
        'css/lightbox.css',
        'css/nivo-slider.css',
        'css/style.css?v=5',
        'css/media.css?v=5',
        'css/style_my.css?v=13',
    ];
    public $js = [
        'js/jquery-ui.js',
        'js/lightbox.js',
        'js/main.js?v=5',
        'js/my.js?v=6',
        'js/magiczoomplus.js',
        'js/chosen.jquery.min.js',
        'js/jquery.nivo.slider.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
