
/**
 * 根据data中的值弹出提示框
 * @param data
 */
function showLayer(data){
	layer.msg(data.msg, {
		icon: data.rel ? 1 : 0,
		offset: 0,
		//shift: 6,
		time: 2000   //1秒钟之后执行下面的函数
	}, function () {
		if (data.rel) {  //成功的时候跳转到指定的url地址
			location.href = data.url;
		}
	});
}
function htmlshowLayer(data) {
	var b = arguments[1] ? arguments[1] : 0;
	layer.msg(data, {
		icon: b,
		offset: 0,
//			shift: 6,
		time: 2000   //1秒钟之后执行下面的函数
	}, function () {

	});
}
function htmlshowLayers(data,type) {
	var b = arguments[1] ? arguments[1] : 0;
	layer.msg(data, {
		icon: b,
		offset: type,
//			shift: 6,
		time: 2000   //1秒钟之后执行下面的函数
	}, function () {
		location.reload(); //刷新
	});
}

//全选/反选控制


function checkAll(obj,type){
	$("#"+type+" input[type='checkbox']").prop('checked', $(obj).prop('checked'));
}




/**
 * 判断是否null
 * @param data
 */
function isNull(data){
	return (data == "" || data == undefined || data == null) ? false : data;
}
	/**
	 * 格式化金钱
	 * @param num
	 * @returns {string}
	 */
function fmoney(s,n){
		n = n > 0 && n <= 20 ? n : 2;
		s = parseFloat((s + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
		var l = s.split(".")[0].split("").reverse(),
			r = s.split(".")[1];
		t = "";
		for(i = 0; i < l.length; i ++ ){
			t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : "");
		}
		return t.split("").reverse().join("") + "." + r;
}

/**
 * 删除操作
 * @param url
 */
function del_html(url,id) {
        //询问框
        layer.confirm('你确定要删除嘛？', {
            btn: ['确定','取消'] //按钮
        }, function(a,b){
            layer.msg('删除中');
            $.get(url,{id:id},function (data) {
                if(data=='false'){
                    htmlshowLayer('权限不足请联系管理员')
                    return false;
                }
                var data=eval('('+data+')');
                if(data.rel){
                    htmlshowLayers('删除成功',1)
                }else {
                    htmlshowLayer(data.msg)
                }
            })
        }, function(){
        });
}

/**
 * 上传
 */
function upda(url){
    $("#demo").zyUpload({
        width: "100%",                 // 宽度
        itemWidth: "80px",                 // 文件项的宽度
        itemHeight: "80px",                 // 文件项的高度
        url: url,  // 上传文件的路径
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
            var html = "<input type='hidden' name='title_img' value='" + data.url + "'/>";
             html += "<input type='hidden' name='url' value='" + data.url + "'/>";
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

/**
 * 获取编辑页面
 * @param id
 * @param url
 * @param up_url
 * @param from_url
 */
function edit_form(id,url,up_url,from_url) {

    $.get(url, {id:id}, function(form) {
        var type=1

        if(form=='false'){
            form='/msg/error2'
            type=2
        }
        addBoxIndex = layer.open({
            type: type,
            title: '添加表单',
            content: form,
            btn: ['保存', '取消'],
            shade: false,
            offset: ['100px', '30%'],
            area: ['800px', '600px'],
            zIndex: 100,
            maxmin: true,
            yes: function(index) {
                //触发表单的提交事件
                $('form.layui-form').find('button[lay-filter=edit]').click();
            },
            full: function(elem) {
                var win = window.top === window.self ? window : parent.window;
                $(win).on('resize', function() {
                    var $this = $(this);
                    elem.width($this.width()).height($this.height()).css({
                        top: 0,
                        left: 0
                    });
                    elem.children('div.layui-layer-content').height($this.height() - 95);
                });
            },
            success: function(layero, index) {
                upda(up_url)
                //弹出窗口成功后渲染表单
                var form = layui.form();
                form.render();
                //重新渲染复选框
                form.render('checkbox');
                //添加权限的时候多项框全选
                form.on('checkbox(ck)', function(data) {
                    var elem = data.elem;
                    $('#ck'+data.value).each(function() {
                        var $that = $(this);
                        //全选或反选
                        var che=($that.eq(0).children('input[type=checkbox]'))
                        $(che).each(function () {
                            this.checked=elem.checked;
                        });
                        form.render('checkbox');
                    });
                });
                form.on('submit(edit)', function(data) {
                    //这里可以写ajax方法提交表单
                    $.post(from_url,data.field,function (data) {
                        if(data=='false'){
                            htmlshowLayer('权限不足请联系管理员')
                            return false;
                        }
                        var data=eval('('+data+')');
                        if(data.rel){
                            htmlshowLayers(data.msg,1)
                        }else {
                            htmlshowLayer(data.msg)
                        }
                    })
                    return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
                });
                //console.log(layero, index);
            },
            end: function() {
                addBoxIndex = -1;
            }
        });
    });
}