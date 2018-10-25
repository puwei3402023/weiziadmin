<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/22
 * Time: 14:27
 */
namespace frontend\component;


use yii\base\Action;

class Htm {
   public static function index(){
       return file_get_contents(\Yii::getAlias('@web').'msg/msg.php');
   }
}