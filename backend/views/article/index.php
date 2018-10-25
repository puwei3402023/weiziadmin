<body>
<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <a href="<?= \yii\helpers\Url::toRoute('edit_form')?>" class="layui-btn layui-btn-small">
            <i class="layui-icon">&#xe608;</i> 发布文章
        </a>
        <a href="#" class="layui-btn layui-btn-small" id="stick_status">
            <i class="layui-icon">&#xe608;</i> 置顶首页
        </a>
        <a href="#" class="layui-btn layui-btn-small" id="cancel_stick_status">
            <i class="layui-icon">&#xe608;</i> 取消置顶首页
        </a>
        <form class="layui-form" style="float:right;">
            <div class="layui-form-item" style="margin:0;">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-inline">
                    <input type="text" name="title" placeholder="支持模糊查询.." autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux" style="padding:0;">
                    <button lay-filter="search" class="layui-btn" lay-submit=""><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
                </div>
            </div>
        </form>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="layui-field-box layui-form">
            <table class="layui-table admin-table">
                <thead id="checkbox_">
                <tr >
                    <th style="width: 30px;" ><input id="" type="checkbox" lay-filter="allselector" lay-skin="primary"><div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div></th>
                    <th>编号</th>
                    <th>标题</th>
                    <th>文章类型</th>
                    <th>作者</th>
                    <th>是否是首页</th>
                    <th>创建时间</th>
                    <th>更新时间</th>
                    <th>状态</th>
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
        <td><input type="checkbox" lay-skin="primary"></td>
<!--        这个地方必须是ID因为因为要获取这个ID去推送专题,以及其他操作-->
        <td>{{ item.id }}</td>
        <td>{{ item.title }}</td>
        <td>{{ item.type_name }}</td>
        <td>{{ item.author }}</td>
        <td>{{ item.index_status }}</td>
        <td>{{ item.created_at }}</td>
        <td>{{item.updated_at}}</td>
        <td>{{item.status}}</td>
        <td>
            <a href="javascript:;" data-name="{{ item.id }}" data-opt="edit" class="layui-btn layui-btn-mini">编辑</a>
            <a href="javascript:;" data-id="{{ item.id }}" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
        </td>
    </tr>
    {{# }); }}
    {{#  if(d.list.length === 0){ }}

    <tr><td colspan='10'>权限不足或者没有数据</td></tr>
    {{#  } }}
</script>
<script type="text/javascript" src="/plugins/layui/layui.js"></script>

<script>
    var _csrf='<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>';
    layui.config({
        base: '/js/'
    });
    layui.use(['paging', 'form'], function() {

            $ = layui.jquery,
            paging = layui.paging(),
            layerTips = parent.layer === undefined ? layui.layer : parent.layer, //获取父窗口的layer对象
            layer = layui.layer, //获取当前窗口的layer对象
            form = layui.form();

        ///////////////////列表 开始////////////////////
        paging.init({
            openWait: true,
//            url: 'datas/laytpl_laypage_data.json?v=' + new Date().getTime(), //地址
            url:'<?= \yii\helpers\Url::toRoute('get_data')?>',
            elem: '#content_index', //内容容器
            params: { //发送到服务端的参数
                'name':function(){
                    return 'aa'
                }
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
                //alert('处理完成');
                //重新渲染复选框
               form.render('checkbox');
                form.on('checkbox(allselector)', function(data) {
                    var elem = data.elem;
                    $('#content_index').children('tr').each(function() {
                        var $that = $(this);
                        //全选或反选
                        $that.children('td').eq(0).children('input[type=checkbox]')[0].checked = elem.checked;
                        form.render('checkbox');
                    });
                });
                //绑定所有编辑按钮事件
                $('#content_index').children('tr').each(function() {
                    var $that = $(this);
                    $that.children('td:last-child').children('a[data-opt=edit]').on('click', function() {
                        var id=$(this).data('name')
                        location.href='<?= \yii\helpers\Url::toRoute(['article/edit_form','id'=>''])?>'+id
                    });
                });
                //绑定所有删除按钮事件
                $('#content_index').children('tr').each(function() {
                    var $that = $(this);
                    var url="<?= \yii\helpers\Url::toRoute('del')?>";
                    $that.children('td:last-child').children('a[data-opt=del]').on('click', function() {
                        var id=$(this).data('id')
                        del_html(url,id);
                    });
                });

            },

        });
        //监听搜索表单的提交事件
        form.on('submit(search)', function (data) {
            paging.get(data.field);
            return false;
        });
        //////////////////////列表结束//////////////////////////

        ////////////////置顶 开始//////////////////////////////
        $('#stick_status').on('click', function() {
            layer.confirm('你确定要置顶？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                var names=get_article_id();
                //判断文章
                if(!isNull(names)){
                    htmlshowLayer('文章必须选择一个');
                    return false;
                }
                $.post('<?= \yii\helpers\Url::toRoute('stick_status')?>',{id:names,_csrf:_csrf},function(data){
                    if(data=='false'){
                        htmlshowLayer('权限不足请联系管理员')
                        return false;
                    }
                    var data=eval('('+data+')');
                    if(data.rel){
                        htmlshowLayers(data.msg,1);
                    }else {
                        htmlshowLayer(data.msg)
                    }
                })

            }, function(){

            });


            return false;
        });
        //////////////////置顶 结束//////////////////////////////

        //////////////置顶取消 开始//////////////////////////////
        $('#cancel_stick_status').on('click', function() {
            layer.confirm('你确定要取消置顶？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                var names=get_article_id();
                //判断文章
                if(!isNull(names)){
                    htmlshowLayer('文章必须选择一个');
                    return false;
                }
                $.post('<?= \yii\helpers\Url::toRoute('cancel_stick_status')?>',{id:names,_csrf:_csrf},function(data){
                    if(data=='false'){
                        htmlshowLayer('权限不足请联系管理员')
                        return false;
                    }
                    var data=eval('('+data+')');
                    if(data.rel){
                        htmlshowLayers(data.msg,1);
                    }else {
                        htmlshowLayer(data.msg)
                    }
                })

            }, function(){

            });


            return false;
        });
        //////////////////置顶取消 结束//////////////////////////////







        var addBoxIndex = -1;

        //获取选中要修改的id
        function get_article_id(){
            var names='';
            $('#content_index').children('tr').each(function() {
                var $that = $(this);
                var $cbx = $that.children('td').eq(0).children('input[type=checkbox]')[0].checked;
                if($cbx) {
                    var n = $that.children('td:last-child').children('a[data-opt=edit]').data('name');
                    names += n + ',';
                }
            });
            return names;
        }

    });
</script>

</body>