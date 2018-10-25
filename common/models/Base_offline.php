<?php
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2017/1/3
 * Time: 15:44
 */

namespace common\models;


use yii\db\ActiveRecord;

/**
 * 用户待收 查询线下
 * Class Duein
 * @package common\models
 */
class Base_offline extends ActiveRecord
{
    public $db_name='db';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usersysmoneytab}}';
    }

    public static function getDb()
    {
        return \Yii::$app->db2;  // 使用名为 "db2" 的应用组件
    }
}