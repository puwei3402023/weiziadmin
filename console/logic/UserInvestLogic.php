<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21
 * Time: 9:43
 */

namespace console\logic;


use console\entity\UserInvestEntity;

class UserInvestLogic
{

    public function index(){
        $user_entity=new UserInvestEntity();
        //首先清空表
        $user_entity->delete_edai_user_h_invest_money();
        $count_user_h=$user_entity->get_user_H_count();
        $limit=0;
        $sum_count=0;
        while ($count_user_h>0){
           $count_user_h-=5000;
            //获取用户的总投资金额
            $user_invest_list=$user_entity->get_user_invest_sum_money($limit);
            $user_data=[];
            foreach ($user_invest_list as $value){
                $sum_count++;
                $user_data[]=[
                    'uid'=>$value['uid'],
                    'unumbers'=>$value['unumbers'],
                    'money'=>$value['money'],
                    'invest_count'=>$value['count'],
                ];
            }
            //不为空才去添加
            if(!empty($user_data)){
                $user_entity->add_edai_user_h_invest_money($user_data);
            }
            $limit+=5000;
        }
        return $sum_count;
    }
}