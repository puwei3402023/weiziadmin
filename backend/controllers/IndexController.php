<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/10
 * Time: 16:16
 */

namespace backend\controllers;




use backend\models\ConfigModel;
use common\component\session;


class IndexController extends BaseController
{
    public function getModel($id = '')
    {
        // TODO: Implement getModule() method.
    }

    public function actionGet_data()
    {
        // TODO: Implement actionGet_data() method.
    }

    //后台首页
    public function actionIndex(){
     /*   $binder=new MyAppViewBinder;
        $javascript=new PHPToJavaScriptTransformer($binder, 'window');
        $javascript->put(['foo' => ['a'=>1]]);*/

        $this->layout='index';
        $config=ConfigModel::find()->where(['types'=>2,'status'=>1])->orderBy('id desc')->one();
        if(empty($config)){
            $config['content']='';
        }
        $this->getView()->title = $config['content']."后台管理";
        return $this->render('index',['config'=>$config]);
    }
    //后台首页中心
    public function actionMain(){
        $this->layout=false;
        return $this->render('main');
    }

    /**
     * [{
    "title": "基本元素",
    "icon": "fa-cubes",
    "spread": true,
    "children": [{
    "title": "权限",
    "icon": "&#xe641;",
    "href": "permissions"
    }, {
    "title": "表单",
    "icon": "&#xe63c;",
    "href": "form.html"
    }, ]
    }

    ];
     * 获取菜单数据
     * /js/index.js 这个地方加载的菜单有缓存
     *   //设置navbar
    navbar.set({
    spreadOne: true,
    elem: '#admin-navbar-side',
    cached: true,//是否缓存
    // data: navs
    // cached:true,
    url: '/index/get_menu?id='+Math.random(),
    });
     */
    public function actionGet_menu(){
        if(\Yii::$app->request->isAjax){
            //获取自己的权限
            $permissionsURL=session::get('PERMISSIONSMENU');
            echo  \yii\helpers\Json::encode($permissionsURL);

        }
    }
}