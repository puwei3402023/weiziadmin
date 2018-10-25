<?php
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2016/12/13
 * Time: 9:13
 */

namespace common\models;


use yii\db\ActiveRecord;

class ChannelPrincipal extends ActiveRecord
{
        /**
     * @inheritdoc
     */
    public static function tableName()
    {
//        return '{{%user}}';
        return '{{%source_analyze_type_principal}}';
    }

    public static function getDb()
    {
        return \Yii::$app->db2;  // 使用名为 "db2" 的应用组件
    }
}