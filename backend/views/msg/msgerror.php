<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    use yii\helpers\Url;
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>宝点网 - 数据管理后台</title>

    <link rel="stylesheet" type="text/css" href="<?= Url::to('@web/css/dpl-min.css')?>" />

    <script src="<?= Url::to('@web/js/jquery-1.7.2.min.js')?>" type="text/javascript"></script>

</head>

<body class="login_body">

<div class="container">

    <div class="logout">

        <div class="logoutimg"><img src="<?= Url::to('@web/images/error.png')?>" width="130px" height="130px"/></div>

        <div class="logouttext">
            <div class="logouttext1 span100">
                <?= $errorMessage?></div>
            <div class="logouttext2">
            <div class="logouttext3">
<!--                <a href="--><?//= $gotoUrl?><!--">系统如果未自动跳转，请手动跳转</a></div>-->


        </div>


    </div>


</div>




<script>
    $(function(){
        function msg(){
            setTimeout(function(){
            window.location.href='<?= Url::toRoute($url)?>'
            }, <?= $sec?>000);
        }
        msg()
    })
</script>

</body>
</html>