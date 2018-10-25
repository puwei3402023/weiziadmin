
<div style="margin: 15px;">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">用户名:</label>
            <div class="layui-input-block">
                <input type="text" name="username" value="<?php if(!empty($pms_data['username'])) echo $pms_data['username']?>" lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱:</label>
            <div class="layui-input-block">
                <input type="text" name="email" lay-verify="email" value="<?php if(!empty($pms_data['email'])) echo $pms_data['email']?>"  placeholder="请输入邮箱" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码:</label>
            <div class="layui-input-inline">
                <input type="password" name="password_hash" <?php if(empty($pms_data))echo "lay-verify=\"pass\""?>  placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">字母和数字组成6到12位密码</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">角色</label>
            <div class="layui-input-block">
                <select name="role" lay-filter="aihao"  lay-verify="required" >
                    <option value=""></option>
                    <?php
                    if(!empty($pms)):
                        foreach ($pms as $v):
                    ?>
                    <option value="<?=$v['id']?>" <?php if(!empty($pms_data['role'])&&$pms_data['role']==$v['id']) echo 'selected=""'?>><?=$v['name']?></option>
                    <?php endforeach;endif;?>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">状态:</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="10" title="正常" <?php if(!empty($pms_data['status'])&&$pms_data['status']==10) echo 'checked=""';elseif(empty($pms_data['status'])) echo'checked=""'?>>
                <input type="radio" name="status" value="1" title="冻结" <?php if(!empty($pms_data['status'])&&$pms_data['status']==1) echo 'checked=""';?>  >
            </div>
        </div>
        <?php if(!empty($pms_data)):?>
            <input type="hidden" value="<?php echo $pms_data['id']?>" name="id" />
        <?php endif;?>
        <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
        <button lay-filter="edit" lay-submit style="display: none;"></button>

</form>
</div>