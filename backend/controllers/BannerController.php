<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/19
 * Time: 10:49
 */

namespace backend\controllers;


use backend\component\Message;
use backend\models\BannerModel;

class BannerController extends BaseController
{
    public $padam_lembut=false;
    public function getModel($id = '')
    {
        if($id == '') {
            $model = new BannerModel();
        }else{
            $model = BannerModel::find()->where($this->where_index)->andWhere(['id'=>$id])->one();
        }
        return $model;
    }

    /**
     * ajax查询列表
     */
    public function actionGet_data(){
        try{
            $pageIndex=\Yii::$app->request->get('pageIndex',0);
            $pageSize=\Yii::$app->request->get('pageSize',1);
            //查询权限菜单
            $count=BannerModel::find()->where($this->where_index)->count();
            $permissions=BannerModel::find()->select('*')->alias('a')
                ->where($this->where_index)
                ->limit($pageSize)
                ->offset(($pageIndex-1)*$pageSize)
                ->asArray()->all();
            foreach ($permissions as &$v){
                $v['created_at']=date('Y-m-d H:i',$v['created_at']);
                $v['updated_at']=date('Y-m-d H:i',$v['updated_at']);
                if($v['status']==1)
                    $v['status']= '正常';
                elseif($v['status']==0)
                    $v['status']='冻结';
                $v['type']=($v['type']==1)?'主页':'';
                $v['url']=\Yii::$app->params['before_url'].$v['url'];
            }
            //调用公共返回json
            echo Message::json_msg($permissions,$count);
        }catch (\Exception $e){
            echo Message::json_msg(false);
        }
    }



}