<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 10:32
 */

namespace backend\controllers;



use backend\component\Message;
use backend\models\PermissionsModel;
use backend\models\UserModel;
use Yii;
use yii\helpers\Url;

class UserController extends BaseController
{
    public $padam_lembut=false;
    public function getModel($id = '')
    {
        if($id == '') {
            $model = new UserModel();
        }else{
            $model = UserModel::find()->where($this->where_index)->andWhere(['id'=>$id])->one();
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
            $count=UserModel::find()->where($this->where_index)->count();
            $permissions=UserModel::find()->select('a.id,a.created_at,a.updated_at,a.email,a.username,p.name,a.status')->alias('a')
                ->leftJoin('{{%permissions}} as p','p.id=a.role')
                ->where(['not in','a.status',[0]])
                ->limit($pageSize)
                ->offset(($pageIndex-1)*$pageSize)
                ->asArray()->all();
            foreach ($permissions as &$v){
                $v['created_at']=date('Y-m-d H:i',$v['created_at']);
                $v['updated_at']=date('Y-m-d H:i',$v['updated_at']);
                $v['status']=($v['status']==10)?'正常':'冻结';
            }
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

        //获取权限
        $pms=PermissionsModel::find()->asArray()->all();
        return $this->render('edit_form',['pms_data'=>$pms_data,'pms'=>$pms]);
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
                echo Message::json_msg(false,1,'删除失败<br>不能删除超级管理员');
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

    /**
     * 修改密码
     */
    public function actionReset_password(){
        if(Yii::$app->request->isAjax){
            $userinfo=\Yii::$app->user->getIdentity();
            $id=$userinfo->getId();
            $model=$this->getModel($id);
            $model->scenario='reset';
            if ($model->load(Yii::$app->request->post(),'')&&$model->save()) {
                // 验证 $model 收到的数据
                $url=Url::toRoute('user/index');
                echo Message::json_msg(true,0,'修改密码成功');
            } else {
                //验证失败
                $info=Message::get_model_error($model);
                echo  Message::json_msg(false,0,$info);

            }
        }

    }

}
