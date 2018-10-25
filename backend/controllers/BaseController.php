<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 10:33
 */

namespace backend\controllers;


use backend\component\Message;
use common\component\session;
use yii\helpers\Url;
use yii\web\Controller;

abstract  class BaseController extends Controller
{

    //软删除,默认是软删除
    public $padam_lembut=true;
    public $back_url; //返回主页url
    //主页数据条件
    public $where_index=['not in','status',[-1]];
    /**
     * 必须定义这个方法
     * @return Module
     */
    abstract public function getModel($id='');

    /**
     * 必须定义,ajax查询文件列表
     * @return mixed
     */
    abstract public function actionGet_data();
    //方法执行前的判断
    public function beforeaction($action){


        parent::beforeAction($action);
        //控制器方法名字
        $actions=$this->action->id;
        //控制器名字
        $controller=\Yii::$app->controller->id;
        //访问的URL
        $visitUrl=$controller.'/'.$actions;
        //返回的URL
        $this->back_url=Url::toRoute($controller.'/index');
//        return true;
        if (!\Yii::$app->user->isGuest) {
            //判断权限
            $permissionsURL=session::get('PERMISSIONSURL');
            if(empty($permissionsURL)){
                \Yii::$app->user->logout();
                //重定向到登录
                $url=Url::toRoute('site/login');
                echo '<script>top.location.href="'.$url.'"</script>';
                return false;
            }
            if(!empty($permissionsURL)&&in_array($visitUrl,$permissionsURL)){
                return true;
            }else{

               if(\Yii::$app->request->isAjax){
                   if($actions=='get_data'){
                       echo Message::json_msg([],0);
                   }else
                        echo 'false';
                }else{
                   $url=Url::toRoute(['msg/error2','content'=>'权限不足请联系管理员','data'=>'']);
                   $this->redirect($url);
                }

                return false;
            }
        }else{

            //重定向到登录
            $url=Url::toRoute('site/login');
            echo '<script>top.location.href="'.$url.'"</script>';
            return false;
        }

        return true;
    }
    public function actionIndex(){
        $this->_before_index_view();
        return $this->render('index');
    }
    /**
     * 准备是被子类覆盖,为列表页面展示之前准备数据
     */
    protected function _before_index_view(){

    }
    //获取添加html,或者修改
    public function actionEdit_form(){
        $id=\Yii::$app->request->get('id');
        $pms_data='';
        if(!empty($id)){
            //编辑的时候
            $pms_data=$this->getModel($id);
        }
        $this->_before_edit_view();
        //获取菜单
        return $this->render('edit_form',['pms_data'=>$pms_data]);
    }
    /**
     * 主要是被子类覆盖..  在编辑页面展示之前向编辑页面上分配数据
     */
    protected function _before_edit_view(){
    }

    //添加功能
    public function actionAdd(){
        $model=$this->getModel();
        $model->scenario='add';
        if($model->load(\Yii::$app->request->post(),'')&&$model->save()){

            echo Message::json_msg(true,1,'添加成功',[],$this->back_url);
        }else{
            $msg=Message::get_model_error($model);
            echo Message::json_msg(false,1,'保存失败'.$msg);
        }
    }
    //修改
    public function actionSave(){
        $id=\Yii::$app->request->post('id');
        $model=$this->getModel($id);//PermissionsModel::findOne($id);
        if ($model === null) {
            echo Message::json_msg(false,1,'页面错误');
            return;
        }
        $model->scenario='save';
        if($model->load(\Yii::$app->request->post(),'')&&$model->save()){
            echo Message::json_msg(true,1,'修改成功',[],$this->back_url);
        }else{
            $msg=Message::get_model_error($model);
            echo Message::json_msg(false,1,'保存失败'.$msg);
        }
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