<?php 
include 'admin/config.php';
date_default_timezone_set('Asia/Jakarta');
$s = time ();
$tgljam =date("Y-m-d H:i:s",$s);

$uname=$_POST['uname2'];
$utype=$_POST['utype2'];
$upass=$_POST['upass2'];
$ufoto=$_POST['ufoto2'];
$hash_password= hash('sha1', $upass);
// mysql_query("insert into tb_loss values('','$tgljam','$brid1','$qtyreq2','$tanktuj3')");

//cari data tanki x
$qcek_user= mysql_query("select users.* from users where username='".$uname."'");
if($qcek_user!=false){
    $idnya= $qcek_user['id'];
    echo $idnya;
    $idnya=mysql_result($qcek_user,0,"id");echo $idnya;
    $qupd_tank = mysql_query("UPDATE users SET type = '$utype', password = '$hash_password' , foto = '$ufoto' WHERE id = '$idnya' LIMIT 1;");
}
// header("location:page-dashboard.php");

 ?>