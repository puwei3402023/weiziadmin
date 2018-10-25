<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/21
 * Time: 23:55
 */
namespace frontend\controllers;

use backend\models\ArticleModel;
use backend\models\ArticleTypeModel;
use backend\models\ServicesModel;
use backend\models\SolutionsContentModel;
use backend\models\SolutionsModel;
use frontend\models\IndexModel;
use Yii;
use yii\data\Pagination;


class IndexController extends BaseController
{

    public $keywords;
    //首页
    public function actionIndex()
    {
        //获取文章
        $article=IndexModel::get_article();
        //获取banner图片
        $banner_index=IndexModel::get_index_banner();
        return $this->render('index',[
            'article'=>$article,
            'banner_index'=>$banner_index,
        ]);
    }
    //文章详情
    public function actionArticle(){
        if (Yii::$app->request->isGet){
            $id=Yii::$app->request->get('id');
            if(empty($id)){
                //文章ID为空错误
                return true;
            }
            $article=ArticleModel::find() ->where(['status'=>1,'id'=>$id])->one();
            //获取这个文章作者的全部文章数
            $article_count=ArticleModel::find()->where(['status'=>1,'user_uid'=>$article['user_uid'],'admin_type'=>$article['admin_type']])->count();
            //获取这个用户的最新文章
            $article_title_all=ArticleModel::find()->select('title,id')->where(['status'=>1])
                ->orderBy('created_at desc')->limit(6)->all();
            $view = \Yii::$app->getView();
            $view->params['keywords']=$article['keyword'];
            $view->params['description']=$article['content_introduce'];
            //>>.查询类型
            $type_data=ArticleTypeModel::find()->where(['status'=>1])->all();
            return $this->render('article',[
                'article'=>$article,
                'article_count'=>$article_count,
                'article_title_alls'=>$article_title_all,
                'type_data'=>$type_data,
            ]);
        }
    }

    /**
     * 文章列表
     */
    public function actionArticleList()
    {
        if (Yii::$app->request->isGet) {
            $name=Yii::$app->request->get('name');
            $type=Yii::$app->request->get('type_id',1);
            $where=[];
            if(!empty($name)){
                $name=trim($name);
                $where=['like','title',$name];
            }elseif(!empty($type)){
                $where=['type_id'=>$type];
            }
            $count = ArticleModel::find()->where(['status' => 1])
                ->andWhere($where)
                ->count();
            $pages = new Pagination(['totalCount' => $count, 'pageSize' => '6']);
            $list = ArticleModel::find()
                ->where(['status' => 1])
                ->andWhere($where)
                ->limit($pages->limit)
                ->offset($pages->offset)
                ->all();

            //>>.查询类型
            $type_data=ArticleTypeModel::find()->where(['status'=>1])->all();
            return $this->render('article_list', ['list' => $list,
                'count' => $count,
                'pages' => $pages,
                'type_data' => $type_data,
                'type'=>$type,
            ]);
        }
    }
    //>>.关于我们
    public function actionAbout()
    {
        return $this->render('about');
    }

    //>>.产品服务
    public function actionProduct()
    {


        return $this->render('product');

    }
    //>>.产品中心

    //>>,联系我们
    public function actionContact()
    {


        return $this->render('contact');
    }
    //>>.解决方案列表
    public function actionSolutions()
    {
        $data=SolutionsModel::find()->where(['status'=>1])->all();
        return $this->render('solutions',['data'=>$data]);
    }

    //>>.解决方案列表 二级菜单
    public function actionSolutions2()
    {
        $id=Yii::$app->request->get('id');
        if(!empty($id)){
            //解决方案列表
            $data=SolutionsContentModel::find()->where(['status'=>1,'types'=>$id])->all();
            //解决方案类型
            $types=SolutionsModel::find()->where(['status'=>1,'id'=>$id])->one();
            return $this->render('solutions2',['data'=>$data,'types'=>$types]);
        }
    }
    //>>.解决方案 内容
    public function actionSolutions3()
    {
        $id=Yii::$app->request->get('id');
        if(!empty($id)){
            //解决方案内容
            $data=SolutionsContentModel::find()->where(['status'=>1,'id'=>$id])->one();
            //解决方案类型
            $types=SolutionsModel::find()->where(['status'=>1,'id'=>$data['types']])->one();
            //>>.相关解决方案
            $datas=SolutionsContentModel::find()->where(['status'=>1,'types'=>$data['types']])->orderBy('add_time desc')->limit(5)->all();
            return $this->render('solutions3',['data'=>$data,'types'=>$types,'datas'=>$datas]);
        }
    }
    //>>.产品及服务
    public function actionServices()
    {
        $data=ServicesModel::find()->where(['status'=>1])->asArray()->all();
        return $this->render('services',['data'=>$data]);
    }

    //>>.产品及服务内容
    public function actionServiceContent()
    {
        $id=Yii::$app->request->get('id');
        if(!empty($id)){
            $data=ServicesModel::find()->where(['status'=>1,'id'=>$id])->asArray()->one();
            $datas=ServicesModel::find()->where(['status'=>1])->orderBy('add_time desc')->asArray()->limit(5)->all();
            return $this->render('service-content',['data'=>$data,'datas'=>$datas]);
        }
    }
}