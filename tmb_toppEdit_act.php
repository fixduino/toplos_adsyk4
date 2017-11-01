<?php 
include 'admin/config.php';
date_default_timezone_set('Asia/Jakarta');
$s = time ();
$tgljam =date("Y-m-d H:i:s",$s);


$deretTop=$_POST['deretTop'];
$deretLos=$_POST['deretLos'];
$deretLos=$_POST['deretLos'];
$deretLos=$_POST['deretLos'];


 $qupd_tankLosAct = mysql_query("UPDATE tb_topp SET toppid = '202',time = '$tgljam',ref = '202',qty_req = '202',tank_asal = '202' WHERE id = '$id'");


//header("location:edit_tanktop.php?token=PTMADS&deretTop=.$deretTop.&deretLos=.$deretLos.");
header("location:page-dashboard.php");

 ?>