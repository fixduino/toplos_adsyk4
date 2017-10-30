<?php 
$findme   = '/';
$check = array();
for ($counter = 1; $counter <= 9; $counter++){
    // echo $counter;
    // $check[] = "some value";
    echo  ${"check" . $counter}; echo "<br>";
}

// Iterating through the values
foreach($check as $value) {
    echo $value;echo "<br>";
}
// ${"check" . $counter} = "some value";




$tank1="1234/5457";
$pos = strpos($tank1, $findme);
if ($pos === false) {
    echo "The string '$findme' was not found in the string '$tank1'";
} else {
    echo "The string '$findme' was found in the string '$tank1'";
    echo " and exists at position $pos";
}
echo "<br>";
echo "pertama:";
$target1=substr(($tank1),0,$pos);
echo $target1;
echo "<br>";
echo "kedua:";
$pa1=substr(($tank1),$pos+1,strlen($tank1));
echo $pa1;




$tank2="200/8000";
$pos = strpos($tank2, $findme);
if ($pos === false) {
    echo "The string '$findme' was not found in the string '$tank2'";
} else {
    echo "The string '$findme' was found in the string '$tank2'";
    echo " and exists at position $pos";
}
echo "<br>";
echo "pertama:";
$target2=substr(($tank2),0,$pos);
echo $target2;
echo "<br>";
echo "kedua:";
$pa2=substr(($tank2),$pos+1,strlen($tank2));
echo $pa2;echo "<br>";echo "<br>";

echo "<br>";echo "<br>";echo "<br>";echo "<br>";
for ($x = 0; $x < 7; $x++) {
  // $qcek_tank = mysql_query("SELECT id, DATE_FORMAT(tb_topp.time, '%Y-%m-%d') AS tanggal, SUM(tb_topp.qty_req) AS totaltop 
    // FROM tb_topp 
    // WHERE (DATE(TIME) = CURDATE()-{$x} AND tank_asal='2')");
   
    // $qcek_tank = "SELECT id, DATE_FORMAT(tb_topp.time, '%Y-%m-%d') AS tanggal, SUM(tb_topp.qty_req) AS totaltop 
    // FROM tb_topp 
    // WHERE (DATE(TIME) = CURDATE()-{$x} AND tank_asal='2')";

    // echo $qcek_tank; echo "<br>";
    for ($t = 1; $t < 9; $t++) {
        // echo "The number is: $x <br>";
         // $qupd_tank = mysql_query("UPDATE tb_tank SET patarget = '{$target+$x}',pa = '{$pa+$x}' WHERE id = '{$x}' LIMIT 1;");
         //echo ${"check" . $x}; echo "<br>";
         // $qcek_tank = mysql_query("SELECT id, DATE_FORMAT(tb_topp.time, '%Y-%m-%d') AS tanggal, SUM(tb_topp.qty_req) AS totaltop 
         // FROM tb_topp 
         // WHERE (DATE(TIME) = CURDATE()-{$x} AND tank_asal='2')");
         $qcek_tank = "SELECT id, DATE_FORMAT(tb_topp.time, '%Y-%m-%d') AS tanggal, SUM(tb_topp.qty_req) AS totaltop 
         FROM tb_topp 
         WHERE (DATE(TIME) = CURDATE()-{$x} AND tank_asal={$t})";
         // echo ${"check" . $x}; echo "<br>";
         echo $qcek_tank; echo "<br>";
         $queryCek = mysql_query($qcek_tank);
         if($queryCek!=false){
            $TankMaint="";
                if(isset($tankm[$t])) {
                  $TankMaint .=$tankm[$t].',';
                }
         }
         
     } 

} 


$TankMaint="";
for ($t = 0; $t < 8; $t++)
{
    if(isset($tankm[$t])) {
      $TankMaint .=$tankm[$t].',';
    }
}


 ?>