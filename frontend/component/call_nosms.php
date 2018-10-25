<?php
namespace frontend\component;

class call_nosms{
    public function index(){
        $ch = curl_init();
        $post_data = array(
            "account" => "jz004",
            "password" => "xxxx",
            "destmobile" => "18717830363",
            "msgText" => "6666你好【建周科技】",
            "sendDateTime" => ""
        );

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
        $post_data = http_build_query($post_data);
//echo $post_data;
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch, CURLOPT_URL, 'http://www.jianzhou.sh.cn/JianzhouSMSWSServer/http/sendBatchMessage');
//$info=
        curl_exec($ch);
//curl_close($ch);
    }
}



