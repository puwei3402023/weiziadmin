<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/9
 * Time: 20:22
 */

namespace backend\controllers;


use backend\component\Message;
use backend\models\ArticleTypeModel;

class ArticleTypeController extends BaseController
{
    public $padam_lembut=false;


    /**
     * ajax查询文件列表
     */
    public function actionGet_data(){
        try{
            $pageIndex=\Yii::$app->request->get('pageIndex',0);
            $pageSize=\Yii::$app->request->get('pageSize',1);
            $title=\Yii::$app->request->get('name');
            $where_title=[];
            if(!empty($title))
                $where_title=['like', 'name',trim($title)];

            $count=ArticleTypeModel::find()->where($this->where_index)
                ->andWhere($where_title)

                ->count();
            $permissions=ArticleTypeModel::find()->select('name,id,add_time,save_time,status')
                ->where($this->where_index)
                ->andWhere($where_title)
                ->orderBy('add_time desc')
                ->limit($pageSize)
                ->offset(($pageIndex-1)*$pageSize)
                ->asArray()->all();
            foreach ($permissions as &$v){
                $v['add_time']=$v['add_time']?date('Y-m-d H:i',$v['add_time']):'';
                $v['save_time']=$v['save_time']?date('Y-m-d H:i',$v['save_time']):'';
                if($v['status']==1)
                    $v['status']= '正常';
                elseif($v['status']==0)
                    $v['status']='冻结';
                else
                    $v['status']='未知错误';
            }
            //调用公共返回json
            echo Message::json_msg($permissions,$count);
        }catch (\Exception $e){
            echo Message::json_msg(false);
        }
    }


    public function getModel($id='')
    {
        if($id == '') {
            $model = new ArticleTypeModel();
        }else{
            $model = ArticleTypeModel::find()->where($this->where_index)->andWhere(['id'=>$id])->one();;
        }
        return $model;
    }
}