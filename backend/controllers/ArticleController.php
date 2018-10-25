<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10
 * Time: 21:28
 */

namespace backend\controllers;


use backend\component\Message;
use backend\models\ArticleModel;
use backend\models\ArticleTypeModel;
use backend\models\SubjectModel;
use yii\helpers\Url;

class ArticleController extends BaseController
{
    public $padam_lembut=false;
    public $where_indexs=['not in','a.status',[-1]];

    public function getModel($id='')
    {
        if($id == '') {
            $model = new ArticleModel();
        }else{
            $model = ArticleModel::find()->where($this->where_index)->andWhere(['id'=>$id])->one();;
        }
        return $model;
    }

    /**
     * ajax查询文件列表
     */
    public function actionGet_data(){
        try{
            $pageIndex=\Yii::$app->request->get('pageIndex',0);
            $pageSize=\Yii::$app->request->get('pageSize',1);
            $title=\Yii::$app->request->get('title');
            $where_title=[];
            if(!empty($title))
                $where_title=['like', 'title',trim($title)];

            $count=ArticleModel::find()->alias('a')
                ->leftJoin('{{%article_type}} as t','t.id=a.type_id')
                ->where($this->where_indexs)
                ->andWhere($where_title)

                ->count();
            $permissions=ArticleModel::find()->select('a.title,a.id,a.author,
            a.created_at,a.updated_at,a.status,a.index_status,a.headline,t.name as type_name')
                ->alias('a')
                ->leftJoin('{{%article_type}} as t','t.id=a.type_id')
                ->where($this->where_indexs)
                ->andWhere($where_title)
                ->orderBy('a.index_status desc,a.created_at desc')
                ->limit($pageSize)
                ->offset(($pageIndex-1)*$pageSize)
                ->asArray()->all();
            foreach ($permissions as &$v){
                $v['created_at']=$v['created_at']?date('Y-m-d H:i',$v['created_at']):'';
                $v['updated_at']=$v['updated_at']?date('Y-m-d H:i',$v['updated_at']):'';
                if($v['status']==1)
                    $v['status']= '显示';
                elseif($v['status']==2)
                    $v['status']='待发布';
                elseif($v['status']==3)
                    $v['status']='待审核';
                else
                    $v['status']='不显示';
                $v['index_status']=($v['index_status']>=1)?'首页':'否';
            }
            //调用公共返回json
            echo Message::json_msg($permissions,$count);
        }catch (\Exception $e){
            echo Message::json_msg(false);
        }
    }
    /**
     * 添加或者修改的时候的数据
     */
    protected function _before_edit_view(){
        $view = \Yii::$app->getView();//此处的view实例与视图中的view（默认的$this变量）为同一个。所以此处保存的参数在视图中也可以用
        //获取分类
        $type_name=ArticleTypeModel::find()->select('id,name')->where(['status'=>1])->asArray()->all();
        $view->params['types'] = $type_name; //因为是同一个布局变量，所以在视图中也可以使用
    }
    /**
     * 文章置顶首页
     */
    public function actionStick_status(){
        $model=$this->getModel();
        $model->scenario='stick_status';
        if($model->load(\Yii::$app->request->post(),'')&&$model->validate()&&$model->save_field_status('index_status',1)){

            echo Message::json_msg(true,1,'置顶成功');
        }else{
            $msg=Message::get_model_error($model);
            echo Message::json_msg(false,1,'置顶失败'.$msg);
        }
    }
    /**
     * 取消文章首页
     */
    public function actionCancel_stick_status(){
        $model=$this->getModel();
        $model->scenario='stick_status';
        if($model->load(\Yii::$app->request->post(),'')&&$model->validate()&&$model->save_field_status('index_status',0)){

            echo Message::json_msg(true,1,'取消置顶成功');
        }else{
            $msg=Message::get_model_error($model);
            echo Message::json_msg(false,1,'取消置顶失败'.$msg);
        }
    }


}