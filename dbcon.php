
<?php
$host="localhost";
$user="root";
$password="";
$database="adisucipto";

$item_per_page = 10;
$connecDB = mysqli_connect($host, $user, $password,$database)or die('could not connect to database'); //for pagination

ini_set('display_errors',FALSE);
$koneksi=mysql_connect($host,$user,$password);
mysql_select_db($database,$koneksi);
//cek koneksi
if($koneksi){
	//echo "berhasil koneksi";
}else{
	echo "gagal koneksi";
}
?>