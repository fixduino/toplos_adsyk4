<?php 
include 'admin/config.php';
date_default_timezone_set('Asia/Jakarta');
$s = time ();
$tgljam =date("Y-m-d H:i:s",$s);

$start = 'PTMADS';
$characters = array_merge(range('0','9')); //range('A','Z'), 
for ($i = 0; $i < 6; $i++) {
  $rand = mt_rand(0, count($characters)-1);
  $start .= $characters[$rand];
}
// echo $start;

$planid=$start;

$deretTop=$_POST['deretTop'];
$deretLos=$_POST['deretLos'];
$qtyTop=$_POST['qtyTop'];
$qtyLos=$_POST['qtyLos'];

$tankm=$_POST['tankm'];
$refm=$_POST['refm'];

// loop cek tankm;
$TankMaint="";
for ($t = 0; $t < 8; $t++)
{
    if(isset($tankm[$t])) {
      $TankMaint .=$tankm[$t].',';
    }
}
$TankMaint= substr($TankMaint, 0, strlen($TankMaint) - 1);
echo  $TankMaint;

// loop cek refm;
$RefMaint="";
for ($t = 0; $t < 16; $t++)
{
    if(isset($refm[$t])) {
        $RefMaint .=$refm[$t].',';
      }
}
$RefMaint= substr($RefMaint, 0, strlen($RefMaint) - 1);
// echo  $RefMaint;

mysql_query("insert into tb_plan values('','$planid','$deretTop','$qtyTop','$deretLos','$qtyLos','$tgljam','$TankMaint','$RefMaint')");

//set tank idle all first! idle=100, 
for ($x = 1; $x < 9; $x++) {
	$qupd_tank = mysql_query("UPDATE tb_tank SET status = '100' WHERE id = '{$x}' LIMIT 1;");
  } 
//tank top
 $d = explode("-", $deretTop);
 foreach($d as $no) {
   $qupd_tank = mysql_query("UPDATE tb_tank SET status = '101' WHERE id = '{$no}' LIMIT 1;");
 }
 //tank activ top
$qupd_tankTopAct = mysql_query("UPDATE tb_tank SET status = '201' WHERE id = '$d[0]'");


//tank Los
$d2 = explode("-", $deretLos);
 foreach($d2 as $nom) {
   $qupd_tank2 = mysql_query("UPDATE tb_tank SET status = '102' WHERE id = '{$nom}' LIMIT 1;");
 }
//tank Activ Los
$qupd_tankLosAct = mysql_query("UPDATE tb_tank SET status = '202' WHERE id = '$d2[0]'");

//tank maintenance update tb_tank to 99=maintenance
$deretTankMaint  = $TankMaint;
$totalkoma=substr_count($deretTankMaint,",");
$pieces = explode(",", $deretTankMaint);
for ($x = 0; $x < $totalkoma+1; $x++) {
  echo  $pieces[$x];
    $qupd_tankM = mysql_query("UPDATE tb_tank SET status = '99' WHERE tank = '$pieces[$x]'");
} 


//set ref active all
for ($x = 1; $x < 16; $x++) {
$qupd_tank = mysql_query("UPDATE tb_ref SET status = '1' WHERE id = '{$x}' LIMIT 1;");
} 
//Ref maintenance update tb_ref to 0=maintenance
$deretRefMaint  = $RefMaint;
$totalKomaR=substr_count($deretRefMaint,",");
$refu = explode(",", $deretRefMaint);
for ($r = 0; $r < $totalKomaR+1; $r++) {
    $qupd_RefuM = mysql_query("UPDATE tb_ref SET status = '0' WHERE kode = '$refu[$r]'");
} 

//header("location:edit_tanktop.php?token=PTMADS&deretTop=.$deretTop.&deretLos=.$deretLos.");
header("location:page-dashboard.php");

 ?>