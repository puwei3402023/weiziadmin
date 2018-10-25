<?php
namespace backend\component;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/5
 * Time: 10:48
 */
/**
 * 输出信息
 * Class Message
 * @package backend\component
 */
class Message
{
    /**
     * Message::json_msg($permissions,1);
     * Message::json_msg(false);
     * @param $fn_data 返回数据
     * @param string $msg 错误信息
     * @param int $count 页数
     * @param string $url 返回URL地址
     * @return string
     */
    public static function json_msg($fn_data,$count=1,$msg='',$data=[],$url=''){
        if($fn_data!==false){
            $data['rel']=true;
            $data['msg']=$msg?$msg:'成功';
            $data['count']=$count;
            $data['list']=$fn_data;
            $data['url']=$url;
        }else{
            $data['rel']=false;
            $data['msg']=$msg?$msg:'失败';

            $data['count']=$count;
            $data['list']=[];
        }
        return  \yii\helpers\Json::encode($data);
    }
    //获取model错误信息
    public static function get_model_error($model){
        $data='';
        //查看错误信息
        if($model->hasErrors()){
            //获取错误信息
            $tem=$model->getErrors();
            foreach($tem as $rows){
                foreach($rows as $row ){
//                            $data['info'].=mb_convert_encoding($row,'GBK','UTF-8');
                    $data.="<br/>".$row;
                }
            }
        }
        return $data;
    }
}