<?php
namespace backend\controllers;

use backend\component\Message;
use backend\models\PermissionsModel;
use common\component\session;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $padam_lembut=false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $msg='';
        if(Yii::$app->request->isPost){
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post(),'') && $model->login()&&$this->add_pms($msg)) {
                $url=Url::toRoute('index/index');
                return Message::json_msg(true,1,'登录成功',['url'=>$url],$url);
            } else {
                Yii::$app->user->logout();
               $msg.=Message::get_model_error($model);
               echo Message::json_msg(false,1,'登录失败'.$msg);
            }
        }else{
            $this->layout=false;
            return $this->render('login');
        }

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    //动作执行后台 加入你的权限
    public function add_pms(&$msg)
    {
        $user = Yii::$app->user->identity;
        $groutp = PermissionsModel::find()->where(['status'=>1,'id'=>$user->role])->asArray()->one();
        if(empty($groutp)){
            $msg='<br>没有配置权限请联系管理员,或者权限已经被禁用';
            return false;
        }
        $url = explode(';', $groutp['info']);
            $access = explode(';', $groutp['access']);
            $menus_url = \Yii::$app->params['MENUS_URL'];
            //存放自己可以访问地方URL
            $permissionsURL = [];
            //保存菜单
            $menu=[];
            $i=0;
            foreach ($menus_url as $k=>$v) {
                //这里是请求权限保存
                foreach ($v as $key => $vurl) {
                    if (in_array($key, $url)&&is_array($vurl)) {
                        $permissionsURL[] = $vurl['url'];
                    }
                }
                //这里是菜单保存
                if(in_array($k,$access)&&$k!='通用权限'){
                    $menu[$i]['title']=$k;
                    if(isset($v['icon'])){
                        $menu[$i]['icon']=$v['icon'];
                    }
                    if(isset($v['spread'])){
                        $menu[$i]['spread']=$v['spread'];
                    }
                    foreach ($v as $key => $vurl) {
                        if (in_array($key, $url)&&is_array($vurl)) {
                            if($vurl['status']==1){
                                $menu[$i]['children'][]=['href'=>Url::toRoute($vurl['url']),'icon'=>$vurl['icon'],'title'=>$key];
                            }
                        }

                    }
                    ++$i;
                }
            }
            //可以访问的地址放在session
            session::set('PERMISSIONSURL', $permissionsURL);
            //可显示的菜单放session
            session::set('PERMISSIONSMENU', $menu);

        return true;
    }
}
