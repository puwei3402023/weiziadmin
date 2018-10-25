<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //默认控制器
    'defaultRoute'=>'index',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'session'=>[
            'timeout'=>604800
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','info'],
                ],
            ],
        ],
        'errorHandler' => [
//            'errorAction' => 'msg/error',

        ],
        'arr'=>[
            'class'=>'frontend\index\ArrayCom'
        ],
        'testcomponent'=>[
            'class'=>'frontend\libs\testcomponent',//加载类库
            'param1'=>111,//设置参数
            'param2'=>222
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix'=>'.html',
            'rules' => [

                'article-list' => 'index/article-list',//文章列表
                'about/<id:\d+>' => 'index/about',//文章详情
                'product' => 'index/product',//产品服务
                'contact' => 'index/contact',//联系我们
                'solutions' => 'index/solutions',//解决方案列表
                'solutions2/<id:\d+>' => 'index/solutions2',//解决方案列表
                'services' => 'index/services',//产品及服务
                '/' => 'index/index',

            ],
        ],

    ],
    'params' => $params,
];


