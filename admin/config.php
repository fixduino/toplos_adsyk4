<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
// $username="root";
// $password="";
// $database="pbss";
// $host="localhost";

mysql_connect("localhost","root",""); 
mysql_select_db("adisucipto"); //malasngoding_kios


// $dbh = new PDO("mysql:host=localhost;dbname=pbss;user=root;password=''");

/*$link = mysqli_connect("127.0.0.1", "root", "", "pbss");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

//echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
//echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

mysqli_close($link);
*/
?>