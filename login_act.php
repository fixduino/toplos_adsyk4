<?php 
session_start();
include 'admin/config.php';
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$pas=md5($pass);
$query=mysql_query("select * from users where username='$uname' and password='$pas'")or die(mysql_error());
if((mysql_num_rows($query)==1)){
	$_SESSION['uname']=$uname;
	header("location:index1.php");
}else{
	header("location:index.php?pesan=gagal")or die(mysql_error());
	// mysql_error();
}
/*
if((mysql_num_rows($query)==1) && ($uname=='admin')){
	$_SESSION['uname']=$uname;
	header("location:index1.php");
}else if((mysql_num_rows($query)==1) && ($uname=='operator')){
	$_SESSION['uname']=$uname;
	header("location:index2.php");
}else{
	header("location:index.php?pesan=gagal")or die(mysql_error());
	// mysql_error();
}*/
// echo $pas;
 ?>