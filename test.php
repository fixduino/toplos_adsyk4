<?php 
$findme   = '/';
$check = array();
for ($counter = 1; $counter <= 9; $counter++){
    // echo $counter;
    // $check[] = "some value";
    ${"check" . $counter}; echo "<br>";
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

for ($x = 1; $x < 3; $x++) {
    echo "The number is: $x <br>";
	// $qupd_tank = mysql_query("UPDATE tb_tank SET patarget = '{$target+$x}',pa = '{$pa+$x}' WHERE id = '{$x}' LIMIT 1;");
    echo ${"check" . $x}; echo "<br>";
} 


$deretTankMaint  = "1,2,3,17,10";
$totalkoma=substr_count($deretTankMaint,",");
$pieces = explode(",", $deretTankMaint);
echo $totalkoma; // piece1

for ($x = 0; $x < $totalkoma+1; $x++) {
    echo $pieces[$x]; 
    echo "<br>"; 
} 

// echo $pieces[0]; // piece1
// echo $pieces[1]; // piece2
// echo $pieces[2]; // piece2
// echo $pieces[3]; // piece2
// echo $pieces[4]; // piece2

// Example 2
// $data = "foo:*:1023:1000::/home/foo:/bin/sh";
// list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
// echo $user; // foo
// echo $pass; // *




 ?>