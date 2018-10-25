<?php
namespace backend\models;
use yii\base\Model;
use yii\web\UploadedFile;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/9
 * Time: 13:53
 */
class UploadForm extends Model
{

    /**
     * @var UploadedFile
     */
    public $fileList;

    public function rules()
    {
        return [
            [['fileList'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png,jpg,jpeg','message'=>'类型不正确'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'fileList' => '图片文件',
        ];
    }
    public function upload(&$file_url)
    {
        if ($this->validate()) {
            $imgname=uniqid();
            $ossfile = '../../frontend/web/uploads/'. date('Ymd');   //oss服务器文件存储路径
            if (!is_dir(ROOT_PATH . $ossfile)) {  //如果Uploads下的目录不存在就创建
                mkdir(ROOT_PATH . $ossfile, 0777, true);
            }
            $ossfile =$ossfile.'/'.$imgname;   //oss服务器文件存储路径
            $file_status=$this->fileList->saveAs($ossfile. '.' . $this->fileList->extension);
            if($file_status===false){
                return false;
            }
            $file_url='/uploads/'.date('Ymd').'/'.$imgname. '.' . $this->fileList->extension;
            return true;
        } else {
            return false;
        }
    }

}