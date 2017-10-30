<?php
require_once 'DBConnect.php';
require_once 'users.php';
$userClass = new userClass();

$errorMsgLogin = '';
if(!empty($_POST['loginSubmit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(strlen(trim($username))>1 && strlen(trim($password))>1) {
		$id = $userClass->userLogin($username, $password);
		if($id) {
			$url=BASE_URL.'page-dashboard.php';
			header("Location: $url");
		}else {
			$errorMsgLogin = "Please check Your login details.";
		}
	}
}

?>
<!doctype html>
<html lang="en" class="fullscreen-bg">

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
	}

	.kotak .input-group{
		margin-bottom: 20px;
	}
	.errorMsg{color: #cc0000;margin-bottom: 10px}
	</style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">

		<form method="post" action="" name="login">
		<div class="col-md-4 col-md-offset-4 kotak">
			<div class="panel-heading  text-center" style="padding:15px; background:#fff;"><b>Welcome to Pertamina Adisucipto</b></div>
			<div class="panel-body" style="background: #fff">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input type="text" class="form-control" placeholder="Username" name="username">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					<input type="password" class="form-control" placeholder="Password" name="password">
				</div>
				<div class="input-group">
				<div class="errorMsg"><?php echo $errorMsgLogin; ?></div>			
				<input type="submit" class="btn btn-success" name="loginSubmit" value="Login">
				</div>
				<!-- <label>Don't have account yet ! <a href="sing-up.php">Sign Up</a></label> -->
			</div>
		</div>
		</form> 
			
	</div>
</body>

</html>
