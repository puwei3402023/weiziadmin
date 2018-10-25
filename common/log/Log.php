<?php
namespace common\log;
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2016/10/24
 * Time: 17:53
 */
use yii\log\FileTarget;
use Yii;
class Log
{

    public function set($messages,$file='timedtask'){
        //日志保存
        $time = microtime(true);
        $log = new FileTarget();
        $log->logFile = Yii::$app->getRuntimePath() . "/logs/{$file}info.log";	//文件名自定义
        $log->messages[] = [$messages,4,'application',$time];
        $log->export();
//         Yii::info('测试s');
        //判断日志大小
        //重新建立日志文件
//        写入日志
    }
}