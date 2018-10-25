<?php
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2016/10/27
 * Time: 17:12
 */

namespace console\controllers;


use console\logic\UserlevelsLogic;
use yii\console\Controller;
use common\log\Log;
use console\logic\EmailLogic;
class UserlevelsController extends Controller
{
    public function actionIndex(){

        $starttime='开始执行解析等级:'.date('Y-m-d H:i:s');
        echo ('开始执行');
        echo "\r\n";
        $sum=0;
        $stime = microtime(true); //获取程序开始执行的时间
        //解析直投待收 先执行直投在执行定存不是数据不对
        $userlevels=new UserlevelsLogic();
        $asum=$userlevels->parsing_user_duein();

        //解析定存待收
        $bsum=$userlevels->parsing_user_dueins();
        //债权
        $csum=$userlevels->edai_borrow_investor();
        //定存B
        $dsum=$userlevels->parsing_user_deposit();
        echo '定存b'.$dsum,'\r\n';
        $sum=$asum+$bsum+$csum+$dsum;
        $etime = microtime(true);//获取程序执行结束的时间
        $total = $etime - $stime;   //计算差值
        echo ("页面执行时间:{$total}秒一共解析{$sum}个用户");
        $endtime='解析等级执行结束:'.date('Y-m-d H:i:s').'共执行'.$total.'秒,一共解析'.$sum.'个用户';
        //发送邮件
        $email=new EmailLogic();
        $status=$email->index($starttime.$endtime,'解析用户等级');
        if($status){
            $email_msg=',邮件发送成功';
        }else{
            $email_msg=',邮件发送失败';

        }
        $log=new Log();
        $log->set($starttime.$endtime.$email_msg,'levels');
    }

}