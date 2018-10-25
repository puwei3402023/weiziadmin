<div class="layui-layout layui-layout-admin" style="border-bottom: solid 5px #0055A4;">
    <div class="layui-header header header-demo">
        <div class="layui-main">
            <div class="admin-login-box">
                <a class="logo" style="left: 0;" href="javascript:void (0);">
                    <span style="font-size: 22px;">译讯科技</span>
                </a>
                <div class="admin-side-toggle">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <div class="admin-side-full">
                    <i class="fa fa-life-bouy" aria-hidden="true"></i>
                </div>
            </div>
            <ul class="layui-nav admin-header-item">
                <li class="layui-nav-item" id="clearCached">
                    <a href="javascript:;">清除缓存</a>
                </li>
                <li class="layui-nav-item">
                    <a href="<?=Yii::$app->params['before_url']?>"  target="_blank">浏览网站</a>
                </li>
                <!--                个人设置 开始-->
                <li class="layui-nav-item">
                    <a href="javascript:;" class="admin-header-user">
                        <img src="/images/0.jpg" />
                        <span><?=Yii::$app->user->identity->username?></span>
                    </a>
                    <dl class="layui-nav-child">
                        <dd id="editpwd" csrf="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>">
                            <a href="javascript:;">
                                <i class="fa fa-lock" aria-hidden="true" style="padding-right: 3px;padding-left: 1px;"></i> 修改密码
                            </a>
                        </dd>
                        <dd id="" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>">
                            <a href="<?=\yii\helpers\Url::toRoute('site/logout')?>"  ><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
                        </dd>
                    </dl>
                </li>
                <!--                个人设置结束-->
            </ul>
            <ul class="layui-nav admin-header-item-mobile">
                <li class="layui-nav-item">
                    <a href="<?=\yii\helpers\Url::toRoute('site/logout')?>"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="layui-side layui-bg-black" id="admin-side">
        <div class="layui-side-scroll" id="admin-navbar-side" lay-filter="side"></div>
    </div>
    <div class="layui-body" style="bottom: 0;border-left: solid 2px #0055A4;" id="admin-body">
        <div class="layui-tab admin-nav-card layui-tab-brief" lay-filter="admin-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">
                    <i class="fa fa-dashboard" aria-hidden="true"></i>
                    <cite>控制面板</cite>
                </li>
            </ul>
            <div class="layui-tab-content" style="min-height: 150px; padding: 5px 0 0 0;">
                <div class="layui-tab-item layui-show">
                    <!--                    加载默认首页-->
                    <iframe src="<?= \yii\helpers\Url::toRoute('main')?>"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-footer footer footer-demo" id="admin-footer">
        <div class="layui-main">

        </div>
    </div>
    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>

    <!--锁屏模板 start-->
    <script type="text/template" id="lock-temp">
        <div class="admin-header-lock" id="lock-box">
            <div class="admin-header-lock-img">
                <img src="/images/0.jpg"/>
            </div>
            <div class="admin-header-lock-name" id="lockUserName">beginner</div>
            <input type="text" class="admin-header-lock-input" value="输入密码解锁.." name="lockPwd" id="lockPwd" />
            <button class="layui-btn layui-btn-small" id="unlock">解锁</button>
        </div>
    </script>
    <!--锁屏模板 end -->