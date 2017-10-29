<?php 
include 'admin/config.php';
date_default_timezone_set('Asia/Jakarta');
$s = time ();
$tgljam =date("Y-m-d H:i:s",$s);


$deretTop=$_POST['deretTop'];
$deretLos=$_POST['deretLos'];

// echo  $tankm;echo  $tankm;echo  "....";
// // $waktu=now();
// mysql_query("insert into tb_plan values('','$planid','$deretTop','$qtyTop','$deretLos','$qtyLos','$tgljam','$tankm','$refm')");

//ubah ke service all first!
for ($x = 1; $x < 9; $x++) {
	$qupd_tank = mysql_query("UPDATE tb_tank SET status = '100' WHERE id = '{$x}' LIMIT 1;");
  } 
  
//tank top
 $d = explode("-", $deretTop);
 foreach($d as $no) {
   $qupd_tank = mysql_query("UPDATE tb_tank SET status = '101' WHERE id = '{$no}' LIMIT 1;");
 }
 $qupd_tankTopAct = mysql_query("UPDATE tb_tank SET status = '201' WHERE id = '$d[0]'");

//tank Los
$d2 = explode("-", $deretLos);
 foreach($d2 as $nom) {
   $qupd_tank2 = mysql_query("UPDATE tb_tank SET status = '102' WHERE id = '{$nom}' LIMIT 1;");
 }
 $qupd_tankLosAct = mysql_query("UPDATE tb_tank SET status = '202' WHERE id = '$d2[0]'");


//header("location:edit_tanktop.php?token=PTMADS&deretTop=.$deretTop.&deretLos=.$deretLos.");
header("location:page-dashboard.php");

 ?>