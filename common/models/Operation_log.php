<?php
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2016/12/5
 * Time: 14:26
 */

namespace common\models;


use yii\db\ActiveRecord;

class Operation_log extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
//        return '{{%user}}';
        return '{{%operation_log}}';
    }

    public static function getDb()
    {
        return \Yii::$app->db2;  // 使用名为 "db2" 的应用组件
    }
}