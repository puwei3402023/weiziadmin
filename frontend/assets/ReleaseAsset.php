<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/5
 * Time: 22:06
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class ReleaseAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/font-awesome.min.css',
        'css/swiper-4.1.0.min.css',
        'css/mobile.css',
        'css/flexslider.css'
    ];
    public $js = [

    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}