<?php 
include 'admin/config.php';
date_default_timezone_set('Asia/Jakarta');
$s = time ();
$tgljam =date("YmdHis",$s);

echo $s; echo "<br>";
$uniqueId= $tgljam.'-'.mt_rand();
echo $uniqueId;echo "<br>";
$start = "TOP";
$start .= $uniqueId;
echo $start;echo "<br>";
 ?>
