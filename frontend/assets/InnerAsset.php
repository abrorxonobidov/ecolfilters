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
        'css/style.css',
        'css/media.css',
        'css/style_my.css?v=1',
    ];
    public $js = [
        'js/jquery-ui.js',
        'js/lightbox.js',
        'js/main.js',
        'js/my.js?v=1',
        'js/magiczoomplus.js',
        'js/chosen.jquery.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
