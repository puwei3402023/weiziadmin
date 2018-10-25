<?php
namespace common\component;

use yii\web\Cookie;

class session
{

    /**
     * 设置session
     * @param $key
     * @param $value
     */
    public static function set($key,$value)
    {
        \Yii::$app->session->set($key,$value);
    }

    /**
     * 获取session
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        return \Yii::$app->session->get($key);
    }

    /**
     * 删除session
     * @param $key
     */
    public static function del($key){
        \Yii::$app->session->remove($key);
    }

    /**
     * 特殊session读取一次自动消失
     * 这次设置下次有效
     * @param $key
     * @param $valeu
     */
    public static function setFlash($key,$valeu){
         \Yii::$app->session->setFlash($key,$valeu);
    }

    /**
     * 获取session key就消失
     * @param $ket
     * @return mixed
     */
    public static function getFlash($ket){
        return \Yii::$app->session->getFlash($ket);
    }
    /**
     * 设置cookie
     * @param $key
     * @param $value
     * @param int $expile
     */
    public static function setCookie($key,$value,$expile=20000){
        $coo=new Cookie();
        $coo->name=$key;
        $coo->value=$value;
        $coo->expire=time()+$expile;
        \Yii::$app->response->cookies->add($coo);

    }

    /**
     * 获取cookie
     * @param $key
     * @return Cookie
     */
    public static function getCookie($key){
       return \Yii::$app->request->cookies->get($key);
    }
}