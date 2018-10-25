<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/27
 * Time: 16:42
 */

namespace frontend\models;


use backend\models\ArticleModel;
use yii\base\Model;

class IndexModel extends Model
{

    public $db;
    public function init()
    {
        $this->db=(new \yii\db\Query());
    }


    /**
     * 获取全部的文章
     * @return array
     */
    public static function get_article($offset=0,$limit=4){
        $db=(new \yii\db\Query());
        $article_date=$db->select('user_uid,admin_type,id,content_introduce,title,author,title_img,created_at,click_number,collect_unmber')
            ->from('{{%article}}')
            ->where(['status'=>1,'index_status'=>1])
            ->orderBy('created_at desc')->limit($limit)->offset($offset)->all();

//        var_dump($article_date);
        return $article_date;
    }




    /**
     * 获取首页的banner
     */
    public static function get_index_banner(){
        return (new \yii\db\Query())
            ->select('id,url,jump_url,name')
            ->from('{{%banner}}')
            ->where(['type'=>1,'status'=>1])
            ->orderBy('created_at desc')->limit(5)->all();
    }
}