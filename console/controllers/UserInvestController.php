<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21
 * Time: 9:19
 */

namespace console\controllers;


use common\log\Log;
use console\logic\EmailLogic;
use console\logic\UserInvestLogic;
use yii\console\Controller;

/**
 * H类用户历史总投资金额
 * Class UserInvestController
 * @package console\controllers
 */
class UserInvestController extends Controller
{

    public function actionIndex(){
        $starttime='开始执行解析等级:'.date('Y-m-d H:i:s');
        echo ('开始执行');
        echo "\r\n";
        $sum=0;
        $stime = microtime(true); //获取程序开始执行的时间
        //开始解析用户H类总投资
        $user_logic=new UserInvestLogic();
        $sum=$user_logic->index();


        $etime = microtime(true);//获取程序执行结束的时间
        $total = $etime - $stime;   //计算差值
        echo ("页面执行时间:{$total}秒一共解析{$sum}个用户\r\n");
        $endtime='解析H类用户总投资结束:'.date('Y-m-d H:i:s').'共执行'.$total.'秒,一共解析'.$sum."个用户";
        //发送邮件
        $email=new EmailLogic();
        $status=$email->index($starttime.$endtime,'解析H类用户总投资');
        if($status){
            $email_msg=',邮件发送成功';
        }else{
            $email_msg=',邮件发送失败';

        }
        $log=new Log();
        $log->set($starttime.$endtime.$email_msg,'invest');
    }
}