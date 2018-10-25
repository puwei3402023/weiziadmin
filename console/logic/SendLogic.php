<?php
namespace console\logic;

use console\entity\SendEntity;
use frontend\component\SendSMS;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/12
 * Time: 10:08
 */
class SendLogic
{
    //短信发送
    public function index()
    {
        $sum=0;
        $entity = new SendEntity();
        $duanxinlog_demand = $entity->get_edai_new_duanxinlog_demand();
//        var_dump($duanxinlog_demand);
        echo '开始执行';
        echo "\r\n";
        if (!empty($duanxinlog_demand)) {
            echo '执行中';

            //不为空去查询短信模板内容
            $template = $entity->get_edai_new_sms_template($duanxinlog_demand['sms_template']);
            //查询发送人
            $duanxinlog_type = $entity->get_edai_new_duanxinlog_type($duanxinlog_demand['sms_type']);
            if (!empty($duanxinlog_type)) {
//                var_dump(($duanxinlog_type['assign_user']));
                if (!empty($duanxinlog_type['assign_user'])) {
                    //字符串转换成数组
                    $assign_user = explode(";", $duanxinlog_type['assign_user']);
                    //去重
                    $assign_user= array_unique($assign_user);
                    if (!empty($assign_user[0])) {
                        $data = [];
                        $send_phone=[];
                        //指定用户小于3000直接发送
                        while ($assign_user) {
                            $a = array_splice($assign_user, 0, 3000);
                            $a = array_unique($a);
                            //记录短信发送
                            foreach ($a as $v) {
                                //判断手机号码是否发送过了
                                $limitphone=$entity->limit_phone($v,$duanxinlog_demand['id']);
                                if(empty($limitphone)){
                                    $send_phone[]=$v;
                                    //判断手机号码是否合法
                                    $phone = preg_match_all('/^((1[3,5,8,7][0-9])|(14[5,7])|(17[0,6,7,8]))\d{8}$/', $v);
                                    if ($phone) {
                                        $sum++;
                                        //发送短信记录保存数组下面入库
                                        $data[] = [
                                            $v, //手机号码
                                            $template['counent'], //短信内容
                                            1,//是否成功
                                            $duanxinlog_demand['id'],//短信类型
                                            time(),
                                            0,
                                        ];
                                    }
                                }

                            }
                            //发送记录正式入库
                            if(!empty($data))
                                $entity->add_edai_new_duanxinlog($data);
                            $userphone = implode(';', $send_phone);
                            $userphones = explode(';', $userphone);
                            //发送短信
                            $sendsms = new SendSMS();
                            $statu = $sendsms->sendSmsNewAll($userphone, $template['counent']);
                            //如果发送成功和失败都记录状态
                            if(!empty($userphones))
                                $this->save_duanxinlog($userphones, $statu, $duanxinlog_demand['id']);
//                            $entity->update_edai_new_duanxinlog($assign_user, 1, $duanxinlog_demand['id']);
//                    var_dump($a);
                        }
                    }
                }
                //发送短信需求
               $sum+= $this->send_type($duanxinlog_type, $template, $duanxinlog_demand['id']);

                //改变发送状态为已发送 ,发送完毕才改变
                $entity->update_edai_new_duanxinlog_demand($duanxinlog_demand['id']);
                //用户地区发送短信
//                $this->send_type($duanxinlog_type['user_area'],'area',$template,$duanxinlog_demand['id']);
                //用户类型
//                $this->send_type($duanxinlog_type['user_grade'], 'grade',$template,$duanxinlog_demand['id']);
            }
        }
        echo '执行结束';
        return $sum;
    }

    //根据传递参数发送
    public function send_type($duanxinlog_type, $template, $sendtype)
    {
//        $transaction =\Yii::$app->db->beginTransaction();
//        try{

        $sum=0;
        $where = [];
        //用户等级
        if (!empty($duanxinlog_type['user_level'])) {
            $user_level = explode(';', $duanxinlog_type['user_level']);
            $usergrade = [];
            foreach ($user_level as $v) {
                $usergrade[] = "'$v'";
            }
            $user_grade = implode(',', $usergrade);
            $where[] = "u.userpower in ({$user_grade})";
        }
        //用户类型
        if (!empty($duanxinlog_type['user_grade'])) {
            $user_grade = explode(';', $duanxinlog_type['user_grade']);
            $usergrade = [];
            foreach ($user_grade as $v) {
                $usergrade[] = "'$v'";
            }
            $user_grade = implode(',', $usergrade);
            $where[] = "u.grade in ({$user_grade})";
        }
        //用户城市,占时查询用户基础表
        if (!empty($duanxinlog_type['user_city'])) {
            $where[] = ['u.area' => $duanxinlog_type['user_city']];
        }
        //用户注册时间
        if (!empty($duanxinlog_type['regist_time']) && !empty($duanxinlog_type['regist_times'])) {
            $where[] = ['BETWEEN', 'u.uregtime', $duanxinlog_type['regist_time'], $duanxinlog_type['regist_times']];
        }
        //用户性别
        if ($duanxinlog_type['migender'] >= 0) {
            $where[] = ['u.migender' => $duanxinlog_type['migender']];
        }
        $entity = new SendEntity();

        $user_count = $entity->get_edai_usersystab_count($where, $sendtype);
        $limit = 0;
        while ($user_count['count'] >= 0) {
            $user_count['count'] = $user_count['count'] - 3000;
            $userphone = $entity->get_edai_usersystab($where, $sendtype, $limit);
            echo ($limit);

//            var_dump($userphone);
//            exit;
//            exit;
            $user_phone = [];
            $data = [];
            foreach ($userphone as $v) {
//                echo $sum;
//                echo "\r\n";
                //判断手机号码是否合法
                $phone = preg_match_all('/^((1[3,5,8,7][0-9])|(14[5,7])|(17[0,6,7,8]))\d{8}$/', $v['userphone']);
//                    var_dump($phone);
                if ($phone) {
                    $sum++;
                    //发送短信记录保存数组下面入库
                    $data[] = [
                        $v['userphone'], //手机号码
                        $template['counent'], //短信内容
                        1,//是否成功
                        $sendtype,//短信类型
                        time(),
                        '0',
                    ];
                    $user_phone[] = $v['userphone'];
                }
            }
//            var_dump($data);
//            var_dump($data);
//            exit;
//                var_dump($data);
            //发送记录正式入库
            if (!empty($data)){
                var_dump(count($data));
                $entity->add_edai_new_duanxinlog($data);
                sleep(3);
//                echo 222;
            }

//            var_dump(!empty($userphone));
//            exit;
//            echo($template['counent']);
            $userphone = implode(';', $user_phone);
            //发送短信
            $sendsms = new SendSMS();
            $statu = $sendsms->sendSmsNewAll($userphone, $template['counent']);
            //如果发送成功和失败都记录状态
            if(!empty($user_phone)){
                $this->save_duanxinlog($user_phone, $statu, $sendtype);

            }
            $limit += 3000;
            unset($userphone);
            unset($user_phone);
            unset($data);
        }
//            $transaction->commit();
            return $sum;
//        }catch (\Exception $e){
//            $transaction->rollBack();
//        }
    }



    //发送生日
    public function SendBirthday()
    {
        $sum=0;
        //读取今天又多少人需要发送短信
        $entity = new SendEntity();
        $SendBirthdaycount = $entity->get_edai_idcard_information_count();
        if (!empty($SendBirthdaycount)) {

            //查询生日短信模板
            $config = $entity->get_edai_automatic_send_config();
            //根据配置获取需要发送的短信内容
            $content = $entity->get_edai_birthday_sms_template($config['template_id']);
            $limit = 0;
            while ($SendBirthdaycount['count'] > 0) {
                $SendBirthdaycount['count'] -= 3000;
                //获取今天需要发送的人
                $userphone = $entity->get_edai_idcard_information_unumbers($limit, $config['grade']);

                $strUserphone = implode(';', $userphone);
                echo('共发送');
                echo (count($userphone));
                echo('人');
                echo "\r\n";
                $data = [];
                //发送记录正式入库
                foreach ($userphone as $v) {
                    //判断手机号码是否合法
                    $phone = preg_match_all('/^((1[3,5,8,7][0-9])|(14[5,7])|(17[0,6,7,8]))\d{8}$/', $v);
                    if ($phone) {
                        $sum++;
                        //发送短信记录保存数组，下面入库
                        $data[] = [
                            $v, //手机号码
                            $content['content'], //短信内容
                            1,//是否成功
                            -1,//短信类型
                            time(),
                            date('Ymd'),
                        ];
                    }
                }
                if (!empty($data))
                    $entity->add_edai_new_duanxinlog($data);
                //正式发送
                $sendsms = new SendSMS();
                $statu = $sendsms->sendSmsNewAll($strUserphone, $content['content']);
                //发送反回状态
                $this->save_duanxinlog($userphone, $statu, '-1');

                $limit += 3000;
            }
        }
        return $sum;
    }

    //修改发送状态
    public function save_duanxinlog($userphone, $status, $type)
    {
        $entity = new SendEntity();
        foreach ($userphone as $v) {
            //判断手机号码是否合法
            if(!empty($v))
                $entity->update_edai_new_duanxinlog($v, $status, $type);
        }
    }

    //拼接where
    public function where($duanxinlog_type)
    {
        $where = [];
        //用户等级
        if (!empty($duanxinlog_type['user_level'])) {
            $usergrade = [];
            foreach ($duanxinlog_type['user_level'] as $v) {
                $usergrade[] = "'$v'";
            }
            $user_grade = implode(',', $usergrade);
            $where[] = "u.userpower in ({$user_grade})";
        }
        //用户类型
        if (!empty($duanxinlog_type['grade'])) {
            $usergrade = [];
            foreach ($duanxinlog_type['grade'] as $v) {
                $usergrade[] = "'$v'";
            }
            $user_grade = implode(',', $usergrade);
            $where[] = "u.grade in ({$user_grade})";
        }
        //用户城市,占时查询用户基础表
        if (!empty($duanxinlog_type['agea'])) {
            $where[] = ['u.area' => $duanxinlog_type['agea']];
        }
        //用户注册时间
        if (!empty($duanxinlog_type['regist_time']) && !empty($duanxinlog_type['regist_times'])) {
            $where[] = ['BETWEEN', 'u.uregtime', $duanxinlog_type['regist_time'], $duanxinlog_type['regist_times']];
        }
        //用户性别
        if (!empty($duanxinlog_type['migender'])&&$duanxinlog_type['migender'] >= 0 ) {
            $where[] = ['m.migender' => $duanxinlog_type['migender']];
        }
        return $where;
    }
}