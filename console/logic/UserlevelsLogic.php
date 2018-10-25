<?php
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2016/10/27
 * Time: 17:19
 */

namespace console\logic;


use common\log\Log;
use console\entity\UserlevelsEntity;

class UserlevelsLogic
{

    /**
     * 解析用户直投待收
     */
    public function parsing_user_duein()
    {
        echo '直投';
        $time = time();
        $userlevels = new UserlevelsEntity();
        try {
            $userlevels->beginTransaction();//开启事物
            //先清空等级表 清空表数据才有保障
            $userlevels->delete_edai_user_level();
            //查看有好多待收记录 到期时间大于当前时间
            $count = $userlevels->get_edai_borrow_investor_count($time);
            $limit = 0;
            $sumcount = $count['count'];
            while ($count['count'] > 0) {
                $count['count'] -= 5000;
                //循环查询待收
                $counts = $userlevels->get_edai_borrow_investor($time, $limit);
                $data = [];
                foreach ($counts as $v) {
                    $sum = $v['money'] / 12 * $v['duration'];
                    $data[] = [$v['unumbers'], $time, $sum,$v['uid']];
                }
                //插件数据
                $userlevels->add_edai_user_level($data);
                $limit += 5000;
            }
            //提交事物
            $userlevels->commit();
            return $sumcount;
        } catch (\Exception $e) {
            echo '错误';
            $log=new Log();
            $log->set($e,'error2017');
            $userlevels->rollBack();
            return false;
        }

    }

    /**
     * 解析用户定存待收
     */
    public function parsing_user_dueins()
    {
        $userlevels = new UserlevelsEntity();
        $datas = date('Y-m-d H:i:s');
        $time = time();
        try {
            $userlevels->beginTransaction();//开启事物
            //查看有好多待收记录 到期时间大于当前时间
            $count = $userlevels->get_edai_licaitoubiaoku_new_count($datas);
            $limit = 0;
            $sumcount = $count['count'];
            while ($count['count'] > 0) {
                $count['count'] -= 5000;
                //循环查询待收
                $counts = $userlevels->get_edai_licaitoubiaoku_new($datas, $limit);
                $data = [];
                foreach ($counts as $v) {
                    $sum = $v['money'] / 12 * $v['duration'];
                    $data[] = [$v['unumbers'], $time, $sum,$v['uid']];
                }
                //插件数据
                $userlevels->add_edai_user_level($data);
                $limit += 5000;
            }
            //提交事物
            $userlevels->commit();
            return $sumcount;
        } catch (\Exception $e) {
//            var_dump($e);
            $userlevels->rollBack();
            return false;
        }
    }
    /**
     * 解析用户定存b待收
     */
    public function parsing_user_deposit()
    {
        $userlevels = new UserlevelsEntity();
        $time = time();
        try {
            $userlevels->beginTransaction();//开启事物
            //查看有好多待收记录 到期时间大于当前时间
            $count = $userlevels->get_edai_deposit_invest_count($time);
            $limit = 0;
            $sumcount = $count['count'];
            while ($count['count'] > 0) {
                $count['count'] -= 5000;
                //循环查询待收
                $counts = $userlevels->get_edai_deposit_invest($time, $limit);
                $data = [];
                foreach ($counts as $v) {
                    $sum = $v['money'] / 12 * $v['duration'];
                    $data[] = [$v['unumbers'], $time, $sum,$v['uid']];
                }
                //插件数据
                $userlevels->add_edai_user_level($data);
                $limit += 5000;
            }
            //提交事物
            $userlevels->commit();
            return $sumcount;
        } catch (\Exception $e) {
            var_dump($e);
            $log=new Log();
            $log->set($e,'error201701');
            $userlevels->rollBack();
            return false;
        }
    }


    public function edai_borrow_investor()
    {
        $userlevels = new UserlevelsEntity();
        $time = time();
        try {
            $userlevels->beginTransaction();//开启事物
            //查看有好多待收记录 到期时间大于当前时间
            $count = $userlevels->get_user_transfer_counts($time);
            $limit = 0;
            $sumcount = $count['count'];
            while ($count['count'] > 0) {
                $count['count'] -= 5000;
                //循环查询待收
                $counts=$userlevels->get_user_transfer($time,$limit);
                $data = [];
                foreach ($counts as $v) {
                    $sum=$v['loan_money']/12*$v['has_transfer'];
                    $data[] = [$v['unumbers'], $time, $sum,$v['uid']];
                }
                //插件数据
                $userlevels->add_edai_user_level($data);
                $limit += 5000;
            }
            //提交事物
            $userlevels->commit();
            return $sumcount;
        } catch (\Exception $e) {
            $log=new Log();
            $log->set($e,'error201701');
            $userlevels->rollBack();
            return false;
        }
    }


}