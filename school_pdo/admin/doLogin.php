<?php 
	require_once 'include.php';
	session_start();
	$username = $_POST['username'];
	$username = addslashes($username);
	$password = md5($_POST['password']);
	$autoFlag = $_POST['autoFlag'];
	

	$pdo = new PdoMySQL();	
	$sql="select * from  admin  where username='{$username}' and password='{$password}'";
	$row =  $pdo -> getRow($sql);

	
	if($row)
	{
		if($autoFlag)
		{
			setcookie("adminId",$row['id'],time()+7*24*3600);
			setcookie("adminName",$row['username'],time()+7*24*3600);
		}
		$_SESSION['adminName']=$row['username'];
		$_SESSION['adminId'] = $row['id'];
		alertMes('登录成功','index.php');
	}
	else
	{
		alertMes("登录失败，重新登录","login.php");
	}
?>