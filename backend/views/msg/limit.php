<?php
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2016/11/1
 * Time: 9:32
 */
?>
<div class="container">

    <div class="logout">

        <div class="logoutimg"><i class="icon-ban-circle icon-large icon-7x"></i></div>

        <div class="logouttext">
            <div class="logouttext1 span100">
                刷新过多
            </div>
            <div class="logouttext2">
                系统提醒：请稍后重试...<br/>
                请保持在5秒刷新一次
            </div>
            <div class="logouttext3">
                <a href="<?= $gotoUrl?>">系统如果未自动跳转，请手动跳转</a>
            </div>


        </div>


    </div>


</div>
<script>
    $(function(){
        function msg(){
            setTimeout(function(){
                window.location.href='<?= $gotoUrl?>'
            }, 5100);
        }
        msg()
    })
</script>