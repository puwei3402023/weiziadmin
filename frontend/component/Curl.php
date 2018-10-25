<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/29
 * Time: 10:34
 */

namespace frontend\component;


class Curl
{

    public function curl_Get($uri, $params='', $method = 'GET'){

            $apiUrl =  'https://www.bao.cn/managerCenter/port/updateUser'. $uri;
//            if($method == 'get'){
//                $url = $apiUrl."page=10&amp;psize=10&amp";
//            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
            //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
            if($method == 'POST') {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $uri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $cc=curl_exec($ch);
            curl_close($ch);
            return $cc;


    }
}