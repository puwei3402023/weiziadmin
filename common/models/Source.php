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
 * 渠道添加
 * Class Source
 * @package common\models
 */
class Source extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
//        return '{{%user}}';
        return '{{%source_analyze_type}}';
    }

    public static function getDb()
    {
        return \Yii::$app->db2;  // 使用名为 "db2" 的应用组件
    }

    public function getCustomer()
    {
        return $this->hasOne(Analyze::className(), ['source_id' => 'id']);
    }
}