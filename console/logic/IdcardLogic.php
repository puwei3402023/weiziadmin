<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/19
 * Time: 9:59
 */

namespace console\logic;


use console\entity\IdcardEntity;

class IdcardLogic
{
    public function index(){
        echo mb_convert_encoding("开始执行", "gbk", "UTF-8");
        echo "\n\r";
        $City = array(11=>"北京",12=>"天津",13=>"河北",14=>"山西",15=>"内蒙古",21=>"辽宁",22=>"吉林",23=>"黑龙江",31=>"上海",32=>"江苏",33=>"浙江",34=>"安徽",35=>"福建",36=>"江西",37=>"山东",41=>"河南",42=>"湖北",43=>"湖南",44=>"广东",45=>"广西",46=>"海南",50=>"重庆",51=>"四川",52=>"贵州",53=>"云南",54=>"西藏",61=>"陕西",62=>"甘肃",63=>"青海",64=>"宁夏",65=>"新疆",71=>"台湾",81=>"香港",82=>"澳门",91=>"国外");
        //首先获取身份证有好多没有解析
        $idcardEntity=new IdcardEntity();
        $idcard_count=$idcardEntity->get_idcard_count();
        $limit=0;
        $sum=0;
        while($idcard_count['count']>0){
            $idcard_count['count']-=10000;
            $idcard=$idcardEntity->get_idcard($limit);
            $data=[];
            foreach($idcard as $v){
                $IDCardcode=$this->getIDCardInfo($v['miidcard']);
//                var_dump($IDCardcode);
                //身份证正确才加人
                if($IDCardcode['error']==2){
                    $sum++;
                  $data[]=[
                      $IDCardcode['sex'],
                      $IDCardcode['birthdays'],
                      $IDCardcode['birthday'],
                      $IDCardcode['province'],
                      $IDCardcode['city'],
                      $IDCardcode['county'],
                      $v['unumbers'],
                      $v['miidcard'],
                  ];
                }

            }
            //计算完成批量加人数据库
            if(!empty($data))
                $idcardEntity->add_edai_idcard_information($data);
        }

        echo mb_convert_encoding("执行结束", "gbk", "UTF-8");
        return $sum;
    }
    public function getIDCardInfo($IDCard){
        $result['error']=0;//0：未知错误，1：身份证格式错误，2：无错误
        $result['flag']='';//0标示成年，1标示未成年
        $result['tdate']='';//生日，格式如：2012-11-15
        $tdays='';//生日日期
        $sex='';//性别
        $province='';//省代码
        $city='';//城市代码
        $county='';//区县代码
        $tdate='';
        $flag='';
        $p=preg_match_all("/^[1-9]([0-9a-zA-Z]{17}|[0-9a-zA-Z]{14})$/",$IDCard);
        if(!$p){
            $result['error']=1;
            return $result;
        }else{
            if(strlen($IDCard)==18){
                $tyear=(substr($IDCard,6,4));
                $tmonth=(substr($IDCard,10,2));
                $tday=(substr($IDCard,12,2));
                $tdays=(substr($IDCard,10,4));//获取生日
                $sexstr=(substr($IDCard,16,1));//获取性别
                $province=(substr($IDCard,0,2));//省代码
                $city=(substr($IDCard,2,2));//城市代码
                $county=(substr($IDCard,4,2));//区县代码
                if($sexstr>=0){
                    $sex=$sexstr%2;
                }
                if($tyear>date("Y")||$tyear<(date("Y")-100)){
                    $flag=0;
                }elseif($tmonth<0||$tmonth>12){
                    $flag=0;
                }elseif($tday<0||$tday>31){
                    $flag=0;
                }else{
                    $tdate=$tyear;
//                    if((time()-mktime(0,0,0,$tmonth,$tday,$tyear))>18*365*24*60*60){
//                        $flag=0;
//                    }else{
//                        $flag=1;
//                    }
                }
            }elseif(strlen($IDCard)==15){
                $tyear=intval("19".substr($IDCard,6,2));
                $tmonth=intval(substr($IDCard,8,2));
                $tday=(substr($IDCard,10,2));
                $tdays=(substr($IDCard,8,4));//生日
                $sexstr=(substr($IDCard,14,1));//获取性别
                $province=(substr($IDCard,0,2));//省代码
                $city=(substr($IDCard,2,2));//城市代码
                $county=(substr($IDCard,4,2));//区县代码
                if($sexstr>=0){
                    $sex=$sexstr%2;
                }
                if($tyear>date("Y")||$tyear<(date("Y")-100)){
                    $flag=0;
                }elseif($tmonth<0||$tmonth>12){
                    $flag=0;
                }elseif($tday<0||$tday>31){
                    $flag=0;
                }else{
                    $tdate=$tyear;
//                    if((time()-mktime(0,0,0,$tmonth,$tday,$tyear))>18*365*24*60*60){
//                        $flag=0;
//                    }else{
//                        $flag=1;
//                    }
                }
            }
        }
        $result['error']=2;//0：未知错误，1：身份证格式错误，2：无错误
        $result['isAdult']=$flag;//0标示成年，1标示未成年
        $result['birthday']=$tdate;//出生日期
        $result['birthdays']=$tdays;//生日日期
        $result['sex']=$sex;//性别
        $result['province']=$province;//省代码
        $result['city']=$city;//城市
        $result['county']=$county;//区县
        return $result;
    }


}