<?php
return [
    'before_url'=>'http://www.arxw.org',
    'adminEmail' => 'admin@example.com',
    /**
     * status=0表示不在菜单显示
     * status=1可以在菜单显示
     * status=3主页默认加载(这个只能又一个)
     * icon 菜单图标
     * spread 是否默认打开 true打开,false关闭
     */
    'MENUS_URL'=>[
        '基础查询'=>[
            'icon'=>'fa-cubes',
            'spread'=>true,
            '主页'=>['url'=>'index/index','status'=>0],
            '首页中心'=>['url'=>'index/main','status'=>1,'closeable'=>'false','icon'=>'&#xe641;'], //客服的首页

        ],
        '文章管理'=>[
            'icon'=>'fa-cubes',
            'spread'=>false,
            '文章管理'=>['url'=>'article/index','status'=>1,'icon'=>'&#xe641;'],
            '发布文章'=>['url'=>'article/add','status'=>0],
            '编辑文章'=>['url'=>'article/save','status'=>0],
            '获取文章编辑页面'=>['url'=>'article/edit_form','status'=>0],
            '文章数据列表'=>['url'=>'article/get_data','status'=>0],
            '删除文章'=>['url'=>'article/del','status'=>0],
            '置顶文章'=>['url'=>'article/stick_status','status'=>0],
            '取消置顶文章'=>['url'=>'article/cancel_stick_status','status'=>0],

            '文章类型管理'=>['url'=>'article-type/index','status'=>1,'icon'=>'&#xe641;'],
            '添加类型文章'=>['url'=>'article-type/add','status'=>0],
            '编辑类型文章'=>['url'=>'article-type/save','status'=>0],
            '获取文章类型编辑页面'=>['url'=>'article-type/edit_form','status'=>0],
            '文章类型数据列表'=>['url'=>'article-type/get_data','status'=>0],
            '删除文章类型'=>['url'=>'article-type/del','status'=>0],



            'banner管理'=>['url'=>'banner/index','status'=>1,'icon'=>'&#xe641;'],
            '修改banner'=>['url'=>'banner/save','status'=>0],
            '获取banner编辑页面'=>['url'=>'banner/edit_form','status'=>0],
            '添加banner'=>['url'=>'banner/add','status'=>0],
            '获取banner数据列表'=>['url'=>'banner/get_data','status'=>0],
            '删除banner'=>['url'=>'banner/del','status'=>0],

        ],
        '解决方案管理'=>[
            'icon'=>'fa-cubes',
            'spread'=>false,
            '解决方案类型列表'=>['url'=>'solutions/index','status'=>1,'icon'=>'&#xe641;'],
            '添加解决方案类型'=>['url'=>'solutions/add','status'=>0],
            '修改解决方案类型'=>['url'=>'solutions/save','status'=>0],
            '解决方案类型编辑页面'=>['url'=>'solutions/edit_form','status'=>0],
            '解决方案类型获取数据列表'=>['url'=>'solutions/get_data','status'=>0],
            '删除解决方案类型'=>['url'=>'solutions/del','status'=>0],

            '解决方案内容列表'=>['url'=>'solutions-content/index','status'=>1,'icon'=>'&#xe641;'],
            '添加解决方案内容'=>['url'=>'solutions-content/add','status'=>0],
            '修改解决方案内容'=>['url'=>'solutions-content/save','status'=>0],
            '解决方案内容编辑页面'=>['url'=>'solutions-content/edit_form','status'=>0],
            '解决方案内容获取数据列表'=>['url'=>'solutions-content/get_data','status'=>0],
            '删除解决方案内容'=>['url'=>'solutions-content/del','status'=>0],

        ],
        '产品及服务管理'=>[
            'icon'=>'fa-cubes',
            'spread'=>false,
            '产品及服务列表'=>['url'=>'services/index','status'=>1,'icon'=>'&#xe641;'],
            '添加产品及服务'=>['url'=>'services/add','status'=>0],
            '修改产品及服务'=>['url'=>'services/save','status'=>0],
            '产品及服务编辑页面'=>['url'=>'services/edit_form','status'=>0],
            '产品及服务获取数据列表'=>['url'=>'services/get_data','status'=>0],
            '删除产品及服务'=>['url'=>'services/del','status'=>0],
        ],
        '配置管理'=>[
            'icon'=>'fa-cubes',
            'spread'=>false,
            '配置列表'=>['url'=>'config/index','status'=>1,'icon'=>'&#xe641;'],
            '添加配置'=>['url'=>'config/add','status'=>0],
            '修改配置'=>['url'=>'config/save','status'=>0],
            '配置编辑页面'=>['url'=>'config/edit_form','status'=>0],
            '配置获取数据列表'=>['url'=>'config/get_data','status'=>0],
            '删除配置'=>['url'=>'config/del','status'=>0],
        ],
        '权限管理'=>[
            'icon'=>'fa-cubes',
            'spread'=>false,
            '管理员管理'=>['url'=>'user/index','status'=>1,'icon'=>'&#xe641;'],
            '添加管理员'=>['url'=>'user/add','status'=>0],
            '修改管理员'=>['url'=>'user/save','status'=>0],
            '管理员编辑页面'=>['url'=>'user/edit_form','status'=>0],
            '管理员获取数据列表'=>['url'=>'user/get_data','status'=>0],
            '删除管理员'=>['url'=>'user/del','status'=>0],

            '管理组管理'=>['url'=>'permissions/index','status'=>1,'icon'=>'&#xe641;'],
            '修改管理组'=>['url'=>'permissions/save','status'=>0],
            '获取编辑页面'=>['url'=>'permissions/edit_form','status'=>0],
            '添加管理组'=>['url'=>'permissions/add','status'=>0],
            '获取数据列表'=>['url'=>'permissions/get_data','status'=>0],
            '删除管理组'=>['url'=>'permissions/del','status'=>0],
        ],
        '通用权限'=>[
            'icon'=>'fa-cubes',
            'spread'=>false,
            '获取菜单数据'=>['url'=>'index/get_menu','status'=>0],
            '文件上传'=>['url'=>'upload/index','status'=>0],
            '修改密码'=>['url'=>'user/reset_password','status'=>0],
        ],
    ],
    'TYPE_NAME'=>[
        0=>'类型没选择',
        1=>'底部',
        2=>'公司名字',
        3=>'关键字',
        4=>'介绍',
    ],
];
