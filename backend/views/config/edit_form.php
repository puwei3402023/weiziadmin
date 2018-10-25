
<div style="margin: 15px;">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">配置类型:</label>
            <div class="layui-input-block">
                <select name="types" lay-filter="aihao"  lay-verify="required" >
                    <option value=""></option>
                    <?php
                    if(!empty($this->params['types'])):
                        foreach ($this->params['types'] as $k=>$v):
                            if($k>0):
                            ?>
                            <option value="<?=$k?>" <?php if(!empty($pms_data['types'])&&$pms_data['types']==$k) echo 'selected=""'?>><?=$v?></option>
                        <?php endif;endforeach;endif;?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">内容:</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" name="content" class="layui-textarea"><?php if(!empty($pms_data['content'])) echo $pms_data['content']?></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">状态:</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="正常" <?php if(!empty($pms_data['status'])&&$pms_data['status']==1) echo 'checked=""';elseif(empty($pms_data['status'])) echo'checked=""'?>>
                <input type="radio" name="status" value="0" title="冻结" <?php if(isset($pms_data['status'])&&$pms_data['status']==0) echo 'checked=""';?>  >
            </div>
        </div>
        <?php if(!empty($pms_data)):?>
            <input type="hidden" value="<?php echo $pms_data['id']?>" name="id" />
        <?php endif;?>
        <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
        <button lay-filter="edit" lay-submit style="display: none;"></button>

</form>
</div>