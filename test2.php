<?php 
include 'admin/config.php';
date_default_timezone_set('Asia/Jakarta');
require_once 'DBConnect.php';
// require_once 'tangki.php';
require_once 'topping.php';
require_once 'tangki.php';
$dataTangki = new Tangki();
$data = $dataTangki->getAll();

if (count($data)):
    foreach ($data as $key => $value):
        echo $value['pa'];
    endforeach;
endif;

$qcek_tank = mysql_query("select pa,tank from tb_tank");
if($qcek_tank!=false){
    $num=mysql_numrows($qcek_tank);
    $pa1=mysql_result($qcek_tank,0,"pa");
    $pa2=mysql_result($qcek_tank,1,"pa");
    $pa3=mysql_result($qcek_tank,2,"pa");
    $pa4=mysql_result($qcek_tank,3,"pa");
    $pa5=mysql_result($qcek_tank,4,"pa");
    $pa6=mysql_result($qcek_tank,5,"pa");
    $pa7=mysql_result($qcek_tank,6,"pa");
    $pa8=mysql_result($qcek_tank,7,"pa");

    $t1=mysql_result($qcek_tank,0,"tank");
    $t2=mysql_result($qcek_tank,1,"tank");
    $t3=mysql_result($qcek_tank,2,"tank");
    $t4=mysql_result($qcek_tank,3,"tank");
    $t5=mysql_result($qcek_tank,4,"tank");
    $t6=mysql_result($qcek_tank,5,"tank");
    $t7=mysql_result($qcek_tank,6,"tank");
    $t8=mysql_result($qcek_tank,7,"tank");
    
}
echo "<br>";
 echo $pa1 ; echo "<br>";
 echo $pa2 ; echo "<br>";
 echo $pa3 ; echo "<br>";
 echo $pa4 ; echo "<br>";
 echo $pa5 ; echo "<br>";
 echo $pa6 ; echo "<br>";
 echo $pa7 ; echo "<br>";
 echo $pa8 ; echo "<br>";

 echo $t1 ; echo "<br>";
 echo $t2 ; echo "<br>";
 echo $t3 ; echo "<br>";
 echo $t4 ; echo "<br>";
 echo $t5 ; echo "<br>";
 echo $t6 ; echo "<br>";
 echo $t7 ; echo "<br>";
 echo $t8 ; echo "<br>";
 
?>


