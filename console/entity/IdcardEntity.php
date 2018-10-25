<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/19
 * Time: 11:16
 */

namespace console\entity;


class IdcardEntity
{

    //获取还有多少身份证没有解析
    public function get_idcard_count(){
        return \Yii::$app->db->createCommand("SELECT COUNT(m.`miuid`)as count FROM edai_memberinfotb AS m
   LEFT JOIN edai_usersystab AS u
   ON m.miuid=u.`unumbers`
    WHERE m.`miidcard` !='' AND u.`teshuhao`=1 AND m.`miidcard` NOT IN (SELECT idcard FROM edai_idcard_information ) LIMIT 0,1")->queryOne();
    }
    //获取身份证
    public function get_idcard($offset=0){
        return \Yii::$app->db->createCommand("SELECT u.unumbers,m.`miidcard` FROM edai_memberinfotb AS m
   LEFT JOIN edai_usersystab AS u
   ON m.miuid=u.`unumbers`
    WHERE m.`miidcard` !='' AND u.`teshuhao`=1 AND m.`miidcard` NOT IN (SELECT idcard FROM edai_idcard_information ) LIMIT {$offset},10000")->queryAll();
    }

    //批量插入身份证信息
    public function add_edai_idcard_information($data)
    {
        $cmd = \yii::$app->db;
//        return $cmd->createCommand()->insert(self::TABLE_NAME,['name'=>'cs'])->execute();
        return $cmd->createCommand()->batchInsert('edai_idcard_information', ['sex', 'birthday', 'dateofbirth_years','province', 'city','county','unumbers','idcard']
            , $data
        )->execute();
    }
}