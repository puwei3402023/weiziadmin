<?php
namespace console\entity;
use common\models\Analyze;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/12
 * Time: 10:10
 */
class SendEntity
{
    //总条数对象
    protected $count;
    //数据对象
    protected $connection1;

    //获取要发送的短信方案
    public function get_edai_new_duanxinlog_demand()
    {
        return \Yii::$app->db->createCommand('select * from edai_new_duanxinlog_demand WHERE `status`=0 and send_time <= ' . time())->queryOne();

    }

    //改变发送状态
    public function update_edai_new_duanxinlog_demand($id)
    {
        return \Yii::$app->db->createCommand("UPDATE edai_new_duanxinlog_demand SET `status` = '1' WHERE `id` = {$id}")->execute();

    }

    //获取短信模板
    public function get_edai_new_sms_template($id)
    {
        return \Yii::$app->db->createCommand("select * from edai_new_sms_template WHERE `id`={$id}")->queryOne();

    }

    //获取短信方案发送人
    public function get_edai_new_duanxinlog_type($id)
    {
        return \Yii::$app->db->createCommand("select * from edai_new_duanxinlog_type WHERE `id`={$id}")->queryOne();

    }

    //获取短信方案发送人 根据等级
    public function get_edai_usersystab($where, $type,$offset)
    {
        //Analyze

        $this->count = (new \yii\db\Query());
        $count = $this->count->select('u.userphone')
            ->from(['u' => 'edai_usersystab'])
            //用户实名信息表
            ->leftJoin('edai_memberinfotb as m', 'm.miuid = u.unumbers')
            ->where(['u.teshuhao' => 1])
            ->andWhere("u.userphone not in (select phone FROM edai_new_duanxinlogs WHERE type={$type})")
        ;
        //调用钩子函数加入条件查询
        $this->where($where);
        $count = $count->limit(3000)->offset($offset)->createCommand();
        $count=$count->queryAll();
//        echo $count;
//        echo "\r\n";
//        var_dump(count($count));
        return $count;
    }

    //获取短信方案发送人 根据等级 计数出总共人数
    public function get_edai_usersystab_count($where, $type)
    {
        $this->count = (new \yii\db\Query());
        $count = $this->count->select('count("u.uid") as count')
            ->from(['u' => 'edai_usersystab'])
            //用户实名信息表
            ->leftJoin('edai_memberinfotb as m', 'm.miuid = u.unumbers')
            ->where(['u.teshuhao' => 1])
            ->andWhere("u.userphone not in (select phone FROM edai_new_duanxinlogs WHERE `type`={$type})")
        ;
        //调用钩子函数加入条件查询
        $this->where($where);
        $count = $count->createCommand()->queryOne();
        return $count;
    }

    //批量插入发送记录
    public function add_edai_new_duanxinlog($data)
    {
        $cmd = \yii::$app->db;
//        return $cmd->createCommand()->insert(self::TABLE_NAME,['name'=>'cs'])->execute();
        return $cmd->createCommand()->batchInsert('edai_new_duanxinlogs', ['phone', 'content', 'state', 'type','addtime','limit_date']
            , $data
        )->execute();
    }

    //改变发送状态短信记录表
    public function update_edai_new_duanxinlog($phone, $status, $type)
    {
        return \Yii::$app->db->createCommand("UPDATE edai_new_duanxinlogs SET `state` = '{$status}' WHERE type='{$type}' and `phone` = {$phone}")->execute();

    }

    //钩子函数
    private function where($where)
    {
        foreach ($where as $v) {
            $this->count->andWhere($v);
        }
    }

    //获取今天需要发送多少生日
    public function get_edai_idcard_information_count()
    {
        $time=date('md');
        return \Yii::$app->db->createCommand("select count(id) as count from edai_idcard_information WHERE `birthday`={$time} limit 0,1")->queryOne();

    }
    //获取今天发送人的唯一编号
    public function get_edai_idcard_information_unumbers($limit,$grade)
    {
        $grade=explode(';',$grade);
        $time=date('md');
        //查询需要发送生日人数
        $unumbers=\Yii::$app->db->createCommand("select unumbers  from edai_idcard_information WHERE `birthday`={$time} limit {$limit},3000")->queryAll();
        //查询发送手机号码
        $command=\Yii::$app->db->createCommand("select userphone,grade  from edai_usersystab WHERE    `unumbers`=:unumbers limit 0,1");
        //判断是否发送过了
        $commands=\Yii::$app->db->createCommand("select phone  from edai_new_duanxinlogs WHERE    `phone`=:phone and limit_date=:limit_date limit 0,1");
        $userphone=[];
        foreach($unumbers as $v){
            $userphones=$command->bindValue(':unumbers',$v['unumbers'])->queryOne();
            //判断是否是设置的用户类型
            if(in_array($userphones['grade'],$grade)){

                //判断是否发送过了
                $commands->bindValue(':phone',$userphones['userphone']);
                $commands->bindValue(':limit_date',date('Ymd'));
                $limit=$commands->queryOne();
                //查询出来为空就添加,不为空就是发送了的
                if(empty($limit)){
                    $userphone[]=$userphones['userphone'];
                }
            }

        }
//        array_unshift($userphone,['13438453080']);
//        $userphone[]='13438453080';
        return $userphone;
    }
    //获取自动发送配置
    public function get_edai_automatic_send_config()
    {
        return \Yii::$app->db->createCommand("select id,template_id,`status`,grade from edai_automatic_send_config where status=1  limit 0,1")->queryOne();

    }
    //根据ID获取需要发送是生日短信内容
    public function get_edai_birthday_sms_template($id)
    {
        $connection=\Yii::$app->db;
        $command=$connection->createCommand("SELECT content FROM edai_birthday_sms_template WHERE id=:id");
        $command->bindValue(':id',$id);
        return $command->queryOne();

    }
    //判断手机号码是否被发送过
    public function limit_phone($phone,$type){
        //判断是否发送过了
        $commands=\Yii::$app->db->createCommand("select phone  from edai_new_duanxinlogs WHERE    `phone`=:phone and type=:type limit 0,1");
        $commands->bindValue(':phone',$phone);
        $commands->bindValue(':type',$type);
        return $commands->queryOne();
    }
}