  <?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "adisucipto");  
 if(isset($_POST["planid"]))  
 {  
      $query = "SELECT * FROM tb_plan WHERE id = '".$_POST["planid"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 