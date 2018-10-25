<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\helpers\Url;

\frontend\assets\ReleaseAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="keywords" content="<?= Html::encode(isset($this->params['keywords'])?$this->params['keywords']:'')?>">
    <meta name="description" content="<?= Html::encode(isset($this->params['description'])?$this->params['description']:'')?>">

    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<!--    <link href="/css/style.css" rel="stylesheet" type="text/css" />-->
<!--    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
<!--    <link href="/css/swiper-4.1.0.min.css" rel="stylesheet" type="text/css" />-->
<!--    <link href="/css/mobile.css" rel="stylesheet" type="text/css" />-->
<!--    <link href="/css/flexslider.css" rel="stylesheet" type="text/css" />-->
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/swiper-4.1.0.min.js"></script>
    <script type="text/javascript" src="/js/flexslider.js"></script>
    <script type="text/javascript" src="/js/flexslider-min.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<!--头部-->
<?php $get_url='/'.Yii::$app->request->getPathInfo();?>
<div class="wrap-box">
    <a href="/" title="" class="l-link"><img src="/images/logo.png" alt="" class="logo" /></a>
    <nav class="menu-list">
        <li class="menu-list-link"><a href="<?=Url::toRoute('index/index')?>" <?php if($get_url==Url::toRoute('index/index')):?>class="select"<?php endif;?>>译讯首页<i class="fa fa-angle-down fa-lg offset-1"></i></a>


<div class="arrow"></div>
                <div class="link-box">
                  <a href="">用户</a>
                    <a href="">新闻媒体</a>
                    <a href="">投资者</a>
                    <a href="">求职者</a>
    </div> 

       </li>
        <li class="menu-list-link"><a href="<?=Url::toRoute('index/services')?>" class="navlink">产品及服务<i class="fa fa-angle-down fa-lg offset-1"></i></a>
             <div class="arrow"></div>
 				<div class="link-box">
                    <?php
                    $services=$this->params['services'];
                    if(!empty($services)):
                        foreach ($services as $v):
                            ?>
                           <a href="<?=Url::toRoute(['index/service-content','id'=>$v['id']])?>"><?=$v['title']?></a>
                        <?php endforeach;endif;?>
               </div> 

             
             </li>


        <li class="menu-list-link"><a href="<?=Url::toRoute('index/solutions')?>" class="navlink">解决方案<i class="fa fa-angle-down fa-lg offset-1"></i></a> 
              <div class="arrow"></div>
                  <div class="link-box">

                    <?php
                    $solutions=$this->params['solutions'];
                        if(!empty($solutions)):
                            foreach ($solutions as $v):
                    ?>
                   <a href="<?=Url::toRoute(['index/solutions2','id'=>$v['id']])?>"><?=$v['name']?></a>
                    <?php endforeach;endif;?>

                </div>
               
           </li>
        <li class="menu-list-link"><a href="" class="navlink">新闻资讯<i class="fa fa-angle-down fa-lg offset-1"></i></a> 

<div class="arrow"></div>
  				<div class="link-box">

                    <?php
                    $article_type=$this->params['article_type'];
                    if(!empty($article_type)):
                        foreach ($article_type as $v):
                            ?>
                   <a href="<?=Url::toRoute(['index/article-list','type_id'=>$v['id']])?>"><?=$v['name']?></a>
                    <?php endforeach;endif;?>

                </div>
</li>

        <li class="menu-list-link"><a href="" class="navlink">关于译讯<i class="fa fa-angle-down fa-lg offset-1"></i></a>
<div class="arrow"></div>
 <div class="link-box">
                  <a href="<?=Url::toRoute('index/about')?>">公司介绍</a>
                    <a href="">愿景使命</a>
                    <a href="">加入我们</a>
                    <a href="<?=Url::toRoute('index/contact')?>">联系我们</a>
    </div> 

     </li>
    </nav>

    <a class="mobile-menu" id="menu"><i class="fa fa-reorder"></i></a>
    <a class="index-search" id="search"><i class="fa fa-search"></i></a>
    <div class="cn-en-box">
        <a href="javascript:void (0)" class="cn-en">语言选择<i class="fa fa-angle-down fa-lg offset-1"></i></a>
        <div class="cn-en-div">
            <dd><a href="">International</a></dd>
            <dd><a href="">North America</a></dd>
            <dd><a href="">Français</a></dd>
            <dd><a href="">Français</a></dd>
        </div>
    </div>
</div>


<!-- 手机二级菜单，JS还未完成 -->
<div class="mobile-second-link">
    <a href="<?=Url::toRoute('index/index')?>" <?php if($get_url==Url::toRoute('index/index')):?>class="select"<?php endif;?>>首页</a>
    <a href="<?=Url::toRoute('index/solutions')?>" <?php if($get_url==Url::toRoute('index/solutions')):?>class="select"<?php endif;?>>解决方案</a>
    <a href="<?=Url::toRoute('index/services')?>" <?php if($get_url==Url::toRoute('index/services')):?>class="select"<?php endif;?>>产品及服务</a>
    <a href="<?=Url::toRoute('index/article-list')?>" <?php if($get_url==Url::toRoute('index/article-list')):?>class="select"<?php endif;?>>相关资讯</a>
    <a href="<?=Url::toRoute('index/about')?>" <?php if($get_url==Url::toRoute('index/about')):?>class="select"<?php endif;?>>关于我们</a>
</div>
<div class="overlay"></div>
<div id="searchbar">
    <h3>资讯搜索</h3>
    <form onsubmit="return checkSearchForm()" method="get" name="searchform" action="<?=Url::toRoute('index/article-list')?>">
        <input type="hidden" value="1" name="tempid">
        <input type="hidden" value="news" name="tbname">
        <input name="mid" value="1" type="hidden">
        <input name="dopost" value="search" type="hidden">
        <input type="text" name="name" id="edtSearch" class="text" value="输入搜索关键词 " onblur="if($(this).val() == ''){$(this).val('输入搜索关键词 ');}" onfocus="if($(this).val() == '输入搜索关键词 '){$(this).val('');}" x-webkit-speech="">
        <input type="submit" id="btnPost" name="submit" class="submit" value="搜索">
    </form>
</div>
<?= $content ?>




<?php $this->endBody() ?>

<!--底部-->
<div id="foot">

    <div class="footer-top">
        <div class="w-1400 f-cb">
           <ul class="footer-top-center">
                <li>
                    <h2>产品及服务</h2>
                    <p><a href="https://www.dahuatech.com/about.html">公司概况</a></p> 
                    <p><a href="https://www.dahuatech.com/news.html">公司资讯</a></p>
                    <p><a href="https://www.dahuatech.com/about/manage.html">管理体系</a></p>
                    <p><a href="https://www.dahuatech.com/service/contact.html">联系我们</a></p>
                </li>
                <li>
                    <h2>解决方案</h2>
                    <p><a href="">政府传媒</a></p>
                    <p><a href="">教育留学</a></p>
                    <p><a href="">国际工程</a></p>
                    <p><a href="">科研情报</a></p>
                    <p><a href="">涉外法律</a></p>
                    <p><a href="">专利产权</a></p>
                </li>
                <li>
                    <h2>新闻资讯</h2>
                    <p><a href="">行业资讯</a></p>
                    <p><a href="">企业资讯</a></p>
                </li>
                <li>
                    <h2>关于译讯</h2>
                    <p><a href="">公司介绍</a></p>
                    <p><a href="">愿景使命</a></p>
                    <p><a href="">加入我们</a></p>
                    <p><a href="">联系我们</a></p>
                </li>
                <li>
                    <h2>联系我们</h2>
                    <p>400-000-0000</p>
                    <p><a href="mailto:support@dahuatech.com">support@dahuatech.com</a></p>
                    <p>成都市高新区XXX</p>
                </li>

                <li>
                    <h2>加入译讯</h2>
                    <p><a href="">就业机会</a></p>

                </li>
            </ul>
           




        </div>
    </div>

    <div class="footer-bot">
     <div class="foot-link clearfix">
        <a href="">友情链接</a>
        <a href="">友情链接</a>
        <a href="">友情链接</a>
        <a href="">友情链接</a>
        <a href="">友情链接</a>
    </div>
        <div class="w-1400 f-cb">
            <div class="footer-bot-left">
                <p><?= isset($this->params['boot_name'])?$this->params['boot_name']:''?></p>
                <a href="javascript:void(0)">法律声明</a>
                <a href="javascript:void(0)">网站地图</a>
                <!--<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
                    document.write(unescape("%3Cspan id='cnzz_stat_icon_1268330873'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s19.cnzz.com/z_stat.php%3Fid%3D1268330873%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
                    </script>-->
                <script>
                    var _hmt = _hmt || [];
                    (function() {
                        var hm = document.createElement("script");
                        hm.src = "https://hm.baidu.com/hm.js?baf8734fbf2bb219ab164ade9e6f297d";
                        var s = document.getElementsByTagName("script")[0];
                        s.parentNode.insertBefore(hm, s);
                    })();
                </script>
            </div>
            <div class="bdsharebuttonbox f-cb bdshare-button-style2-32" data-bd-bind="1520339309906">
                <a href="javascript:void(0)" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                <a href="javascript:void(0)" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                <a href="javascript:void(0)" class="bds_isohu" data-cmd="isohu" title="分享到我的搜狐"></a>
                <a href="javascript:void(0)" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                <a href="javascript:void(0)" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                <!-- <a target="_blank" style="background: url(https://www.dahuatech.com/bocweb/web/img/rss.png) no-repeat center;" href="https://www.dahuatech.com/feed.php" class="bds_feed" title="feed"></a> -->
            </div>
        </div>
    </div>


</div>


<div class="f-right">
    <a href="javascript:void(0)" class="wei_xin"><i class="fa fa-wechat"></i></a>
    <a href="javascript:void(0)" class="backtotop"><i class="fa fa-angle-up"></i></a>

</div>

</body>
</html>
<?php $this->endPage() ?>
