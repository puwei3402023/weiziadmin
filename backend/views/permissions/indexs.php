<!DOCTYPE HTML>
<html>
<head>
    <?php
    use yii\helpers\Url;

    ?>
    <title>宝点数据管理框架</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="<?= Url::to('@web/index/assets/css/dpl-min.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= Url::to('@web/index/assets/css/bui-min.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= Url::to('@web/index/assets/css/main-min.css') ?>" rel="stylesheet" type="text/css"/>
</head>
<body>

<div class="header">

    <div class="dl-title">

    </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"></span><a href="<?= Url::toRoute('user/exitlogin') ?>"
                                                                title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">

        <ul id="J_Nav" class="nav-list ks-clear">
            <li class="nav-item dl-selected">
                <div class="nav-item-inner nav-home">首页</div>
            </li>
            <!--        <li class="nav-item"><div class="nav-item-inner nav-order">财务相关</div></li>-->
            <!--        <li class="nav-item"><div class="nav-item-inner nav-inventory">运营推广</div></li>-->
            <!--        <li class="nav-item"><div class="nav-item-inner nav-supplier">客服CRM</div></li>-->
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
</div>
<script type="text/javascript" src="<?= Url::to('@web/js/jquery-1.7.2.min.js') ?>"></script>
<script type="text/javascript" src="<?= Url::to('@web/index/assets/js/bui.js') ?>"></script>
<script type="text/javascript" src="<?= Url::to('@web/index/assets/js/config.js') ?>"></script>

<script>
    BUI.use('common/main', function () {
        var config = [{
            id:'menu',
            homePage : 'welcome',
            menu:[
                <?php foreach($menus as $key=>$menu):?>
                {
              text:'<?= $key?>',
              items:[
                  <?php foreach($menu as $k=>$v):
                    if($v['status']==1):
                    if(in_array($k,$arr)):
                  ?>
                {id:'<?=$v['url']?>',text:'<?= $k?>',href:'<?= Url::toRoute($v['url'])?>'
                <?php if(isset($v['closeable'])):?>
                    ,closeable : false
                    <?php endif;?>
                },
                  <?php endif; endif; endforeach;?>
              ]
            },
            <?php endforeach ;?>
            ]
        }];
        new PageUtil.MainPage({
            modulesConfig: config
        });
    });
</script>

</body>
</html>
