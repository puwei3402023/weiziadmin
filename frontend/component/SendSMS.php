<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/12
 * Time: 15:49
 */

namespace frontend\component;

use frontend\entity\user;

/**
 * 短信发送
 * Class SendSMS
 * @package frontend\component
 */
class SendSMS
{
    //单个用户发送短信,用于用户详情 ,息奥的的
    public static function sendSmsNews($phone, $content)
    {
        //不为空才发送
        if (!empty($content) && !empty($phone)) {
            //记录发送内容
            $userinfo = session::get('USER_INFO');
            $model = new user();
            $dataduanxin=[
                $phone,
                $content,
                time(),
                $userinfo['id'],
                $userinfo['username']
            ];
            $find = [
                'phone', 'content', 'addtime', 'admin_uid', 'admin_name'
            ];
           $logid= $model->sendLog($dataduanxin, $find);
            $duanxinid = '9661802';
            $duanxinpwd = 'bdw888';
            $duanxinqiyecode="bdw";
            /*$duanxinid = '901421';
            $duanxinpwd = 'abc1234';
               $duanxinqiyecode="bdw";*/
            $duanxinauth=MD5($duanxinqiyecode.$duanxinpwd);
            $duanxinmsg='【宝点网】'.$content; //17.4.10去掉了自动添加的短信签名,需要自己添加
//            $url="http://sms.10690221.com:9011/hy/?uid=".$duanxinid."&auth=".$duanxinauth."&mobile=".$phone."&msg=".$duanxinmsg."&expid=0&encode=utf-8";
//            echo $duanxinmsg;
//            $info=file_get_contents($url);
            $url = "http://sms.10690221.com:9011/hy/";
            $post_string = "?uid={$duanxinid}&auth={$duanxinauth}&mobile={$phone}&msg=".urlencode($duanxinmsg)."&expid=0&encode=utf-8";
            $this_header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this_header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $info = curl_exec($ch);
//            echo $data;
            curl_close($ch);
//            return $data;


            $model = new user();
            $dataduanxin=['id'=>$logid];
            $find = [
                'state'=>$info
            ];
//            echo $info;
            $model->updatesendLog($dataduanxin, $find);
            if ($info == 0) {
                return true;
            } else {


                return false;
            }

        }

    }
    //单个用户发送短信,用于用户详情 ,建州的
    public static function sendSmsNew($phone, $content)
    {
        $content.='退订回T'; //建周要加这个   西奥不用这个
        $ch = curl_init();
        if (!defined('CHARSET')) {
            define('CHARSET', 'GBK');
        }
        //不为空才发送
        if (!empty($content) && !empty($phone)) {
            //记录发送内容
            $userinfo = session::get('USER_INFO');
            $model = new user();
            $dataduanxin=[
                $phone,
                $content,
                time(),
                $userinfo['id'],
                $userinfo['username']
            ];
            $find = [
                'phone', 'content', 'addtime', 'admin_uid', 'admin_name'
            ];
           $logid= $model->sendLog($dataduanxin, $find);
//            var_dump($logid);
//            exit;
            $post_data = array(
                "account" => "sdk_baodian2",
                "password" => "028-966180",
                "destmobile" => $phone,
                "msgText" => $content . '【宝点网】',
                "sendDateTime" => ""
            );

            //print_r($post_data);
            curl_setopt($ch, CURLOPT_HEADER, false);
            //启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样。
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);//返回结果设置为true
            $post_data = http_build_query($post_data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_URL, 'http://www.jianzhou.sh.cn/JianzhouSMSWSServer/http/sendBatchMessage');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            try {
                $info = curl_exec($ch);
            } catch (\Exception $ex) {
                $ex->getMessage();

//            write_log($phone."短信发送失败，错误:".$ex, LOG_ERR);
            }
            $model = new user();
            $dataduanxin=['id'=>$logid];
            $find = [
                'state'=>$info
            ];
            $model->updatesendLog($dataduanxin, $find);
            //curl_exec($ch);
            curl_close($ch);
            if ($info > 0) {
                return true;
            } else {


                return false;
            }

        }

    }
    //群发短信,用于cli发送
    public static function sendSmsNewAll($phone, $content)
    {

        /*        $data['msg']=$content;
                $data['data']=[
                    'phone'=>$phone,
                    'tempid'=>$tempid,
                ];
                $status=gearman('sms',$data);
                return $status;*/

        $ch = curl_init();
        if (!defined('CHARSET')) {
            define('CHARSET', 'GBK');
        }
        //不为空才发送
        if (!empty($content) && !empty($phone)) {


            $post_data = array(
                "account" => "sdk_baodian2",
                "password" => "028-966180",
                "destmobile" => $phone,
                "msgText" => $content . '【宝点网】',
                "sendDateTime" => ""
            );
            //print_r($post_data);
            curl_setopt($ch, CURLOPT_HEADER, false);
            //启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样。
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);//返回结果设置为true
            $post_data = http_build_query($post_data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_URL, 'http://www.jianzhou.sh.cn/JianzhouSMSWSServer/http/sendBatchMessage');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            try {
                $info = curl_exec($ch);
            } catch (\Exception $ex) {
                $ex->getMessage();

//            write_log($phone."短信发送失败，错误:".$ex, LOG_ERR);
            }

            //curl_exec($ch);
            curl_close($ch);


            return $info;


        }

    }


    /**
     * 需要过滤的字符串函数
     * @param $str  需要过滤的字符串
     * @return string   返回已经过滤特殊符号的字符串
     */
    public function filter_keyword($str)
    {
        $arr = array();
        preg_match_all("/./su", $str, $arr);
        $okstr = '';
        $fiter_arr = array(
            'ˉ',
            'ˇ',
            '々',
            '—',
            '～',
            '‖',
            '《',
            '》',
            '「',
            '」',
            '『',
            '』',
            '〖',
            '〗',
            '【',
            '】',
            '±',
            '×',
            '÷',
            '∧',
            '∨',
            '∑',
            '∏',
            '∪',
            '∩',
            '∈',
            '∷',
            '√',
            '⊥',
            '∥',
            '∠',
            '⌒',
            '⊙',
            '∫',
            '∮',
            '≡',
            '≌',
            '≈',
            '∽',
            '∝',
            '≠',
            '≮',
            '≯',
            '≤',
            '≥',
            '∞',
            '∵',
            '∴',
            '♂',
            '♀',
            '℃',
            '¤',
            '￠',
            '￡',
            '‰',
            '§',
            '№',
            '☆',
            '★',
            '○',
            '●',
            '◎',
            '◇',
            '◆',
            '□',
            '■',
            '△',
            '▲',
            '※',
            '→',
            '←',
            '↑',
            '↓',
            '〓',
            '＃',
            '＇',
            '＊',
            '＋',
            '－',
            '＜',
            '＞',
            '＠',
            '＾',
            '｀',
        );
        foreach ($arr[0] as $a) {

//            if (strlen($a) == 1 && !preg_match("/[0-9a-z@_:\.\+-]/i", $a)) {
//                $okstr.= ' ';
//            } else {
            $okstr .= in_array($a, $fiter_arr) ? ' ' : $a;
//            }
        }
        $okstr = trim(preg_replace("/[ ]{1, }/", ' ', $okstr));
        return $okstr;
    }
}