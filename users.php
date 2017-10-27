<?php
class userClass
{
	 /* User Login */
     public function userLogin($username,$password)
     {

          $db = getDB();
          $hash_password= hash('sha1', $password);
          $stmt = $db->prepare("SELECT id FROM users WHERE  username=:username AND  password=:hash_password");  
          $stmt->bindParam("username", $username,PDO::PARAM_STR) ;
          $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
          $stmt->execute();
          $count=$stmt->rowCount();
          $data=$stmt->fetch(PDO::FETCH_OBJ);
          $db = null;
          if($count)
          {
                $_SESSION['id']=$data->id;
                return true;
          }
          else
          {
               return false;
          }    
     }

     /* User Registration */
     public function userRegistration($username,$password,$type)
     {
          try{
          $db = getDB();
          $st = $db->prepare("SELECT id FROM users WHERE username=:username");  
          $st->bindParam("username", $username,PDO::PARAM_STR);
        //   $st->bindParam("email", $email,PDO::PARAM_STR);
          $st->execute();
          $count=$st->rowCount();
          if($count<1)
          {
          $stmt = $db->prepare("INSERT INTO users(username,password,type,foto) VALUES (:username,:hash_password,:type,:foto)");  
          $stmt->bindParam("username", $username,PDO::PARAM_STR) ;
          $hash_password= hash('sha1', $password);
          $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
        //   $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
          $stmt->bindParam("type", $name,PDO::PARAM_STR) ;
          $stmt->execute();
          $id=$db->lastInsertId();
          $db = null;
          $_SESSION['id']=$id;
          return true;

          }
          else
          {
          $db = null;
          return false;
          }
          
         
          } 
          catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }
     }
     
     /* User Details */
     public function userDetails($uid)
     {
        try{
          $db = getDB();
          $stmt = $db->prepare("SELECT username,foto,type FROM users WHERE id=:id");  
          $stmt->bindParam("id", $uid,PDO::PARAM_INT);
          $stmt->execute();
          $data = $stmt->fetch(PDO::FETCH_OBJ);
          return $data;
         }
         catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}'; 
          }

     }


}
?>