
<div style="margin: 15px;">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">类型:</label>
            <div class="layui-input-block">
                <input type="text" name="name" value="<?php if(!empty($pms_data['name'])) echo $pms_data['name']?>" lay-verify="required" placeholder="请输入类型名字" autocomplete="off" class="layui-input">
            </div>
        </div>
        <?php
        if(!empty($pms_data['title_img'])):
        ?>
        <div class="layui-form-item">
            <label class="layui-form-label">图片:</label>
            <div class="layui-input-block">
                <img width="100px" src="<?=Yii::$app->params['before_url']?><?= $pms_data['title_img']?>">
            </div>
        </div>
        <?php endif;?>
        <div class="layui-form-item">
            <label class="layui-form-label">状态:</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="正常" <?php if(!empty($pms_data['status'])&&$pms_data['status']==1) echo 'checked=""';elseif(empty($pms_data['status'])) echo'checked=""'?>>
                <input type="radio" name="status" value="0" title="冻结" <?php if(isset($pms_data['status'])&&$pms_data['status']==0) echo 'checked=""';?> >
            </div>
        </div>
        <?php if(!empty($pms_data)):?>
            <input type="hidden" value="<?php echo $pms_data['id']?>" name="id" />
        <?php endif;?>
        <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
        <button lay-filter="edit" lay-submit style="display: none;"></button>

</form>
</div>