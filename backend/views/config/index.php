<body>
<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <a href="javascript:;" class="layui-btn layui-btn-small" id="add">
            <i class="layui-icon">&#xe608;</i> 添加配置
        </a>

    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="layui-field-box layui-form">
            <table class="layui-table admin-table">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>配置类型</th>
                    <th>内容</th>
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
        <td>{{ item.types }}</td>
        <td>{{ item.content }}</td>
        <td>{{item.status}}</td>
        <td>{{ item.add_time }}</td>
        <td>{{item.save_time}}</td>
        <td>
            <a href="javascript:;" data-name="{{ item.id }}" data-opt="edit" class="layui-btn layui-btn-mini">编辑</a>
            <a href="javascript:;" data-id="{{ item.id }}" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
        </td>
    </tr>
    {{# }); }}
    {{#  if(d.list.length === 0){ }}

    <tr><td colspan='7'>权限不足或者没有数据</td></tr>
    {{#  } }}
</script>
<script type="text/javascript" src="/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/zTree_v3/js/jquery-1.4.4.min.js"></script>
<!-- 引用核心层插件 -->
<script type="text/javascript" src="<?= \yii\helpers\Url::to('@web/zyFile/core/zyFile.js') ?>"></script>
<!-- 引用控制层插件 -->
<script type="text/javascript" src="<?= \yii\helpers\Url::to('@web/zyFile/control/js/zyUpload.js') ?>"></script>
<script>
    function upda(){
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
//                    console.info("当前选择了以下文件：");
//                    console.info(files);
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
                    var html = "<input type='hidden' name='url' value='" + data.url + "'/>";
                    $('#urlimg').append(html);
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
    }
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
            //>>.编辑函数
            edit_form('',url,up_url,from_url);
        });

    });
</script>
</body>