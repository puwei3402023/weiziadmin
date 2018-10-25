<?php
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2016/12/1
 * Time: 13:37
 */

namespace common\models;




use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * 渠道分析
 * Class Source
 * @package common\models
 */
class Analyze extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
//        return '{{%user}}';
        return '{{%synthesize_analyze}}';
    }

    public static function getDb()
    {
        return \Yii::$app->db2;  // 使用名为 "db2" 的应用组件
    }
    public function getOrders()
    {
        // 客户和订单通过 Order.customer_id -> id 关联建立一对多关系
        return $this->hasMany(Source::className(), ['id' => 'source_id']);
    }
}