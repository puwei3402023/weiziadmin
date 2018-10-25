<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/15
 * Time: 15:42
 */

namespace backend\controllers;


use frontend\component\session;
use yii\web\Controller;

class MsgController extends Controller
{

    /**
     * 通用成功跳转
     * @param unknown $url 成功后跳转的URL
     * @param number $sec 自动跳转秒数
     * @return Ambigous <string, string>
     */
    public  function actionError($msg= '权限不足请联系管理员',$sec = 3,$url=''){
//        $msg=session::get('MSG_INFO')?session::get('MSG_INFO'):'';
        return $this->renderPartial('msgerror',['errorMessage'=>$msg,'sec'=>$sec,'url'=>$url]);
    }
    public  function actionError2($msg= '权限不足请联系管理员',$sec = 3,$url=''){
        return $this->renderPartial('msg2',['errorMessage'=>$msg,'sec'=>$sec,'url'=>$url]);
    }
    /**
     * 通用错误跳转
     * @param string $msg 错误提示信息
     * @param number $sec
     * @return Ambigous <string, string>
     */
    public function actionSuccess($url= [] ,$sec = 3){
        $url= empty($url)? ['/index/index']: $url;
        $url= \yii\helpers\Url::toRoute($url);
        return $this->renderPartial('msg',['gotoUrl'=>$url,'sec'=>$sec]);
    }

    public function action404()
    {
        return $this->renderPartial('404');
    }
    /**
     * 刷新次数限制
     */
    /**
     * @param $url 需要跳转的URL
     * @param int $sec 时间
     * @return string
     */
    public function actionLimit($url='',$sec = 10){
        $this->layout='common';
        return $this->render('limit',['gotoUrl'=>$url,'sec'=>$sec]);
    }
}