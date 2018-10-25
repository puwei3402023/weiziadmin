<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/14
 * Time: 20:53
 */

namespace backend\controllers;


use yii\web\Controller;

class TestController extends Controller
{
    public function actionTest()
    {
        set_time_limit(0);
        $j=10;
        $arr=[];
        for($i=0;$i<=$j;++$i){
            $arr[]=$this->arr();
        }
        var_dump(count($arr));
        echo memory_get_usage(true)/1024/1024; //获取当前占用内存
        echo "<br>";
        unset($arr);
        echo memory_get_usage(true)/1024/1024; //unset()后再查看当前占用内存
    }

    public function arr()
    {
        $pdo = new \PDO("mysql:host=localhost;dbname=tcjdxm", 'root', 'root');
        $pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        $arr=[];
        $uresult = $pdo->query("SELECT title FROM pw_article");
        if ($uresult) {
            $arr[] = $uresult->fetchAll(\PDO::FETCH_ASSOC);
        }
        unset($pdo);
        unset($uresult);
        return $arr;
    }
}