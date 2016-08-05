<?echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' >;"?>

<?php

session_start();

//注销登录
if($_GET['action'] == "logout"){
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	header("Location:login.html");
	//echo " <META HTTP-EQUIV=REFRESH CONTENT= '1;URL=login.html'> ";
	//echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
	exit;
}

//登录
if(!isset($_POST['submit'])){
	exit('非法访问!');
}
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
//$password = MD5($_POST['password']);

echo 'name:',$username,'<br />';
echo 'pwd:',$password,'<br />';

//包含数据库连接文件
include('conn.php');
//检测用户名及密码是否正确
$check_query = mysql_query("select * from user where name='$username' and pwd='$password' limit 1");
if($result = mysql_fetch_array($check_query)){
	
//if($username = "d" && $password = "d" ){
	//登录成功
	//$_SESSION["nickName"] = mb_convert_encoding($result['name'],"GB2312","UTF-8");
	$_SESSION['userid'] = $result['uid'];
	$_SESSION['username'] = $result['name'];
	$_SESSION['usernamex'] = $result['namex'];
	
	header("Location:main.html");
	//echo " <META HTTP-EQUIV=REFRESH CONTENT= '1;URL=main.html> ";
	

} else {
	//exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
	header("Location:error.html");
	//echo " <META HTTP-EQUIV=REFRESH CONTENT= '1;URL=login.php'> ";
}
?>