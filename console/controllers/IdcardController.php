<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/19
 * Time: 9:58
 */

namespace console\controllers;

use console\logic\EmailLogic;
use Yii;
use common\log\Log;
use console\logic\IdcardLogic;
use yii\console\Controller;

class IdcardController extends Controller
{

    /**
     *解析身份证
     */
    public function actionIndex(){
        $mysworm=new \Sworm();
        $server = array(
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => '111111',
            'database' => 'cms',
            'charset' => 'utf8', //指定字符集
            'timeout' => 2,  // 可选：连接超时时间（非查询超时时间），默认为SW_MYSQL_CONNECT_TIMEOUT（1.0）
            'prefix' => 'pw_', //可选：表前缀
            'debug' => true //调试模式，开启会在执行查询时输出查询语句
        );

        $mysworm->connect($server, function($ret){
            if($ret->status){
                printf("连接成功\n");
            }else{
                var_dump($ret->errorCode, $ret->errorMsg);
            }
        });

    }

}