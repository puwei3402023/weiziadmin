<div style="margin: 15px;">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">推送专题</label>
            <div class="layui-input-block">
                <?php
                    if(!empty($pms_data)):
                        foreach($pms_data as $v):
                ?>
                <input type="checkbox" name="subject_id[]" value="<?= $v['id']?>" title="<?= $v['name']?>">

                <?php endforeach;endif;?>
            </div>
        </div>


        <input type="hidden" value="<?php echo \Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
        <button lay-filter="edit" lay-submit style="display: none;"></button>

    </form>
</div>