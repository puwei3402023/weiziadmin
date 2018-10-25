<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21
 * Time: 9:48
 */

namespace console\entity;


class UserInvestEntity
{

    /**
     * 获取用户H类型数量
     */
    public function get_user_H_count(){
        $db=(new \yii\db\Query());
        return $db->from('edai_usersystab')
            ->where(['grade'=>"H",'teshuhao'=>1,'uisban'=>0])
            ->count();
    }
    /**
     * 清空H类用户总投资金额表
     * @throws \yii\db\Exception
     */
    public function delete_edai_user_h_invest_money()
    {
        $connection = \Yii::$app->db;
        $connection->createCommand("TRUNCATE edai_user_h_invest_money")->execute();
    }
    /**
     * 添加H类用户总投资金额,次数入库
     * @param $data
     * @throws \yii\db\Exception
     */
    public function add_edai_user_h_invest_money($data)
    {
        $connection = \Yii::$app->db;
        $connection->createCommand()->batchInsert('edai_user_h_invest_money', ['uid', 'unumbers', 'money','invest_count']
            ,$data
        )->execute();
    }
    //获取H类用户的总投资金额,总投资次数
    public function get_user_invest_sum_money($limit=0){
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT SUM(a.money) AS money,COUNT(a.uid)AS `count`,a.uid,a.unumbers FROM (
SELECT
l.ltinvestormoney AS money,u.uid,u.unumbers
FROM
edai_licaitoubiaoku_new AS l
LEFT JOIN edai_usersystab AS u
ON u.unumbers=l.ltinvestoruid
WHERE  u.teshuhao=1  AND u.uisban=0 AND u.grade='H'
UNION ALL
SELECT `i`.`capital` AS `money`,u.uid,u.unumbers
FROM
`edai_investordetail` `i`
LEFT JOIN `edai_borrowinfo` `b`
ON i.borrowid = b.edid
LEFT JOIN `edai_usersystab` `u`
ON u.unumbers = i.investoruid
WHERE   i.capital > 0 AND 
`u`.`teshuhao` = '1' AND u.uisban=0 AND u.grade='H'
UNION ALL
SELECT 
 `d`.`invest_money` AS `money`,u.uid,u.unumbers
FROM `edai_deposit_invest` AS d
LEFT JOIN `edai_deposit` AS de
ON de.`id`=d.`pid`
LEFT JOIN edai_usersystab AS u
ON d.`uid`=u.`uid`
WHERE 
 u.uisban=0 AND u.`teshuhao`=1 AND u.grade='H'
UNION ALL
SELECT
tu.loan_money AS money,u.uid,u.unumbers
FROM
edai_transfer_user AS tu
LEFT JOIN edai_transfer AS t
ON tu.tid = t.id
LEFT JOIN edai_usersystab AS u
ON u.`uid`=tu.`uid`
WHERE 
 u.uisban=0 AND u.`teshuhao`=1  AND u.grade='H'
)AS a  GROUP BY a.uid limit {$limit},5000");
        return $command->queryAll();
    }
}