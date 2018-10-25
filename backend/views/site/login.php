<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>登录</title>
    <link rel="stylesheet" href="/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/css/login.css" />
</head>

<body class="beg-login-bg">
<div class="beg-login-box">
    <header>
        <h1>后台登录</h1>
    </header>
    <div class="beg-login-main">
        <form action="/site/login" class="layui-form" method="post">
            <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
            <div class="layui-form-item">
                <label class="beg-login-icon">
                    <i class="layui-icon">&#xe612;</i>
                </label>
                <input type="text" name="username" lay-verify="required" autocomplete="off" placeholder="这里输入登录名" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="beg-login-icon">
                    <i class="layui-icon">&#xe642;</i>
                </label>
                <input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="这里输入密码" class="layui-input">
            </div>
            <div class="layui-form-item">

                <div class="beg-pull-right">
                    <button class="layui-btn layui-btn-primary" lay-submit lay-filter="login">
                        <i class="layui-icon">&#xe650;</i> 登录
                    </button>
                </div>
                <div class="beg-clear"></div>
            </div>
        </form>
    </div>
    <footer>
        <p></p>
    </footer>
</div>
<script type="text/javascript" src="/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/common/js/common.js"></script>
<script>
    layui.use(['layer', 'form'], function() {
        var layer = layui.layer,
            $ = layui.jquery,
            form = layui.form();

        form.on('submit(login)',function(data){

            //这里可以写ajax方法提交表单
            $.post('<?=\yii\helpers\Url::toRoute('login')?>?i='+Math.random(),data.field,function (data) {
                var data=eval('('+data+')');
                if(data.rel){
                    showLayer(data,1)
                }else {
                    htmlshowLayer(data.msg)
                }
            })
            return false;
        });
    });
</script>
</body>

</html>