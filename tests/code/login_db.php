<?php
/**
 * UCenter 应用程序开发 Example
 *
 * 应用程序有自己的用户表，用户登录的 Example 代码
 * 使用到的接口函数：
 * uc_user_login()	必须，判断登录用户的有效性
 * uc_authcode()	可选，借用用户中心的函数加解密激活字串和 Cookie
 * uc_user_synlogin()	可选，生成同步登录的代码
 */

if(empty($_POST['submit'])) {
	//登录表单
	echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'?example=login">';
	echo '登录:';
	echo '<dl><dt>用户名</dt><dd><input name="username"></dd>';
	echo '<dt>密码</dt><dd><input name="password" type="password"></dd></dl>';
	echo '<input name="submit" type="submit"> ';
	echo '</form>';
} else {
	//通过接口判断登录帐号的正确性，返回值为数组
	list($uid, $username, $password, $email) = uc_user_login($_POST['username'], $_POST['password']);

	setcookie('Example_auth', '', -86400);
	if($uid > 0) {
		if(!$db->result_first("SELECT count(*) FROM {$tablepre}members WHERE uid='$uid'")) {
			//判断用户是否存在于用户表，不存在则跳转到激活页面
			$auth = rawurlencode(uc_authcode("$username\t".time(), 'ENCODE'));
			echo '您需要需要激活该帐号，才能进入本应用程序<br><a href="'.$_SERVER['PHP_SELF'].'?example=register&action=activation&auth='.$auth.'">继续</a>';
			exit;
		}
		//用户登陆成功，设置 Cookie，加密直接用 uc_authcode 函数，用户使用自己的函数
		setcookie('Example_auth', uc_authcode($uid."\t".$username, 'ENCODE'));
		//生成同步登录的代码
		$ucsynlogin = uc_user_synlogin($uid);
		echo '登录成功'.$ucsynlogin.'<br><a href="'.$_SERVER['PHP_SELF'].'">继续</a>';
		exit;
	} elseif($uid == -1) {
		echo '用户不存在,或者被删除';
	} elseif($uid == -2) {
		echo '密码错';
	} else {
		echo '未定义';
	}
}

?>