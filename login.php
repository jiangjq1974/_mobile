<?echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' >;"?>

<?php

session_start();

//ע����¼
if($_GET['action'] == "logout"){
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	header("Location:login.html");
	//echo " <META HTTP-EQUIV=REFRESH CONTENT= '1;URL=login.html'> ";
	//echo 'ע����¼�ɹ�������˴� <a href="login.html">��¼</a>';
	exit;
}

//��¼
if(!isset($_POST['submit'])){
	exit('�Ƿ�����!');
}
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
//$password = MD5($_POST['password']);

echo 'name:',$username,'<br />';
echo 'pwd:',$password,'<br />';

//�������ݿ������ļ�
include('conn.php');
//����û����������Ƿ���ȷ
$check_query = mysql_query("select * from user where name='$username' and pwd='$password' limit 1");
if($result = mysql_fetch_array($check_query)){
	
//if($username = "d" && $password = "d" ){
	//��¼�ɹ�
	//$_SESSION["nickName"] = mb_convert_encoding($result['name'],"GB2312","UTF-8");
	$_SESSION['userid'] = $result['uid'];
	$_SESSION['username'] = $result['name'];
	$_SESSION['usernamex'] = $result['namex'];
	
	header("Location:main.html");
	//echo " <META HTTP-EQUIV=REFRESH CONTENT= '1;URL=main.html> ";
	

} else {
	//exit('��¼ʧ�ܣ�����˴� <a href="javascript:history.back(-1);">����</a> ����');
	header("Location:error.html");
	//echo " <META HTTP-EQUIV=REFRESH CONTENT= '1;URL=login.php'> ";
}
?>