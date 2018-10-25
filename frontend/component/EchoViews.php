<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/2
 * Time: 16:29
 */

namespace frontend\component;


class EchoViews
{
    /**
     * 视图输出
     * @param $data
     * @param string $default
     * @return string
     */
    public static function data($data,$default=''){
        return empty($data)?$default:$data;
    }

    /**
     * 判断2个值是否一样不一样输入空
     * @param $data
     * @param $value
     * @param $default
     */
    public static function is_data($data,$value,$default='')
    {
        return ($data==$value)?$default:'';
    }
}