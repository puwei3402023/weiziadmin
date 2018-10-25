<?php
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2016/10/27
 * Time: 17:27
 */

namespace console\entity;


class UserlevelsEntity
{
    /**
     * 保存DB对象
     * @var
     */
    public $db;
    /**
     * 保存事物对象,后期好提交使用
     * @var
     */
    public $trans;

    public function __construct()
    {
        $this->db = \Yii::$app->db;
    }

    /**
     * 开启事物
     */
    public function beginTransaction()
    {
        $this->trans = $this->db->beginTransaction();
    }

    /**
     * 提交事物
     */
    public function commit()
    {
        $this->trans->commit();
    }

    /**
     * 反回事物
     */
    public function rollBack()
    {
        $this->trans->rollBack();
    }

    /**
     * 清空等级表
     * @throws \yii\db\Exception
     */
    public function delete_edai_user_level()
    {
        $connection = $this->db;
        $connection->createCommand("TRUNCATE edai_user_level")->execute();
    }


    /**
     * 查询大于当前时间的直投数量
     * @param string $time 大于当前到期
     * @param int $is_transfer 0为正常直投,2为债权转让
     * @return array|false
     */
    public function get_edai_borrow_investor_count($time = '',$is_transfer=0)
    {
        $connection = $this->db;
        $command = $connection->createCommand("SELECT
      count(*)as count
      FROM
        edai_borrow_investor AS i
        LEFT JOIN edai_borrowinfo AS b
          ON i.borrow_id = b.edid
           LEFT JOIN edai_usersystab AS u
          ON u.unumbers=i.investor_uid
          WHERE u.teshuhao=1 and u.uisban=0 and i.is_transfer={$is_transfer} AND i.`deadline`>{$time} limit 0,1
   ");
        $count = $command->queryOne();
        return $count;
    }

    /**
     * 查询大于当前时间的直投
     * @param string $time
     */
    /**
     * @param string $time 大于到期时间的到期
     * @param int $limit 限制查询条数
     * @param int $is_transfer 0为正常直投 2为债权
     * @return array
     */
    public function get_edai_borrow_investor($time = '', $limit = 0,$is_transfer=0)
    {
        $connection = $this->db;
        $command = $connection->createCommand("SELECT
        i.investor_capital AS money,
        b.borrow_duration AS duration,
        u.unumbers,
        i.id,
        u.uid
      FROM
        edai_borrow_investor AS i
        LEFT JOIN edai_borrowinfo AS b
          ON i.borrow_id = b.edid
           LEFT JOIN edai_usersystab AS u
          ON u.unumbers=i.investor_uid
          WHERE u.teshuhao=1 and u.uisban=0 and i.is_transfer={$is_transfer} AND i.`deadline`>{$time} limit {$limit},5000
   ");
        return $command->queryAll();
    }

    /**
     * 添加用户等级资金入库
     * @param $data
     * @throws \yii\db\Exception
     */
    public function add_edai_user_level($data)
    {
        $connection = $this->db;
        $connection->createCommand()->batchInsert('edai_user_level', ['unumbers', 'update_time', 'duein_money','uid']
            , $data
        )->execute();
    }

    /**
     * 查询大于当前时间的定存数量
     * @param string $time
     */
    public function get_edai_licaitoubiaoku_new_count($time = '')
    {
        $connection = $this->db;
        $command = $connection->createCommand(" SELECT
       COUNT(*)as count
      FROM
        edai_licaitoubiaoku_new AS l
        LEFT JOIN edai_usersystab AS u
        ON u.unumbers=l.ltinvestoruid
      WHERE u.teshuhao=1  AND u.uisban=0 AND l.ltmanbiao > '{$time}'  limit 0,1
   ");
        $count = $command->queryOne();
        return $count;
    }

    /**
     * 查询大于当前时间的定存
     * @param string $time
     */
    public function get_edai_licaitoubiaoku_new($time = '', $limit = 0)
    {
        $connection = $this->db;
        $command = $connection->createCommand(" SELECT
     l.ltinvestormoney AS money,
        l.ltqixian AS duration,
        u.unumbers,
        u.uid
      FROM
        edai_licaitoubiaoku_new AS l
        LEFT JOIN edai_usersystab AS u
        ON u.unumbers=l.ltinvestoruid
      WHERE u.teshuhao=1  AND u.uisban=0 AND l.ltmanbiao > '{$time}'  limit {$limit},5000
   ");
        $count = $command->queryAll();
        return $count;
    }

    /**
     * 查询债权用户信息数量
     * @param string $time
     */
    public function get_user_transfer_count($tid = '')
    {
        $connection = $this->db;
        $command = $connection->createCommand(" SELECT COUNT(*)as count FROM edai_transfer AS t
  LEFT JOIN edai_transfer_user AS tu ON tu.`tid`=t.`id` WHERE t.invesid IN ($tid)  limit 1
   ");
        $count = $command->queryOne();
        return $count;
    }
    /**
     * 查询到期大于当前债权用户信息数量
     * @param string $time
     */
    public function get_user_transfer_counts($time)
    {
        $connection = $this->db;
        $command = $connection->createCommand(" SELECT
COUNT(*)as `count`
FROM
  edai_transfer AS t
  LEFT JOIN edai_borrow_investor AS b
    ON b.id = t.`invesid`
    LEFT JOIN edai_borrowinfo AS bo
    ON bo.edid=b.`borrow_id`
    LEFT JOIN `edai_transfer_user` AS tu
    ON tu.tid=t.`id`
   WHERE bo.`deadline` >= {$time} limit 1
   ");
        $count = $command->queryOne();
        return $count;
    }
    /**
     * 查询债权用户信息
     * @param string $time
     */
    public function get_user_transfer($time, $limit = 0)
    {
        $connection = $this->db;
        $command = $connection->createCommand(" SELECT
tu.`uid`,tu.`loan_money`,(t.total-t.`has_transfer`)as has_transfer,u.unumbers
FROM
  edai_transfer AS t
  LEFT JOIN edai_borrow_investor AS b
    ON b.id = t.`invesid`
    LEFT JOIN edai_borrowinfo AS bo
    ON bo.edid=b.`borrow_id`
    LEFT JOIN `edai_transfer_user` AS tu
    ON tu.tid=t.`id`
    LEFT JOIN edai_usersystab as u 
    on u.uid=tu.uid
   WHERE bo.`deadline` >= {$time} limit {$limit},5000
   ");
        $count = $command->queryAll();
        return $count;
    }
    /**
     * 根据用户UID查询用户唯一编号
     * @param string $time
     */
    public function get_user_unumbers($uid)
    {
        $connection = $this->db;
        $command = $connection->createCommand(" SELECT unumbers FROM edai_usersystab WHERE uid=:uid limit 1");
        $command->bindValue(':uid',$uid);
        $count = $command->queryOne();
        return $count['unumbers'];
    }

    /**
     * 查询大于当前时间的定存B数量
     * @param string $time
     */
    public function get_edai_deposit_invest_count($time = '')
    {
        $connection = $this->db;
        $command = $connection->createCommand(" SELECT 
count(*) as `count`
FROM `edai_deposit_invest` AS d
LEFT JOIN `edai_deposit` AS de
ON de.`id`=d.`pid`
LEFT JOIN `edai_deposit_refund` AS dr
ON dr.`invest_id`=d.`id`
LEFT JOIN edai_usersystab AS u
ON d.`uid`=u.`uid`
WHERE  u.uisban=0 AND u.`teshuhao`=1
AND dr.`deal_time` >= :time AND `de`.`month`=dr.num limit 0,1
   ");
        $command->bindValue(':time',$time);
        $count = $command->queryOne();
        return $count;
    }
    /**
     * 查询大于当前时间的定存B
     * @param string $time
     */
    public function get_edai_deposit_invest($time = '',$limit)
    {
        $connection = $this->db;
        $command = $connection->createCommand(" SELECT 
u.unumbers,
u.uid,
d.invest_money as money,
`de`.`month` AS duration
FROM `edai_deposit_invest` AS d
LEFT JOIN `edai_deposit` AS de
ON de.`id`=d.`pid`
LEFT JOIN `edai_deposit_refund` AS dr
ON dr.`invest_id`=d.`id`
LEFT JOIN edai_usersystab AS u
ON d.`uid`=u.`uid`
WHERE  u.uisban=0 AND u.`teshuhao`=1
AND dr.`deal_time` >= :time AND `de`.`month`=dr.num limit {$limit},5000
   ");
        $command->bindValue(':time',$time);
        $count = $command->queryAll();
        return $count;
    }
}