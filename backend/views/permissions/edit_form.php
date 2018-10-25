
<div style="margin: 15px;">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">管理用户组:</label>
            <div class="layui-input-block">
                <input type="text" name="name" value="<?php if(!empty($pms_data['name'])) echo $pms_data['name']?>" lay-verify="required" placeholder="请输入组名字" autocomplete="off" class="layui-input">
            </div>
        </div>




<fieldset class="layui-elem-field">

    <legend>数据列表</legend>
    <div class="layui-field-box layui-form">
        <table class="layui-table admin-table">
            <thead>
            <tr>
                <th>权限类型</th>
                <th>菜单</th>
                <th>权限筛选</th>
            </tr>
            </thead>
            <tbody >
            <?php
            if(!empty($pms_data)):
            $nameinfo=explode(';',$pms_data['info']);
            $access=explode(';',$pms_data['access']);
            else:
                $access=[];
                $nameinfo=[];
            endif;
            $i=0;
            $j=0;
            if(!empty($menus_url)):
            foreach($menus_url as $key=>$menu):
            ?>
            <tr>
                <td>
                    <?= $key?>
                </td>
                <td>
                        <input type="checkbox" autocomplete="off" <?php if(in_array($key,$access))echo "checked" ?> name="access[<?=$i?>]" value="<?= $key?>" title="<?= $key?>">
                </td>
                <td id='ck<?=$i?>'>

                            <?php  foreach ($menu as $k=>$v):?>
                            <input type="checkbox" name="info[<?=$j?>]" <?php if(in_array($k,$nameinfo))echo "checked" ?> value="<?=$k?>" title="<?=$k?>">
                            <?php ++$j; endforeach;?>
                    <input type="checkbox" lay-filter="ck" value="<?=$i?>" lay-skin="primary" title="全选">
                </td>
            </tr>
            <?php ++$i; endforeach;endif;?>
            </tbody>
        </table>
    </div>
    <?php if(!empty($pms_data)):?>
    <input type="hidden" value="<?php echo $pms_data['id']?>" name="id" />
    <?php endif;?>
    <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
<!--    下面2个隐藏域是修改的时候不选择的时候验证使用的-->
    <input type="hidden" value="" name="info[01]" />
    <input type="hidden" value="" name="access[01]" />
        <button lay-filter="edit" lay-submit style="display: none;"></button>

</fieldset>
</form>
</div>