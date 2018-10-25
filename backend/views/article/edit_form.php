<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="c2hmVFctR3Q/UCMfHGE/EyUbPxpnVQE3FAMVEBYdFAUSAVIGPkw/QQ==">
    <title></title>
    <link href="/plugins/layui/css/layui.css" rel="stylesheet">
    <link href="/css/global.css" rel="stylesheet">
    <link href="/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/table.css" rel="stylesheet"></head>
    <link href="/css/zyUpload.css" rel="stylesheet"></head>
<body>
<div style="margin: 15px;">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">标题:</label>
            <div class="layui-input-block">
                <input type="text" name="title" value="<?php if(!empty($pms_data['title'])) echo $pms_data['title']?>" lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">文章类型:</label>
            <div class="layui-input-block">
                <select name="type_id" lay-filter="aihao"  lay-verify="required" >
                    <option value=""></option>
                    <?php
                    if(!empty($this->params['types'])):
                        foreach ($this->params['types'] as $k=>$v):
                            ?>
                            <option value="<?=$v['id']?>" <?php if(!empty($pms_data['type_id'])&&$pms_data['type_id']==$v['id']) echo 'selected=""'?>><?=$v['name']?></option>
                        <?php endforeach;endif;?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">关键字:</label>
            <div class="layui-input-block">
                <input type="text" name="keyword" placeholder="请输入关键字(关键字以逗号分割,英文的)"  lay-verify="required" value="<?php if(!empty($pms_data['keyword'])) echo $pms_data['keyword']?>"  placeholder="请输入关键字" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">标题图片:</label>
            <div class="layui-input-block">
                <div class="demo" id="demo"></div>
                <span>图片格式支持png,jpg</span>
            </div>
        </div>
        <?php if(isset($pms_data['title_img'])&&$pms_data['title_img']!=''):?>
        <div class="layui-form-item">
            <label class="layui-form-label">标题图片回显:</label>
            <div class="layui-input-block">
                <img width="100px" src="<?=Yii::$app->params['before_url']?><?=$pms_data['title_img']?>">
            </div>
        </div>
        <?php endif;?>
        <!--        放图片地址-->
        <div id="urlimg"></div>
        <div class="layui-form-item">
            <label class="layui-form-label">内容简介:</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容简介" name="content_introduce" class="layui-textarea"><?php if(!empty($pms_data['content_introduce'])) echo $pms_data['content_introduce']?></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">内容:</label>
            <div class="layui-input-inline">
                <textarea name="content" id="editor"><?php if(!empty($pms_data['content'])) echo $pms_data['content']?></textarea>
            </div>
            <div class="layui-form-mid layui-word-aux">请输入内容简介</div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">状态:</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="显示" <?php if(!empty($pms_data['status'])&&$pms_data['status']==1) echo 'checked=""';elseif(empty($pms_data['status'])) echo'checked=""'?>>
                <input type="radio" name="status" value="2" title="待发布" <?php if(!empty($pms_data['status'])&&$pms_data['status']==2) echo 'checked=""';?> >
            </div>
        </div>
        <?php if(!empty($pms_data)):?>
            <input type="hidden" value="<?php echo $pms_data['id']?>" name="id" />
        <?php endif;?>
        <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                <button type="reset" class="layui-btn layui-btn-primary"  id="return">返回</button>
            </div>
        </div>
</form>
</div>
<script type="text/javascript" src="/plugins/layui/layui.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="/zTree_v3/js/jquery-1.4.4.min.js"></script>
<!-- 引用核心层插件 -->
<script type="text/javascript" src="<?= \yii\helpers\Url::to('@web/zyFile/core/zyFile.js') ?>"></script>
<!-- 引用控制层插件 -->
<script type="text/javascript" src="<?= \yii\helpers\Url::to('@web/zyFile/control/js/zyUpload.js') ?>"></script>
<script>
       $(function () {
           $("#demo").zyUpload({
               width: "100%",                 // 宽度
               itemWidth: "80px",                 // 文件项的宽度
               itemHeight: "80px",                 // 文件项的高度
               url: '<?= \yii\helpers\Url::toRoute(['upload/index'])?>',  // 上传文件的路径
               multiple: true,                    // 是否可以多个文件上传
               dragDrop: false,                    // 是否可以拖动上传文件
               del: true,                    // 是否可以删除文件
               finishDel: false,  				  // 是否在上传文件完成后删除预览
               filename:'UploadForm[fileList]', //表单名字
               /* 外部获得的回调接口 */
               onSelect: function (files, allFiles) {                    // 选择文件的回调方法
                    $(files).each(function () {
//                        console.log(this.type)
//                        if(this.type=='image/png'||this.type=='image/jpg'||this.type=='image/jpeg'){
//                            htmlshowLayer('有一张照片不支持这个格式');
//                        }else {
//                            htmlshowLayer('有一张照片不支持这个格式?');
//                        }
                    })
//                    console.info("之前没上传的文件：");
//                    console.info(allFiles);
               },
               onDelete: function (file, surplusFiles) {                     // 删除一个文件的回调方法
//                    console.info("当前删除了此文件：1");
//                    console.info(file);
//                    console.info("当前剩余的文件：");
//                    console.info(surplusFiles);
               },
               onSuccess: function (file, response) {                    // 文件上传成功的回调方法

                   var data = eval('(' + response + ')');
                   if(data.status==1){
                       var html = "<input type='hidden' name='title_img' value='" + data.url + "'/>";
                       $('#urlimg').append(html);
                   }else {
                       htmlshowLayer('图片上传失败请联系网站管理人员')
                   }
//                    console.info(file);

               },
               onFailure: function (file) {                    // 文件上传失败的回调方法
//                    console.info("此文件上传失败：");
//                    console.info(file);
               },
               onComplete: function (responseInfo) {           // 上传完成的回调方法
//                    console.info("文件上传完成");
//                    console.info(responseInfo);

               },

           });
       })


    layui.use(['form', 'laydate'], function(){
        var form = layui.form()
            ,layer = layui.layer
            ,laydate = layui.laydate;
        var $ = layui.jquery;
        //创建一个编辑器
        var editor =  UE.getEditor('editor',{    //第一个参数是需要在线编辑器的表单元素的id   第二个参数是关于在线编辑器的配置
            initialFrameHeight :200,
            initialFrameWidth: 1000,
        });
        //自定义验证规则
        form.verify({
            title: function(value){
                if(value.length < 5){
                    return '标题至少得5个字符啊';
                }
            }
        });


        //监听提交
        form.on('submit(demo1)', function(data){
            /*layer.alert(JSON.stringify(data.field), {
             title: '最终的提交信息'
             })*/
            var id='<?php if(!empty($pms_data['id'])) echo $pms_data['id']?>';
            if(isNull(id)){
                var url='<?= \yii\helpers\Url::toRoute('save')?>';
            }else {
                var url='<?= \yii\helpers\Url::toRoute('add')?>';
            }
            //这里可以写ajax方法提交表单
            $.post(url,data.field,function (data) {
                if(data=='false'){
                    htmlshowLayer('权限不足请联系管理员')
                    return false;
                }
                var data=eval('('+data+')');
                if(data.rel){
                    showLayer(data,1)
                }else {
                    htmlshowLayer(data.msg)
                }
            })
            return false;
        });
        //返回
        $('#return').click(function(){
            location.href = '<?= \yii\helpers\Url::toRoute('index')?>';
        });


    });
</script>
</body>
</html>

