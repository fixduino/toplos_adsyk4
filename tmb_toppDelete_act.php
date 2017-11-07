<?php 
include 'admin/config.php';
date_default_timezone_set('Asia/Jakarta');
$s = time ();
$tgljam =date("Y-m-d H:i:s",$s);


$topId=$_POST['topidnya'];


 $qupd_tankLosAct = mysql_query("DELETE FROM tb_topp  WHERE id = '$topId'");


 //habis delete ,, bailik nilai qty ke pa tb_tank??

//header("location:edit_tanktop.php?token=PTMADS&deretTop=.$deretTop.&deretLos=.$deretLos.");
header("location:page-dashboard.php");
//cek qty nya
// $qcek_qty= mysql_query("select qty_req,tank_asal from tb_topp where id='".$topId."' LIMIT 1");
// if($qcek_user!=false){
//     $qtynya=mysql_result($qcek_qty,0,"qty_req");
//     $tanknya=mysql_result($qcek_qty,0,"tank_asal");
//     echo $qtynya. "...." .$tanknya;
//      $qupd_tank = mysql_query("UPDATE tb_tank SET pa = '$utype', password = '$hash_password' , foto = '$ufoto' WHERE id = '$idnya' LIMIT 1;");
// }
 ?>