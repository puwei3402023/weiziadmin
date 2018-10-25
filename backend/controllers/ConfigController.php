<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/4
 * Time: 10:10
 */

namespace backend\controllers;


use backend\component\Message;
use backend\models\ConfigModel;

class ConfigController extends BaseController
{
    public $padam_lembut=false;

    public function getModel($id = '')
    {
        if($id == '') {
            $model = new ConfigModel();
        }else{
            $model = ConfigModel::find()->andWhere(['id'=>$id])->one();
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
            $count=ConfigModel::find()->where($this->where_index)->count();
            $permissions=ConfigModel::find()->select('*')->alias('a')
                ->where($this->where_index)
                ->limit($pageSize)
                ->offset(($pageIndex-1)*$pageSize)
                ->asArray()->all();
            $type_name=\Yii::$app->params['TYPE_NAME'];
            foreach ($permissions as &$v){
                $v['add_time']=date('Y-m-d H:i',$v['add_time']);
                $v['save_time']=$v['save_time']?date('Y-m-d H:i',$v['save_time']):'';
                if($v['status']==1)
                    $v['status']= '正常';
                elseif($v['status']==0)
                    $v['status']='冻结';
                $v['types']=$type_name[$v['types']];
            }
            //调用公共返回json
            echo Message::json_msg($permissions,$count);
        }catch (\Exception $e){
            echo Message::json_msg(false);
        }
    }
    //编辑的时候获取数据
    public function _before_edit_view()
    {
        $view = \Yii::$app->getView();//此处的view实例与视图中的view（默认的$this变量）为同一个。所以此处保存的参数在视图中也可以用
        //获取分类
        $type_name=\Yii::$app->params['TYPE_NAME'];
        $view->params['types'] = $type_name; //因为是同一个布局变量，所以在视图中也可以使用
    }

}