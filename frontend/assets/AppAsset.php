<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/animate.css',
        'css/font-awesome.css',
        '/css/slider.css',
    ];
    public $js = [
        'js/jquery-1.11.1.min.js',
        'js/jquery.min.js',
        'js/common.js',
        'js/jquery.yx_rotaion.js',
//        'js/zepto.js',
        'js/layer/layer.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
