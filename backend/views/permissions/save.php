<!DOCTYPE HTML>
<html>
<head>
    <title> 权限编辑</title>
    <?php
    use yii\helpers\Url;

    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="<?= Url::to('@web/index/assets/css/dpl-min.css') ?>" rel="stylesheet" type="text/css" media="screen"/>
    <link href="<?= Url::to('@web/index/assets/css/bui-min.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= Url::to('@web/index/assets/css/page-min.css') ?>" rel="stylesheet" type="text/css"/>
    <!-- 下面的样式，仅是为了显示代码，而不应该在项目中使用-->
    <link href="<?= Url::to('@web/index/assets/css/prettify.css') ?>" rel="stylesheet" type="text/css"/>


<body class="welcomebg">

<div class="container">
    <div class="toptitle">管理权限分配</div>
    <div class="form-all">

        <form action="<?=Url::to('save')?>" method="post">
            <p>
             <span>
              管理用户组：<input type="text" value="<?= $name['name']?>" id="groupname" name="groupname" required="required" placeholder="组名字"/>

            </span>
            <span>


          </span>
            </p>


    </div>
    <table cellspacing="0" class="table2 table-striped">
        <thead>

        <tr>

            <th class="span3">权限类型</th>
            <th class="span3">菜单</th>
            <th>权限筛选</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $i=0;
        $nameinfo=explode(';',$name['info']);
        $access=explode(';',$name['access']);
        foreach($menus as $key=>$menu):

            ?>
            <tr>

                <td>
                    <?=$key?></br>
                </td>
                <td>
                    <input type="checkbox" name="access[]" <?php if(in_array($key,$access))echo "checked=\"checked\"" ?>  value="<?= $key?>"> <?=$key?>
                </td>
                <td id='ck<?=$i?>'>
                    <?php foreach($menu as $k=>$v):?>
                        <label class="checkbox-inline">
                            <input type="checkbox" <?php if(in_array($k,$nameinfo))echo "checked=\"checked\"" ?>  name="name[]"  value="<?= $k?>"/> <?=$k?> </label>
                    <?php endforeach;?>
                    <label class="checkbox-inline">
                        <input type="checkbox" onclick='checkAll(this,"ck<?=$i?>")'></label>
                    全选
                </td>

            </tr>

            <?php
            $i++;
        endforeach;?>
        </tbody>
    </table>

	 <span class="pull-right">
         <input type="button" class="button button-primary" name="back" value="返回"
                onclick="javascript:history.back(-1);"/>
         <input type="submit" class="button button-primary" id="b_btn" value="添加">
         <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
         <input type="hidden" value="<?php echo $gid?>" name="gid" />

         </form>
</span>
</div>


<script type="text/javascript" src="<?= Url::to('@web/js/jquery-1.7.2.min.js') ?>"></script>
<script SRC="<?= Url::to('@web/js/layer/layer.js')?>"></script>
<script type="text/javascript" src="<?= Url::to('@web/index/assets/js/bui-min.js') ?>"></script>
<script type="text/javascript" src="<?= Url::to('@web/index/assets/js/config-min.js') ?>"></script>

<script type="text/javascript">
    BUI.use('common/page');
</script>


<script type="text/javascript">

    BUI.use('bui/overlay', function (overlay) {


    });

</script>


<!-- 仅仅为了显示代码使用，不要在项目中引入使用-->
<script type="text/javascript" src="<?= Url::to('@web/index/assets/js/prettify.js') ?>"></script>
<script type="text/javascript" src="<?= Url::to('@web/js/common.js') ?>"></script>
<script type="text/javascript">
    $(function () {
        prettyPrint();

        $('#b_btn').click(function(){
            var groupname=$('#groupname').val();
            if(groupname==''){
                htmlshowLayer('组名字不能为空')
                return false;
            }
            var from=$("form").serializeArray();
            $.post("<?=Url::to('save')?>",from,function(data){
                var data=eval('('+data+')');
                if(data.status==1){
                    showLayer(data)
                }else {
                    showLayer(data)
                }
                return false;
            })
            return false;
        })
    });
</script>

</body>
</html>