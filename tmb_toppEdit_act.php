<?php 
include 'admin/config.php';
date_default_timezone_set('Asia/Jakarta');
$s = time ();
$tgljam =date("Y-m-d H:i:s",$s);


$topid=$_POST['topid2'];
$refid=$_POST['refid2'];
$tankid=$_POST['tankid2'];
$topqty=$_POST['topqty2'];
$qcek_refid= mysql_query("select tb_ref.* from tb_ref where kode='".$refid."' limit 1");
if ($qcek_refid!=false){
    $refidx=mysql_result($qcek_refid,0,"id");
}


$qcek_tankid= mysql_query("select tb_tank.* from tb_tank where tank='".$tankid."' limit 1");
if ($qcek_tankid!=false){
        $tankidx=mysql_result($qcek_tankid,0,"id");
}

$qcek_topid= mysql_query("select tb_topp.* from tb_topp where id='".$topid."' limit 1");
if($qcek_topid!=false){
    $idx=mysql_result($qcek_topid,0,"id");
   $qupd_topp = mysql_query("UPDATE tb_topp SET time='$tgljam', ref = '$refidx', qty_req = '$topqty' , tank_asal = '$tankidx' WHERE id = '$idx' LIMIT 1;");
}

// echo $refidx;   echo "<br>";    echo $tankidx;  echo $idx;
//  $qupd_tankLosAct = mysql_query("UPDATE tb_topp SET toppid = '202',time = '$tgljam',ref = '202',qty_req = '202',tank_asal = '202' WHERE id = '$id'");


//header("location:edit_tanktop.php?token=PTMADS&deretTop=.$deretTop.&deretLos=.$deretLos.");
header("location:page-data-top.php");

 ?>