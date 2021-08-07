<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class MainPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/chosen.css',
        //'css/magiczoomplus.css',
        'css/jquery-ui.css',
        'css/style.css',
        'css/media.css',
        'css/style_my.css',
    ];
    public $js = [
        'js/jquery-ui.js',
        'js/main.js',
        'js/highcharts.js',
        'js/chart.js',
        'js/my.js',
        'js/ajaxModal.js',
        //'js/chosen.jquery.min.js',
        //'js/magiczoomplus.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
