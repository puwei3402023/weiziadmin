<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * 首页的
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'plugins/layui/css/layui.css',
        'css/global.css',
        'font-awesome/css/font-awesome.min.css',
        'css/common.css'
    ];
    public $js = [
        'plugins/layui/layui.js',
//        'datas/nav.js',
        'js/index.js',
//        'js/common.js',

    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
