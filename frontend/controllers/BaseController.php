<?php
namespace frontend\controllers;

use backend\models\ArticleTypeModel;
use backend\models\ConfigModel;
use backend\models\ServicesModel;
use backend\models\SolutionsModel;
use frontend\component\session;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;
class BaseController extends Controller
{
    //用户名
    public $Example_username;
    //用户id
    public $Example_uid;
    //方法执行前
    public function beforeaction($action){
        $view = \Yii::$app->getView();
        //获取配置
        $boot_name=ConfigModel::find()->where(['status'=>1,'types'=>1])->orderBy('id desc')->one();
        $company_name=ConfigModel::find()->where(['status'=>1,'types'=>2])->orderBy('id desc')->one();
        $view->params['boot_name']=$boot_name['content'];
        $view->params['company_name']=$company_name['content'];
        $view->title=$company_name['content'];
        //>>.获取解决方案菜单
        $view->params['solutions']=SolutionsModel::find()->where(['status'=>1])->all();
        //>>.新闻菜单
        $view->params['article_type']=ArticleTypeModel::find()->where(['status'=>1])->all();
        //>>.产品及服务菜单
        $view->params['services']=ServicesModel::find()->where(['status'=>1])->asArray()->all();
        //>>.关键字查询
        $keyword=ConfigModel::find()->where(['status'=>1,'types'=>3])->orderBy('id desc')->one();
        $view->params['keywords']=$keyword['content'];
        //>>,介绍查询
        $description=ConfigModel::find()->where(['status'=>1,'types'=>4])->orderBy('id desc')->one();
        $view->params['description']=$description['content'];
        return true;
    }

}