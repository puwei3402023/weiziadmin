<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/16
 * Time: 10:41
 */

namespace frontend\component;

/**
 * 时间插件
 * Class Getdate
 * @package frontend\component
 */
class Getdate
{

    /**
     * 获取指定日期所在月的开始日期与结束日期
     * @param string $date
     * @param boolean 为true返回开始日期，否则返回结束日期
     * @return array 返回时间戳
     * @access private
     */
    public static function getMonthRange( $date, $returnFirstDay = true ) {
        $timestamp = strtotime( $date );
        if ( $returnFirstDay ) {
            $monthFirstDay = date( 'Y-m-1 00:00:00', $timestamp );
            return strtotime($monthFirstDay);
        } else {
            $mdays = date( 't', $timestamp );
            $monthLastDay = date( 'Y-m-' . $mdays . ' 23:59:59', $timestamp );
            return strtotime($monthLastDay);
        }
    }

    /**
     * @param $date 给定时间返回当天开始时间和结束时间
     * @param bool|true $returnFirstDay true 返回开始时间 false返回结束时间
     * @return int
     */
    public static function getday($date, $returnFirstDay = true){

        $timestamp = strtotime( $date );
        if ( $returnFirstDay ) {
            $monthFirstDay = date( 'Y-m-d 00:00:00', $timestamp );
            return strtotime($monthFirstDay);
        } else {
            $monthLastDay = date( 'Y-m-d 23:59:59', $timestamp );
            return strtotime($monthLastDay);
        }
    }
    /**
     * @param $date 给定时间返回当时间开始时间和结束时间
     * @param bool|true $returnFirstDay true 返回开始时间 false返回结束时间
     * @return int
     */
    public static function gethour($date, $returnFirstDay = true){

        $timestamp = strtotime( $date );
//        var_dump($date);
        if ( $returnFirstDay ) {
            $monthFirstDay = date( 'Y-m-d H:00:00', $timestamp );
            return strtotime($monthFirstDay);
        } else {
            $monthLastDay = date( 'Y-m-d H:59:59', $timestamp );
            return strtotime($monthLastDay);
        }
    }

    /**
     * 身份证提取生日
     * @param $IDCard
     * @param int $format
     * @return mixed
     */
    public static function getIDCardInfo($IDCard,$format=1){
        $result['error']=0;//0：未知错误，1：身份证格式错误，2：无错误
        $result['flag']='';//0标示成年，1标示未成年
        $result['tdate']='';//生日，格式如：2012-11-15
        if(!preg_match("/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/",$IDCard)){
            $result['error']=1;
            return $result;
        }else{
            if(strlen($IDCard)==18)
            {
                $tyear=intval(substr($IDCard,6,4));
                $tmonth=intval(substr($IDCard,10,2));
                $tday=intval(substr($IDCard,12,2));
            }
            elseif(strlen($IDCard)==15)
            {
                $tyear=intval("19".substr($IDCard,6,2));
                $tmonth=intval(substr($IDCard,8,2));
                $tday=intval(substr($IDCard,10,2));
            }

            if($tyear>date("Y")||$tyear<(date("Y")-100))
            {
                $flag=0;
            }
            elseif($tmonth<0||$tmonth>12)
            {
                $flag=0;
            }
            elseif($tday<0||$tday>31)
            {
                $flag=0;
            }else
            {
                if($format)
                {
                    $tdate=$tyear."-".$tmonth."-".$tday;
                }
                else
                {
                    $tdate=$tmonth."-".$tday;
                }

                if((time()-mktime(0,0,0,$tmonth,$tday,$tyear))>18*365*24*60*60)
                {
                    $flag=0;
                }
                else
                {
                    $flag=1;
                }
            }
        }
        $result['error']=2;//0：未知错误，1：身份证格式错误，2：无错误
        $result['isAdult']=$flag;//0标示成年，1标示未成年
        $result['birthday']=$tdate;//生日日期
        return $result;
    }

    /**
     * 给定开始时间和结束时间返回天数
     * @param $begin_time
     * @param $end_time
     * @return array
     */
    public static function timediff( $begin_time, $end_time )
    {
        if ( $begin_time < $end_time ) {
            $starttime = $begin_time;
            $endtime = $end_time;
        } else {
            $starttime = $end_time;
            $endtime = $begin_time;
        }
        $timediff = $endtime - $starttime;
        $days = intval( $timediff / 86400 );
        $remain = $timediff % 86400;
        $hours = intval( $remain / 3600 );
        $remain = $remain % 3600;
        $mins = intval( $remain / 60 );
        $secs = $remain % 60;
        $res = array( "day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs );
        return $res;
    }
    /**
     * 传入日期格式或时间戳格式时间，返回与当前时间的差距，如1分钟前，2小时前，5月前，3年前等
     * @param string or int $date 分两种日期格式"2013-12-11 14:16:12"或时间戳格式"1386743303"
     * @param int $type
     * @return string
     */
    public static function formatTime($date = 0, $type = 1) { //$type = 1为时间戳格式，$type = 2为date时间格式
        date_default_timezone_set('PRC'); //设置成中国的时区
        switch ($type) {
            case 1:
                //$date时间戳格式
                $second = time() - $date;
                $minute = floor($second / 60) ? floor($second / 60) : 1; //得到分钟数
                if ($minute >= 60 && $minute < (60 * 24)) { //分钟大于等于60分钟且小于一天的分钟数，即按小时显示
                    $hour = floor($minute / 60); //得到小时数
                } elseif ($minute >= (60 * 24) && $minute < (60 * 24 * 30)) { //如果分钟数大于等于一天的分钟数，且小于一月的分钟数，则按天显示
                    $day = floor($minute / ( 60 * 24)); //得到天数
                } elseif ($minute >= (60 * 24 * 30) && $minute < (60 * 24 * 365)) { //如果分钟数大于等于一月且小于一年的分钟数，则按月显示
                    $month = floor($minute / (60 * 24 * 30)); //得到月数
                } elseif ($minute >= (60 * 24 * 365)) { //如果分钟数大于等于一年的分钟数，则按年显示
                    $year = floor($minute / (60 * 24 * 365)); //得到年数
                }
                break;
            case 2:
                //$date为字符串格式 2013-06-06 19:16:12
                $date = strtotime($date);
                $second = time() - $date;
                $minute = floor($second / 60) ? floor($second / 60) : 1; //得到分钟数
                if ($minute >= 60 && $minute < (60 * 24)) { //分钟大于等于60分钟且小于一天的分钟数，即按小时显示
                    $hour = floor($minute / 60); //得到小时数
                } elseif ($minute >= (60 * 24) && $minute < (60 * 24 * 30)) { //如果分钟数大于等于一天的分钟数，且小于一月的分钟数，则按天显示
                    $day = floor($minute / ( 60 * 24)); //得到天数
                } elseif ($minute >= (60 * 24 * 30) && $minute < (60 * 24 * 365)) { //如果分钟数大于等于一月且小于一年的分钟数，则按月显示
                    $month = floor($minute / (60 * 24 * 30)); //得到月数
                } elseif ($minute >= (60 * 24 * 365)) { //如果分钟数大于等于一年的分钟数，则按年显示
                    $year = floor($minute / (60 * 24 * 365)); //得到年数
                }
                break;
            default:
                break;
        }
        if (isset($year)) {
            return $year . '年前发布';
        } elseif (isset($month)) {
            return $month . '月前发布';
        } elseif (isset($day)) {
            return $day . '天前发布';
        } elseif (isset($hour)) {
            return $hour . '小时前发布';
        } elseif (isset($minute)) {
            return $minute . '分钟前发布';
        }
    }
}