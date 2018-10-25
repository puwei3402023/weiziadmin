<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/10
 * Time: 15:54
 */
namespace frontend\component;

//记录发送内容
use frontend\entity\user;
use frontend\component\session;

class index{
   public function index(){
//       $userinfo = session::get('USER_INFO');
       $model = new user();
       $dataduanxin=[
           11,
           11,
           time(),
           1,
           1
       ];
       $find = [
           'phone', 'content', 'addtime', 'admin_uid', 'admin_name'
       ];
       $aa=$model->sendLog($dataduanxin, $find);
       var_dump($aa);
   }
}

$id=new index();
$id->index();