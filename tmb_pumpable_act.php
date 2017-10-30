<?php 
include 'admin/config.php';
date_default_timezone_set('Asia/Jakarta');
$s = time ();
$tgljam =date("Y-m-d H:i:s",$s);
$findme   = '/';

$tank1=$_POST['tank1'];
// $tank1="12345/6789";
$pos = strpos($tank1, $findme);
// if ($pos === false) {
//     echo "The string '$findme' was not found in the string '$mystring'";
// } else {
//     echo "The string '$findme' was found in the string '$mystring'";
//     echo " and exists at position $pos";
// }
$target1=substr(($tank1),0,$pos);
$pa1=substr(($tank1),$pos+1,strlen($tank1));

$tank2=$_POST['tank2'];
$pos = strpos($tank2, $findme);
$target2=substr(($tank2),0,$pos);
$pa2=substr(($tank2),$pos+1,strlen($tank2));

$tank3=$_POST['tank3'];
$pos = strpos($tank3, $findme);
$target3=substr(($tank3),0,$pos);
$pa3=substr(($tank3),$pos+1,strlen($tank3));

$tank4=$_POST['tank4'];
$pos = strpos($tank4, $findme);
$target4=substr(($tank4),0,$pos);
$pa4=substr(($tank4),$pos+1,strlen($tank4));

$tank5=$_POST['tank5'];
$pos = strpos($tank5, $findme);
$target5=substr(($tank5),0,$pos);
$pa5=substr(($tank5),$pos+1,strlen($tank5));

$tank6=$_POST['tank6'];
$pos = strpos($tank6, $findme);
$target6=substr(($tank6),0,$pos);
$pa6=substr(($tank6),$pos+1,strlen($tank6));

$tank7=$_POST['tank7'];
$pos = strpos($tank7, $findme);
$target7=substr(($tank7),0,$pos);
$pa7=substr(($tank7),$pos+1,strlen($tank7));

$tank8=$_POST['tank8'];
$pos = strpos($tank8, $findme);
$target8=substr(($tank8),0,$pos);
$pa8=substr(($tank8),$pos+1,strlen($tank8));


$qupd_tank1 = mysql_query("UPDATE tb_tank SET patarget = '$target1',pa = '$pa1' WHERE id = '1' LIMIT 1;");
$qupd_tank2 = mysql_query("UPDATE tb_tank SET patarget = '$target2',pa = '$pa2' WHERE id = '2' LIMIT 1;");
$qupd_tank3 = mysql_query("UPDATE tb_tank SET patarget = '$target3',pa = '$pa3' WHERE id = '3' LIMIT 1;");
$qupd_tank4 = mysql_query("UPDATE tb_tank SET patarget = '$target4',pa = '$pa4' WHERE id = '4' LIMIT 1;");
$qupd_tank5 = mysql_query("UPDATE tb_tank SET patarget = '$target5',pa = '$pa5' WHERE id = '5' LIMIT 1;");
$qupd_tank6 = mysql_query("UPDATE tb_tank SET patarget = '$target6',pa = '$pa6' WHERE id = '6' LIMIT 1;");
$qupd_tank7 = mysql_query("UPDATE tb_tank SET patarget = '$target7',pa = '$pa7' WHERE id = '7' LIMIT 1;");
$qupd_tank8 = mysql_query("UPDATE tb_tank SET patarget = '$target8',pa = '$pa8' WHERE id = '8' LIMIT 1;");


$target="";
// if(isset($tankm[$t])) {
//   $TankMaint .=$tankm[$t].',';
// }
for ($x = 1; $x < 9; $x++) {
	// $qupd_tank1 = mysql_query("UPDATE tb_tank SET patarget = ${'target' . $x}, pa = ${'pa' . $x} WHERE id = {$x} LIMIT 1;");
	//echo $target .= $tankx[$x].',';

	
	//$qupd_tank = mysql_query("UPDATE tb_tank SET patarget = '{$target+$x}',pa = '{$pa+$x}' WHERE id = '{$x}' LIMIT 1;");
	} 

//  $d = explode("-", $deretTop);
//  foreach($d as $no) {
//    $qupd_tank = mysql_query("UPDATE tb_tank SET status = '101' WHERE id = '{$no}' LIMIT 1;");
//  }

// $d2 = explode("-", $deretLos);
//  foreach($d2 as $nom) {
//    $qupd_tank2 = mysql_query("UPDATE tb_tank SET status = '102' WHERE id = '{$nom}' LIMIT 1;");
//  }
		
//  $qupd_tank = mysql_query("UPDATE tb_tank SET status = '201' WHERE id = '$d[0]'");
//  $qupd_tank2 = mysql_query("UPDATE tb_tank SET status = '202' WHERE id = '$d2[0]'");

//header("location:edit_tanktop.php?token=PTMADS&deretTop=.$deretTop.&deretLos=.$deretLos.");



header("location:page-dashboard.php");

 ?>