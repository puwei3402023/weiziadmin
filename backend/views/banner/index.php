<body>
<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <a href="javascript:;" class="layui-btn layui-btn-small" id="add">
            <i class="layui-icon">&#xe608;</i> 添加banner
        </a>

    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="layui-field-box layui-form">
            <table class="layui-table admin-table">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>主题名字</th>
                    <th>图片</th>
                    <th>跳转地址</th>
                    <th>类型</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="content_index">
                </tbody>
            </table>
        </div>
    </fieldset>
    <div class="admin-table-page">
        <div id="paged" class="page">
        </div>
    </div>
</div>
<!--模板-->
<script type="text/html" id="tpl">
    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td>{{ item.id }}</td>
        <td>{{ item.name }}</td>
        <td><img width="100px" src="{{ item.url }}"></td>
        <td>{{ item.jump_url }}</td>
        <td>{{item.type}}</td>
        <td>{{item.status}}</td>
        <td>{{ item.created_at }}</td>
        <td>{{item.updated_at}}</td>
        <td>
            <a href="javascript:;" data-name="{{ item.id }}" data-opt="edit" class="layui-btn layui-btn-mini">编辑</a>
            <a href="javascript:;" data-id="{{ item.id }}" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
        </td>
    </tr>
    {{# }); }}
    {{#  if(d.list.length === 0){ }}

    <tr><td colspan='9'>权限不足或者没有数据</td></tr>
    {{#  } }}
</script>
<script type="text/javascript" src="/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/zTree_v3/js/jquery-1.4.4.min.js"></script>
<!-- 引用核心层插件 -->
<script type="text/javascript" src="<?= \yii\helpers\Url::to('@web/zyFile/core/zyFile.js') ?>"></script>
<!-- 引用控制层插件 -->
<script type="text/javascript" src="<?= \yii\helpers\Url::to('@web/zyFile/control/js/zyUpload.js') ?>"></script>
<script>
    layui.config({
        base: '/js/'
    });

    layui.use(['paging', 'form'], function() {

        var $ = layui.jquery,
            paging = layui.paging(),
            layerTips = parent.layer === undefined ? layui.layer : parent.layer, //获取父窗口的layer对象
            layer = layui.layer, //获取当前窗口的layer对象
            form = layui.form();
            var url='<?= \yii\helpers\Url::toRoute('edit_form')?>';
            var up_url='<?= \yii\helpers\Url::toRoute(['upload/index'])?>';

        ///////////////////列表 开始////////////////////
        paging.init({
            openWait: true,
//            url: 'datas/laytpl_laypage_data.json?v=' + new Date().getTime(), //地址
            url:'<?= \yii\helpers\Url::toRoute('get_data')?>',
            elem: '#content_index', //内容容器
            params: { //发送到服务端的参数
            },
            type: 'GET',
            tempElem: '#tpl', //模块容器
            pageConfig: { //分页参数配置
                elem: '#paged', //分页容器
                pageSize: 12 //分页大小
            },
            success: function() { //渲染成功的回调
                //alert('渲染成功');
            },
            fail: function(msg) { //获取数据失败的回调
                //alert('获取数据失败')
            },
            complate: function() { //完成的回调

                //绑定所有编辑按钮事件
                $('#content_index').children('tr').each(function() {
                    var $that = $(this);
                    $that.children('td:last-child').children('a[data-opt=edit]').on('click', function() {
                        var id=$(this).data('name')
                        layer.msg('获取中');
                        var from_url='<?= \yii\helpers\Url::toRoute('save')?>';
                        edit_form(id,url,up_url,from_url);
                    });

                });
                //绑定所有删除按钮事件
                $('#content_index').children('tr').each(function() {
                    var url="<?= \yii\helpers\Url::toRoute('del')?>";
                    var $that = $(this);
                    $that.children('td:last-child').children('a[data-opt=del]').on('click', function() {
                        var id=$(this).data('id')
                        del_html(url,id);
                    });
                });

            },
        });
        //////////////////////列表结束//////////////////////////
        var addBoxIndex = -1;
        $('#add').on('click', function() {
            if(addBoxIndex !== -1)
                return;
            //本表单通过ajax加载 --以模板的形式，当然你也可以直接写在页面上读取
            var from_url='<?= \yii\helpers\Url::toRoute('add')?>';
            edit_form('',url,up_url,from_url);
        });
    });
</script>
</body>