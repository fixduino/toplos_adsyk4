<?php 
include 'admin/config.php';
date_default_timezone_set('Asia/Jakarta');
$s = time ();
$tgljam =date("Y-m-d H:i:s",$s);

$refid=$_POST['refid'];
$koderef=$_POST['koderef'];
$maxcap=$_POST['maxcap'];
$status=$_POST['refstat'];echo $status;
if ($status=="Aktif"){$status="1";} elseif ($status=="Non Aktif"){$status="0";}
$platno="nn";
echo $status;


// $waktu=now();
// mysql_query("insert into tb_loss values('','$tgljam','$ref1','$qtyreq2','$tanktuj3')");

//cari data tanki x
$qcek_tank = mysql_query("select id from tb_ref where id='".$refid."'");
if($qcek_tank!=false){
    // $num=mysql_numrows($qcek_tank);
    // $pumpable=mysql_result($qcek_tank,0,"pa");
    // $new_pa=($pumpable + $qtyreq2) ;
    $qupd_tank = mysql_query("UPDATE tb_ref SET kode = '$koderef', qty='$maxcap', platref='$platno', status='$status' WHERE id = '$refid' LIMIT 1;");
}

// echo $koderef;
// //ubah ke service all first!
// for ($x = 1; $x < 9; $x++) {
// 	$qupd_tank = mysql_query("UPDATE tb_tank SET status = '100' WHERE id = '{$x}' LIMIT 1;");
//   } 
  

header("location:page-dashboard.php");

 ?>