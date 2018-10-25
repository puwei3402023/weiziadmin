<?php
namespace console\controllers;
use common\log\Log;
use console\logic\SendLogic;
use yii\console\Controller;
use console\logic\EmailLogic;

class SendController  extends Controller
{

    //发送自定义短信
    public function actionIndex(){
        $email_msg='';
        $starttime='开始执行自定义短信:'.date('Y-m-d H:i:s');
        $stime=microtime(true); //获取程序开始执行的时间
        $model=new SendLogic();
        $sum=$model->index();
        $etime=microtime(true);//获取程序执行结束的时间
        $total=$etime-$stime;   //计算差值
        echo "\r\n";
        echo "页面执行时间:{$total}秒一共发送{$sum}个用户";
        $endtime='自定义短信执行结束:'.date('Y-m-d H:i:s').'共执行'.$total.'秒,一共发送'.$sum.'个用户';
        //发送邮件
        //发送数量大于0才发送短信
        if($sum>0){
            $email=new EmailLogic();
            $status=$email->index($starttime.$endtime,'自己定义发送短信');
            if($status){
                $email_msg=',邮件发送成功';
            }else{
                $email_msg=',邮件发送失败';

            }

        }
        $log=new Log();
        $log->set($starttime.$endtime.$email_msg);
    }
    //发送生日
    public function actionBirthday(){
        $starttime='开始执行生日短信:'.date('Y-m-d H:i:s');
        $stime=microtime(true); //获取程序开始执行的时间
        $model=new SendLogic();
        $sum=$model->SendBirthday();
        $etime=microtime(true);//获取程序执行结束的时间
        $total=$etime-$stime;   //计算差值
        echo "\n\r";
//        echo mb_convert_encoding("页面执行时间:{$total}秒一共发送{$sum}个用户", "gbk", "UTF-8");
        echo "\n\r";
        $endtime='生日短信执行结束:'.date('Y-m-d H:i:s').'共执行'.$total.'秒,一共发送'.$sum.'个用户';
        //发送邮件
        $email=new EmailLogic();
        $status=$email->index($starttime.$endtime,'发送生日');
        if($status){
            $email_msg=',邮件发送成功';
        }else{
            $email_msg=',邮件发送失败';

        }
        $log=new Log();
        $log->set($starttime.$endtime.$email_msg,'birthday');
    }
    //跑回访信息
    public function actionTest(){
        $stime=microtime(true); //获取程序开始执行的时间
        date_default_timezone_set('Asia/Shanghai');
        $db=\Yii::$app->db;
        $count = $db->createCommand('SELECT COUNT(*) as `count` FROM `edai_new_waitvisit_copy`')->queryOne();
        $count=($count['count']);
        var_dump($count);
        $limit=0;
        while ($count>=0){
            $count=$count-1000;
            $newwa=$db->createCommand("select * from edai_new_waitvisit_copy limit {$limit},1000")->queryAll();
            foreach ($newwa as $value){
                $time=strtotime(date('Y-m-d 00:00:00',$value['visittime']));
                $newwaa=$db->createCommand("select * from edai_new_returnvisit  WHERE uid={$value['uid']} AND addtime>={$time }")->queryOne();
                if(!empty($newwaa)){
                   $s=$db->createCommand()->delete('edai_new_waitvisit_copy',['id'=>$value['id']])->query();
                    if ($s){
                        echo mb_convert_encoding('执行成功', "gbk", "UTF-8");
                    }else
                        echo mb_convert_encoding('执行失败', "gbk", "UTF-8");

                }
            }
            echo $limit;

            $limit += 1000;
        }
        $etime=microtime(true);//获取程序执行结束的时间
        $total=$etime-$stime;   //计算差值
        $endtime='共执行'.$total.'秒';
        echo mb_convert_encoding($endtime, "gbk", "UTF-8");
    }
}