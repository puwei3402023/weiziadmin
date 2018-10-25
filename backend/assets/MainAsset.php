<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/4
 * Time: 17:09
 */

namespace backend\assets;


use yii\web\AssetBundle;

/**
 * main中间的
 * Class MainAsset
 * @package backend\assets
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'plugins/layui/css/layui.css',
        'css/global.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'css/table.css',
        'css/demo.css',
        'zTree_v3/css/zTreeStyle/zTreeStyle.css',
        "css/zyUpload.css"
    ];
    public $js = [
//        'plugins/layui/layui.js',
        'common/js/common.js',

    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}