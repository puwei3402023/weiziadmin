<?php
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2016/12/26
 * Time: 15:30
 */

namespace console\logic;
use Yii;
/**
 * 发邮件
 * Class EmailLogic
 * @package console\logic
 */
class EmailLogic
{
    public function index($body,$subject,$title='自动发送'){
        //获取要发送的人
        $users=Yii::$app->params['email_user'];
        $messages = [];
        foreach ($users as $user) {
            $messages[] = Yii::$app->mailer->compose()
                ->setFrom(['puwei@bao.cn'=>$title])
                ->setSubject($subject)
                ->setTextBody($body)
                ->setTo($user);
        }
        return Yii::$app->mailer->sendMultiple($messages);
    }

}