<!doctype html>
<html lang="en">

<?php
require_once 'DBConnect.php';
require_once 'session.php';

date_default_timezone_set('Asia/Jakarta');
require_once 'tangki.php';
$tangki = new Tangki();
$data = $tangki->getAll();

$refuler = new Tangki();
$dataRef = $refuler->getRefAll();
$bridger = new Tangki();
$dataBrid = $bridger->getBridgerAll();


$planthisday = new Tangki();
$dataPlan = $planthisday->getPlan();


$lossthisday = new Tangki();
$dataLastLoss = $lossthisday->getLastLoss();

// require_once 'topping.php';
// $topping = new Topping();
// $dataAllTop = $topping->getAllTop();

// $lossing = new Topping();
// $dataAllLoss = $lossing->getAllLoss();

include 'admin/config.php';

?>
<head>
	<title>Dashboard | pertamina DPPU Adisucipto</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->

	
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/metisMenu/metisMenu.css">
	<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css">
	<link rel="stylesheet" href="assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css">
	<link rel="stylesheet" type="text/css" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bower_components/datatables.net-buttons-dt/css/buttons.dataTables.min.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/pertamina-minimalis.jpg">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/pertamina-minimalis.jpg">

	<style>
	.input-group-addon.primary {
    color: rgb(255, 255, 255);
    background-color: rgb(50, 118, 177);
    border-color: rgb(40, 94, 142);
}
.input-group-addon.success {
    color: rgb(255, 255, 255);
    background-color: rgb(92, 184, 92);
    border-color: rgb(76, 174, 76);
}
.input-group-addon.info {
    color: rgb(255, 255, 255);
    background-color: rgb(57, 179, 215);
    border-color: rgb(38, 154, 188);
}
.input-group-addon.warning {
    color: rgb(255, 255, 255);
    background-color: rgb(240, 173, 78);
    border-color: rgb(238, 162, 54);
}
.input-group-addon.danger {
    color: rgb(255, 255, 255);
    background-color: rgb(217, 83, 79);
    border-color: rgb(212, 63, 58);
}
	</style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu"></i></button>
				</div>
				<!-- logo -->
				<div class="navbar-brand">
					<a href="page-dashboard.php"><img src="assets/img/logo.png" alt="DiffDash Logo" class="img-responsive logo"></a>
				</div>
				<!-- end logo -->
				<div class="navbar-right">
				<!-- search form -->
				<!--<form id="navbar-search" class="navbar-form search-form">
					<input value="" class="form-control" placeholder="Search here..." type="text">
					<button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
				</form> -->
				<div id="navbar-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="notification-dot"></span>
							</a>
							<ul class="dropdown-menu notifications">
								<li class="header"><strong>You have 7 new notifications</strong></li>
								<li>
									<a href="#">
										<div class="media">
											<div class="media-left">
												<i class="fa fa-fw fa-flag-checkered text-muted"></i>
											</div>
											<div class="media-body">
												<p class="text">Your campaign <strong>Holiday Sale</strong> is starting to engage potential customers.</p>
												<span class="timestamp">24 minutes ago</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="media">
											<div class="media-left">
												<i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
											</div>
											<div class="media-body">
												<p class="text">Campaign <strong>Holiday Sale</strong> is nearly reach budget limit.</p>
												<span class="timestamp">2 hours ago</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="media">
											<div class="media-left">
												<i class="fa fa-fw fa-bar-chart text-muted"></i>
											</div>
											<div class="media-body">
												<p class="text">Website visits from Facebook is 27% higher than last week.</p>
												<span class="timestamp">Yesterday</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="media">
											<div class="media-left">
												<i class="fa fa-fw fa-check-circle text-success"></i>
											</div>
											<div class="media-body">
												<p class="text">Your campaign <strong>Holiday Sale</strong> is approved.</p>
												<span class="timestamp">2 days ago</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="media">
											<div class="media-left">
												<i class="fa fa-fw fa-exclamation-circle text-danger"></i>
											</div>
											<div class="media-body">
												<p class="text">Error on website analytics configurations</p>
												<span class="timestamp">3 days ago</span>
											</div>
										</div>
									</a>
								</li>
								<li class="footer"><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li>
					</ul>
				</div>
					
				<!-- end search form -->
				
			</div>
		
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="left-sidebar" class="sidebar">
			<button type="button" class="btn btn-xs btn-link btn-toggle-fullwidth">
				<span class="sr-only">Toggle Fullwidth</span>
				<i class="fa fa-angle-left"></i>
			</button>
			<div class="sidebar-scroll">
			<div class="user-account">
			<?php 
				$userDetails = $userClass->userDetails($session_id);

				echo '<img src="assets/img/'.$userDetails->foto.'" class="img-responsive img-circle user-photo" alt="User Profile Picture">';
			
			?>

			<div class="dropdown">
				<a href="#" class="dropdown-toggle user-name" data-toggle="dropdown">Hello, <strong><?php echo $userDetails->username; ?></strong> <i class="fa fa-caret-down"></i></a>
				<ul class="dropdown-menu dropdown-menu-right account">
					<li><a href="#">My Profile</a></li>
					<li><a href="#">Settings</a></li>
					<li class="divider"></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
		<nav id="left-sidebar-nav" class="sidebar-nav">
			<ul id="main-menu" class="metismenu">
				<li class="active">
					<a href="page-dashboard.php" class="has-arrow"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
				</li>
				<li class="">
					<a href="page-data-tangki.php" class="has-arrow"><i class="lnr lnr lnr-drop"></i> <span>Tangki</span></a>
				</li>
				<li class="">
					<a href="page-data-top.php" class="has-arrow"><i class="lnr lnr-chart-bars"></i> <span>Topping</span></a>
				</li>
				<?php if ($userDetails->type == 'superuser'){
					echo '<li class="">
					<a href="page-setting.php" class="has-arrow" aria-expanded="false"><i class="lnr lnr-cog"></i> <span>Setting</span></a>
				</li>';
				} ?>
				 <!-- <li class="">
					<a href="page-setting.php" class="has-arrow" aria-expanded="false"><i class="lnr lnr-cog"></i> <span>Setting</span></a>
				</li> -->
			</ul>
		</nav>
				<!-- <div style="padding: 30px; text-align: center;">
					<h2 style="font-size: 16px; margin-bottom: 15px; font-weight: 700;">Other Similar Template</h2>
					<a href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=diffdash&utm_medium=template&utm_campaign=KlorofilPro" target="_blank"><img src="assets/img/klorofilpro.png" class="img-responsive thumbnail" alt=""></a>
					<a href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=diffdash&utm_medium=template&utm_campaign=KlorofilPro" target="_blank" class="btn btn-primary">VIEW DEMO</a>
				</div> -->
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				<div class="section-heading">
					<h1 class="page-title">Setting Tangki dan Planning Hari ini</h1>
				</div>
				<div class="row">
					
                    <div class="col-md-3">
						<div class="panel-content">
							<h2 class="heading"><i class="fa fa-database"></i> Setup Tangki</h2>
							
							<?php
									if (count($data)):
										foreach ($data as $key => $value):
								?>	
								<div class="input-group">
						
								<span class="input-group-addon danger"><?php echo $value['tank'] ?></span>
								<input class="form-control" type="text" value="<?php echo number_format($value['patarget']); echo"/"; echo number_format($value['pa']); ?>" disabled>
								<span class="input-group-addon danger">Liter</span>
								</div>
								<br>
									

								<?php
									endforeach;
								endif;
								?>
							<div class="form-group">
							<span class="help-block">cth. 500/2500</span>
							<span class="help-block"> target sisa 500L, dari Total Pa Actual 2500L.</span>
							</div>
							<div class="input-group">
								<!-- <span class="input-group-addon">T08</span>
								<input class="form-control" type="text">
                                <span class="input-group-addon">Liter</span> -->
								<input type="submit" class="btn btn-info" value="Update" data-toggle="modal" data-target="#myModalPa">
								<!-- <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModalPa" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span></button> -->

                                <!-- <input type="" class="btn btn-primary" value="Create"> -->
							</div>
								
						</div>
                    </div>
                    
                    
                    <div class="col-md-4">
						<div class="panel-content">
							<h2 class="heading"><i class="fa fa-square"></i> Plan this day!</h2>
							<?php
									if (count($dataPlan)):
										foreach ($dataPlan as $key => $value):
								?>		
							
								<div class="input-group">
									<span class="input-group-btn"><button class="btn btn-success" type="button" >Tank Topping</button></span>
									<input class="form-control" type="text" value="<?php echo $value['tanktop'] ?>" disabled>
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn"><button class="btn btn-success" type="button">Tank Lossing</button></span>
									<input class="form-control" type="text" value="<?php echo $value['tanklos'] ?>" disabled>
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn"><button class="btn btn-success" type="button"> Qty Topping (L)</button></span>
									<input class="form-control" type="text" value="<?php echo number_format($value['qtytop']) ?>" disabled>
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn"><button class="btn btn-success" type="button">Qty Lossing (L)</button></span>
									<input class="form-control" type="text" value="<?php echo number_format($value['qtylos']) ?>" disabled>
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn"><button class="btn btn-success" type="button">Tangki Maint.</button></span>
									<input class="form-control" type="text" value="<?php echo $value['tankmaint'] ?>" disabled>
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn"><button class="btn btn-success" type="button">Refuler Maint.</button></span>
									<input class="form-control" type="text" value="<?php echo $value['refmaint'] ?>" disabled>
								</div>
								<br>
								<div class="input-group">
									<input type="submit" class="btn btn-info" value="Update" data-toggle="modal" data-target="#myModalPlan">
									<div class="input-group">
									<!-- <input type="submit" class="btn btn-info" value="Update" data-toggle="modal" data-target="#myModalLos"> -->
									<!-- <input type="submit" class="btn btn-info" value="Update3" data-toggle="modal" data-target="#myModalLoss"> -->
									</div>
								</div>
								<?php
									endforeach;
								endif;
								?>
								
							
										
						</div>
					</div>

					<div class="col-md-4">
						<div class="panel-content">
							<h2 class="heading"><i class="fa fa-square"></i> Input Lossing!</h2>
							<?php
									if (count($dataLastLoss)):
										foreach ($dataLastLoss as $key => $value):
									?>	
								<div class="input-group">
									<span class="input-group-btn"><button class="btn btn-warning" type="button" >Last Update</button></span>
									<input class="form-control" type="text" value="<?php echo $value['time'] ?>" disabled>
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn"><button class="btn btn-warning" type="button" >Quantity</button></span>
									<input name="qty_req" class="form-control" type="text" value="<?php echo number_format($value['qty_req']); echo ' L'; ?>" disabled>
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn"><button class="btn btn-warning" type="button" >Bridger</button></span>
									<input name="brid" class="form-control" type="text" value="<?php echo $value['kodebridnya'] ?>" disabled>
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn"><button class="btn btn-warning" type="button" >Tangki</button></span>
									<input name ="tank_tujuan" class="form-control" type="text" value="<?php echo $value['tangkinya'] ?>" disabled>
								</div>

								<br>
								
								<div class="input-group">
									<!-- <input type="submit" class="btn btn-info" value="Update" data-toggle="modal" data-target="#myModalLos"> -->
									<input type="submit" class="btn btn-info" value="Update" data-toggle="modal" data-target="#myModalLoss">
								</div>
								<?php
									endforeach;
								endif;
								?>	
							
										
						</div>
					</div>

				</div>

				<div class="section-heading">
					<h1 class="page-title">Setting Refuler dan Bridger</h1>
				</div>
				<div class="row">

                    <div class="col-md-3">
						<div class="panel-content">
							<h2 class="heading"><i class="fa fa-truck"></i> Setup Refuler</h2>
							<div class="input-group">
								<input type="submit" class="btn btn-info" value="Update" data-toggle="modal" data-target="#myModalRef">
							</div>
							
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel-content">
							<h2 class="heading"><i class="fa fa-truck"></i> Setup Bridger</h2>
							<div class="input-group">
								<input type="submit" class="btn btn-info" value="Update" data-toggle="modal" data-target="#myModalBridger">
							</div>
							
						</div>
                    </div>

				</div>
			</div>
		</div>
		<!-- END MAIN CONTENT -->

				
<!-- modal Plan this day -->
<div id="myModalPlan" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Plan Hari ini</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_plan_act.php" method="post">
					<div class="form-group">
						<label>Tangki Top</label>
						<input name="deretTop" type="text" class="form-control" placeholder="Deret Tangki Topping Cth. 1-2-3" required="required">
					</div>
					<div class="form-group">
						<label>Tangki Los</label>
						<input name="deretLos" type="text" class="form-control" placeholder="Deret Tangki Lossing Cth. 4-5-6" required="required">
					</div>
					<div class="form-group">
						<label>Qty Top</label>
						<input name="qtyTop" type="text" class="form-control" placeholder="Quantity Topping (L) Cth. 4500" required="required">
					</div>	
					<div class="form-group">
						<label>Qty Los</label>
						<input name="qtyLos" type="text" class="form-control" placeholder="Quantity Lossing (L) Cth. 5600" required="required">
					</div>	
					<!-- <div class="form-group">
						<label>Tangki Maint</label>
						<input name="tankm" type="text" class="form-control" placeholder="Deret Tangki Maintenance Cth. 6,7">
					</div>																	 -->
					<!-- <div class="form-group">
						<label>Refuler Maint</label>
						<input name="refm" type="text" class="form-control" placeholder="Deret Refuler Maintenance Cth. 3,4">
					</div>	 -->
					<div class="form-group">
						<label>Tangki Maint</label>
							<div class="form-group">
							<select id="multiselect2" name="tankm" class="multiselect multiselect-custom" multiple="multiple" required="required">
								<?php if (count($data)):
									 	$i = 0;
									 	foreach ($data as $key => $value):
									?>
								
									<option> <?php echo $value['tank']?></option>
								<?php
								if($i++ == 7) break;
									endforeach;
								endif;
								?>	
								</select>
							</div>	
					</div>	
					<div class="form-group">
						<label>Refuler Maint</label>
							<div class="form-group">
							<select id="multiselect1" name="refm" class="multiselect multiselect-custom" multiple="multiple" required="required">
								<?php if (count($dataRef)):
									 	$i = 0;
									 	foreach ($dataRef as $key => $value):
									?>
								
									<option> <?php echo $value['kode']?></option>
								<?php
								if($i++ == 15) break;
									endforeach;
								endif;
								?>	
								</select>
							</div>	
					</div>	

								<!-- <select id="multiselect2" name="multiselect2[]" class="multiselect multiselect-custom" multiple="multiple">
										<option value="cheese">Cheese</option>
										<option value="tomatoes">Tomatoes</option>
										<option value="mozarella">Mozzarella</option>
										<option value="mushrooms">Mushrooms</option>
										<option value="pepperoni">Pepperoni</option>
										<option value="onions">Onions</option>option value="cheese">Cheese</option>
										<option value="tomatoes2">Tomatoes2</option>
										<option value="mozarella2">Mozzarella2</option>
										<option value="mushrooms2">Mushrooms2</option>
										<option value="pepperoni2">Pepperoni2</option>
										<option value="onions2">Onions2</option>
									</select> -->
				
					<!-- <div class="form-group">
						<select id="multiselect-color" name="multiselect9[]" class="multiselect multiselect-custom" multiple="multiple">
								<option value="cheese">Cheese</option>
								<option value="tomatoes">Tomatoes</option>
								<option value="mozarella">Mozzarella</option>
						</select>	
					</div>	 -->
																			

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

<!-- modal input -->
<div id="myModalPa" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Setting Pumpable Tangki</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_pumpable_act.php" method="post">
					<div class="panel-content">
						<h2 class="heading"><i class="fa fa-database"></i> Setup Tangki</h2>
						
						<?php
								if (count($data)):
									foreach ($data as $key => $value):
							?>	
							<div class="input-group">
					
							<span class="input-group-addon danger"><?php echo $value['tank'] ?></span>
							<input name="tank<?php echo $value['id'];?>" class="form-control" type="text" value="<?php echo number_format($value['patarget']); echo"/"; echo number_format($value['pa']); ?>" required="required">
							<span class="input-group-addon danger">Liter</span>
							</div>
							<br>
							<?php 
								endforeach;
							endif;
							?>

						<div class="form-group">
						<span class="help-block">cth. 500/2500</span>
						<span class="help-block"> sisa 500L, dari Total Pa 2500L.</span>
						</div>
						<div class="input-group">
							<!-- <span class="input-group-addon">T08</span>
							<input class="form-control" type="text">
							<span class="input-group-addon">Liter</span> -->
							<!-- <input type="submit" class="btn btn-info" value="Update" data-toggle="modal" data-target="#myModalPa"> -->
							<!-- <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModalPa" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span></button> -->

							<!-- <input type="" class="btn btn-primary" value="Create"> -->
						</div>
						
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
	

<div id="myModalLoss" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Input Lossing Hari ini</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_loss_act.php" method="post">
					
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-warning" type="button" >Quantity</button></span>
						<input name="qty_req" class="form-control" type="text" placeholder="Masukkan Quantity Lossing (L) cth. 2400" required="required">
					</div>
					<br>
					<div class="input-group">
						<!-- <span class="input-group-btn"><button class="btn btn-warning" type="button" >Bridger</button></span> -->
						<!-- <input name="brid" class="form-control" type="text" placeholder="Masukkan id Bridger cth. 1" require> -->
						<span class="input-group-btn"><button class="btn btn-warning" type="button" >Bridger </button></span>
						<!-- <input name="refid" class="form-control" type="text" placeholder="Masukkan id Bridger cth. 1" > -->
						
						<select class="form-control" name="brid" required="required">
								<?php if (count($dataBrid)):
										$i = 0;
										foreach ($dataBrid as $key => $value):
									?>
								
									<option> <?php echo $value['kode']?></option>
								<?php
								if($i++ == 15) break;
									endforeach;
								endif;
								?>	
						</select>
					</div>
					<br>
					<!-- <div class="input-group">
						<span class="input-group-btn"><button class="btn btn-warning" type="button" >Tangki</button></span>
						<input name ="tank_tujuan" class="form-control" type="text" placeholder="Masukkan id Tangki Timbun Tujuan  cth. 3" require>
					</div>
					<br> -->
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-warning" type="button" >Tangki </button></span>
						<!-- <input name="refid" class="form-control" type="text" placeholder="Masukkan id Refuler cth. 1" > -->
						
						<select class="form-control" name="tank_tujuan" required="required">
								<?php if (count($data)):
										$i = 0;
										foreach ($data as $key => $value):
									?>
								
									<option> <?php echo $value['tank']?></option>
								<?php
								if($i++ == 7) break;
									endforeach;
								endif;
								?>	
						</select>
					</div>
					<br>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="myModalRef" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Setting Refuler</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_ref_act.php" method="post">
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-info" type="button" >Refuler Id</button></span>
						<!-- <input name="refid" class="form-control" type="text" placeholder="Masukkan id Refuler cth. 1" > -->
						
						<select class="form-control" name="refid" required="required">
								<?php if (count($dataRef)):
									 	$i = 0;
									 	foreach ($dataRef as $key => $value):
									?>
								
									<option> <?php echo $value['id']?></option>
								<?php
								if($i++ == 15) break;
									endforeach;
								endif;
								?>	
								</select>
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-info" type="button" >Kode</button></span>
						<input name="koderef" class="form-control" type="text" placeholder="Masukkan Kode Refuler cth. ADS.01" required="required">
					</div>

					<br>
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-info" type="button" >Max Capacity</button></span>
						<input name ="maxcap" class="form-control" type="text" placeholder="Masukkan Kapasitas Maksimum (L) cth. 16000" required="required">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-info" type="button" >Status</button></span>
						<!-- <input name ="maxcap" class="form-control" type="text" placeholder="Masukkan Kapasitas Maksimum (L) cth. 16000" > -->
						<select class="form-control" name="refstat" required="required">
                        	<option>Aktif</option>
                        	<option>Non Aktif</option>
                    	</select>
					</div>
					
					<!-- <div class="input-group">
						<span class="input-group-btn"><button class="btn btn-info" type="button" >Plat Nomor</button></span>
						<input name ="platno" class="form-control" type="text" placeholder="Masukkan Plat Nomor  cth. AB 1234 CD" >
					</div>
					<br> -->
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="submit" class="btn btn-primary" value="Simpan" >
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="myModalBridger" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Setting Bridger</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_bridger_act.php" method="post">
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-info" type="button" >Bridger Id</button></span>
						<!-- <input name="refid" class="form-control" type="text" placeholder="Masukkan id Refuler cth. 1" > -->
						
						<select class="form-control" name="bridid" required="required">
								<?php if (count($dataBrid)):
										$i = 0;
										foreach ($dataBrid as $key => $value):
									?>
								
									<option> <?php echo $value['id']?></option>
								<?php
								if($i++ == 15) break;
									endforeach;
								endif;
								?>	
								</select>
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-info" type="button" >Kode</button></span>
						<input name="kodebridger" class="form-control" type="text" placeholder="Masukkan Kode Bridger cth. BRID.01" required="required">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-info" type="button" >Max Capacity</button></span>
						<input name ="maxcap" class="form-control" type="text" placeholder="Masukkan Kapasitas Maksimum (L) cth. 16000" required="required">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-info" type="button" >Plat Nomor</button></span>
						<input name ="platno" class="form-control" type="text" placeholder="Masukkan Plat Nomor  cth. AB 1234 CD" required="required">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-btn"><button class="btn btn-info" type="button" >Status</button></span>
						<!-- <input name ="maxcap" class="form-control" type="text" placeholder="Masukkan Kapasitas Maksimum (L) cth. 16000" > -->
						<select class="form-control" name="bridstat" required="required">
                        	<option>Aktif</option>
                        	<option>Non Aktif</option>
                    	</select>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- END BOOTSTRAP PROGRESS BARS -->
                        <!-- example
                    
                        <div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-primary" type="button">Go!</button>
								</span>
								<input class="form-control" type="text">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input class="form-control" placeholder="Username" type="text">
							</div>
							<br>
							<div class="input-group">
								<input class="form-control" placeholder="Username" type="text">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon">T01</span>
								<input class="form-control" type="text">
								<span class="input-group-addon">Liter</span>
                            </div>
                            <br>
							<div class="input-group">
								<span class="input-group-addon">T02</span>
								<input class="form-control" type="text">
								<span class="input-group-addon">Liter</span>
                            </div>
                            <br>
							<div class="input-group">
								<span class="input-group-addon">T03</span>
								<input class="form-control" type="text">
								<span class="input-group-addon">Liter</span>
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon">@</span>
								<input type="text" class="form-control" placeholder="Username">
							</div>
							<br>
							<div class="input-group">
								<input type="text" class="form-control">
								<span class="input-group-addon">.00</span>
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control">
								<span class="input-group-addon">.00</span>
							</div>
							<br>
							<div class="input-group">
								<input type="text" class="form-control">
								<span class="input-group-btn"><button class="btn btn-default" type="button">Go!</button></span>
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon">
						<label class="fancy-checkbox">
							<input type="checkbox"><span></span>
								</label>
								</span>
								<input type="text" class="form-control">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon">
						        <label class="fancy-checkbox custom-color-green">
							<input type="checkbox" checked>
							<span></span>
								</label>
								</span>
								<input type="text" class="form-control">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon">
						        <label class="fancy-checkbox custom-bgcolor-green">
							    <input type="checkbox" checked>
							    <span></span>
								</label>
								</span>
								<input type="text" class="form-control">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go!</button>
                                </span>
								<input type="text" class="form-control">
							</div>
                    -->
					



		<div class="clearfix"></div>
		<footer>
			<p class="copyright">&copy; 2017 <a href="#" target="_blank">Pertamina</a>. All Rights Reserved.</p>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/metisMenu/metisMenu.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
	<script src="assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js"></script>
	<script src="assets/scripts/common.js"></script>
	
	<script>
	$(function() {
		$('#progress-format1 .progress-bar').progressbar({
			display_text: 'fill'
		});

		$('#progress-format2 .progress-bar').progressbar({
			display_text: 'fill',
			use_percentage: false
		});

		$('#progress-custom-format .progress-bar').progressbar({
			display_text: 'fill',
			use_percentage: false,
			amount_format: function(p, t) {
				return p + ' of ' + t;
			}
		});

		$('#progress-striped .progress-bar, #progress-striped-active .progress-bar, #progress-stacked .progress-bar').progressbar({
			display_text: 'fill'
		});

		$('.progress.vertical .progress-bar').progressbar();
		$('.progress.vertical.wide .progress-bar').progressbar({
			display_text: 'fill'
		});

	});
	</script>
	<script type="text/javascript" language="javascript" src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	
	
	<script type="text/javascript" language="javascript" src="bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="bower_components/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="bower_components/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script type="text/javascript" language="javascript" src="bower_components/datatables.net-buttons/js/buttons.colVis.min.js"></script>  
	<script type="text/javascript" language="javascript" src="bower_components/datatables.net-buttons/js/buttons.print.min.js"></script> 
	<script type="text/javascript" language="javascript" src="bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="http://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	
	
	<script>
		$(document).ready(function() {
			$('#display-tangki').dataTable({
				dom: 'Bfrtip',
				buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					{
						extend: 'pdfHtml5',
						download: 'open',
						message: 'PDF created by PDFMake with Buttons for DataTables.'
					}
				]
			});
		});

	</script>

<script>
	$(function() {

		// Masked Inputs
		$('#phone').mask('(999) 999-9999');
		$('#phone-ex').mask('(999) 999-9999? x99999');
		$('#tax-id').mask('99-9999999');
		$('#ssn').mask('999-99-9999');
		$('#product-key').mask('a*-999-a999');


		// Multiselect
		$('#multiselect1, #multiselect2, #single-selection, #multiselect5, #multiselect6').multiselect({
			maxHeight: 300
		});

		$('#multiselect3-all').multiselect({
			includeSelectAllOption: true,
		});

		$('#multiselect4-filter').multiselect({
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			maxHeight: 200
		});

		$('#multiselect-size').multiselect({
			buttonClass: 'btn btn-default btn-sm'
		});

		$('#multiselect-link').multiselect({
			buttonClass: 'btn btn-link'
		});

		$('#multiselect-color').multiselect({
			buttonClass: 'btn btn-primary'
		});

		$('#multiselect-color2').multiselect({
			buttonClass: 'btn btn-success'
		});


		// Date picker
		$('.inline-datepicker').datepicker({
			todayHighlight: true
		});

	});
	</script>




<!-- Javascript -->
<!-- <script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/metisMenu/metisMenu.js"></script>
<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/scripts/common.js"></script> -->
<script>
$(function() {

	// Masked Inputs
	$('#phone').mask('(999) 999-9999');
	$('#phone-ex').mask('(999) 999-9999? x99999');
	$('#tax-id').mask('99-9999999');
	$('#ssn').mask('999-99-9999');
	$('#product-key').mask('a*-999-a999');


	// Multiselect
	$('#multiselect1, #multiselect2, #single-selection, #multiselect5, #multiselect6').multiselect({
		maxHeight: 300
	});

	$('#multiselect3-all').multiselect({
		includeSelectAllOption: true,
	});

	$('#multiselect4-filter').multiselect({
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		maxHeight: 200
	});

	$('#multiselect-size').multiselect({
		buttonClass: 'btn btn-default btn-sm'
	});

	$('#multiselect-link').multiselect({
		buttonClass: 'btn btn-link'
	});

	$('#multiselect-color').multiselect({
		buttonClass: 'btn btn-primary'
	});

	$('#multiselect-color2').multiselect({
		buttonClass: 'btn btn-success'
	});


	// Date picker
	$('.inline-datepicker').datepicker({
		todayHighlight: true
	});

});
</script>
</body>

</html>
