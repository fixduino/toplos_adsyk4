<?php
require_once 'DBConnect.php';
require_once 'users.php';
$userClass = new userClass();

$errorMsgReg = '';
if (!empty($_POST['signupSubmit'])) 
{

	$username=$_POST['username'];
	$type=$_POST['type'];
	$password=$_POST['password'];
	$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
	$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);

	if($username_check && $password_check) 
	{
    $id=$userClass->userRegistration($username,$password,$type);
    if($id)
    {
    	$url=BASE_URL.'page-dashboard.php';
        header("Location: $url");
    }
    else
    {
      $errorMsgReg .= "Username already exits.";
    }
    
	}


}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Pertamina DPPU Adisucipto</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<!-- MAIN CSS -->
<link rel="stylesheet" href="assets/css/main.css">
<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
<link rel="stylesheet" href="assets/css/demo.css">
<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
<!-- ICONS -->
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon.png">
<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
<style type="text/css">
	 body { 
		 /*background: #CD382D; cloud2 twinkle_twinkle_@2X.png*/
	  background-image: url("./assets/img/refuler.jpeg");
	  background-size: 100%;
    /*background-color: #018AFE;*/
	 }
	.kotak{	
		margin-top: 150px;
        background-color: #FFFFFF;
	}

	.kotak .input-group{
		margin-bottom: 20px;
	}
	.errorMsg{color: #cc0000;margin-bottom: 10px}
	</style>
</head>
<body>
<div id="wrapper">
        <form method="post" name="register" action="">
        <div class="col-md-4 col-md-offset-4 kotak">
            <h2>Sign up.</h2><hr />
            <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Enter Username"  />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="type" placeholder="Enter user type" />
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="password" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <input type="submit" class="btn btn-success" name="signupSubmit" value="SignUp">
            </div>
            <br />
            <label>have an account ! <a href="index.php">Sign In</a></label>
        </div>
        </form>
</div>

</body>
</html>