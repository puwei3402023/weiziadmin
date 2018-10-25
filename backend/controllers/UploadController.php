<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/19
 * Time: 16:34
 */

namespace backend\controllers;


use backend\models\UploadForm;
use yii\web\UploadedFile;

class UploadController extends BaseController
{
    public $enableCsrfValidation = false ;
    public function getModel($id = '')
    {
        // TODO: Implement getModule() method.
    }
    public function actionGet_data()
    {
        // TODO: Implement actionGet_data() method.
    }

    public function actionIndex(){
        $model = new UploadForm();
//        var_dump($_FILES);
        if (\Yii::$app->request->isPost) {
            $model->fileList = UploadedFile::getInstance($model, 'fileList');
            $file_url='';
            $json_data=['status'=>0,'url'=>'','msg'=>'上传失败'];
            if ($model->upload($file_url)) {
                $json_data['url']=$file_url;
                $json_data['status']=1;
                $json_data['msg']='上传成功';
                // 文件上传成功
            }else{

            }
            echo \yii\helpers\Json::encode($json_data);
        }
    }

}