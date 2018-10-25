<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/4
 * Time: 10:30
 */

namespace backend\controllers;

use backend\component\Message;
use backend\models\PermissionsModel;
use Faker\Provider\Base;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * 权限列表
 * Class PermissionsController
 * @package backend\controllers
 */
class PermissionsController extends BaseController
{
    public $padam_lembut=false;

    public function getModel($id = '')
    {
        if($id == '') {
            $model = new PermissionsModel();
        }else{
            $model = PermissionsModel::find()->where($this->where_index)->andWhere(['id'=>$id])->one();;
        }
        return $model;
    }
    /**
     * ajax查询权限列表
     */
    public function actionGet_data(){
        try{
            $pageIndex=\Yii::$app->request->get('pageIndex',0);
            $pageSize=\Yii::$app->request->get('pageSize',1);
            //查询权限菜单
            $count=PermissionsModel::find()->where($this->where_index)->count();
            $permissions=PermissionsModel::find()->select('name,id,access')
                ->where($this->where_index)
                ->limit($pageSize)
                ->offset(($pageIndex-1)*$pageSize)
                ->asArray()->all();
            //调用公共返回json
            echo Message::json_msg($permissions,$count);
        }catch (\Exception $e){
            echo Message::json_msg(false);
        }
    }
    //获取添加html,或者修改
    public function actionEdit_form(){
        $id=\Yii::$app->request->get('id');
        $pms_data='';
        if(!empty($id)){
            //编辑的时候
            $pms_data=$this->getModel($id);
        }
        //获取菜单
        $menus_url = \Yii::$app->params['MENUS_URL'];
        //获取菜单
        return $this->render('edit_form',['menus_url'=>$menus_url,'pms_data'=>$pms_data]);
    }

//删除
    public function actionDel(){
        $id=\Yii::$app->request->get('id');
        $model=$this->getModel($id);
        if ($model === null) {
            echo Message::json_msg(false,1,'页面错误');
            return;
        }
        if($this->padam_lembut){
            //如果是超级管理不能删除
            if($model->id==1){
                echo Message::json_msg(false,1,'删除失败<br>不能删除超级管理权限');
                return false;
            }
            $model->status=0;
            $status=$model->save();
        }else{
            $status=$model->delete();
        }
        if($status){
            echo Message::json_msg(true,1,'删除成功');
        }else{
            $msg=Message::get_model_error($model);
            echo Message::json_msg(false,1,'删除失败'.$msg);
        }
    }

}