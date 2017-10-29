
<!doctype html>
<html lang="en">
<?php
require_once 'DBConnect.php';
require_once 'session.php';
include '/admin/config.php';
date_default_timezone_set('Asia/Jakarta');
// require_once 'DBConnect.php';
// require_once 'tangki.php';
require_once 'topping.php';
require_once 'tangki.php';
$topping = new Topping();
$dataRecentTop = $topping->get4();

$topA = new Topping();
$dataTopActive = $topA ->getTopActive();

$topB = new Topping();
$dataTopLain = $topB ->getTopLain();

$losC = new Topping();
$dataLosActive = $losC ->getLosActive();

$losD = new Topping();
$dataLosLain = $losD ->getLosLain();


$totalTopE = new Topping();
$dataTotalTop = $totalTopE ->getTotalTop();

$totalLosF = new Topping();
$dataTotalLos = $totalLosF ->getTotalLos();

// $totalTopE = new Topping();
// $dataTotalTop = $topping->getTotalTop();

$planthisday = new Tangki();
$dataPlan = $planthisday->getPlan();

$dataTangki = new Tangki();
$data = $dataTangki->getAll();

$tankMaint = new Topping();
$dataTotalTankM = $tankMaint->getTotalTankM();
$refMaint = new Topping();
$dataTotalRefM = $refMaint->getTotalRefM();
$ullage = new Topping();
$dataTotalUllage = $ullage->getTotalUllage();

?>

<head>
	<title>Pertamina DPPU Adisucipto</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/metisMenu/metisMenu.css">
	<link rel="stylesheet" href="assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist.min.css">
	<link rel="stylesheet" href="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
	<link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">
	<link rel="stylesheet" type="text/css" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/pertamina-minimalis.jpg">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/pertamina-minimalis.jpg">
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
					<a href="page-dashboard.php"><img src="assets/img/pertamina.svg" alt="pertamina Logo" class="img-responsive logo"></a>
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
								<ul id='Jumlah' class="dropdown-menu notifications">
									<!-- <li class="header"><strong>You have 7 new notifications</strong></li>
									<li>
										<a href="#">
											<div class="media">
												<div class="media-left">
													<i class="fa fa-fw fa-info-circle text-danger"></i>
												</div>
												<div class="media-body">
													<p class="text">Error on website analytics configurations</p>
													<span class="timestamp">3 days ago</span>
												</div>
											</div>
										</a>
									</li> -->
									<!-- <li id="">
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
									</li> -->
									<!-- <div style='padding:0px' class='alert alert-default'  id='Jumlah'><span class='glyphicon glyphicon-info-sign'>Info Alert</span></div>	 -->

									<!-- <li>
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
									</li> -->

									<!-- <li>
										<a href="#">
											<div class="media">
												<div class="media-left">
													<i class="fa fa-fw fa-info-circle text-danger"></i>
												</div>
												<div class="media-body">
													<p class="text">Error on website analytics configurations</p>
													<span class="timestamp">3 days ago</span>
												</div>
											</div>
										</a>
									</li> -->
									<!-- <input type="submit" class="btn btn-info" value="Update" data-toggle="modal" data-target="#myModalSetTopLos"> -->
									<!-- <li class="footer"><a href="page-setting.php" class="more">Setting Ulang</a></li> -->
									<li class="footer"><a href="#" data-toggle="modal" data-target="#myModalSetTopLos" class="more">Setting Ulang</a></li>
								</ul>
							</li>
						</ul>
					</div>
						
					<!-- end search form -->
					
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR   style="background-color:#0071BC;" -->
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
						<?php 
							if ($userDetails->type == 'superuser'){
							echo '<li class="">
							<a href="page-setting.php" class="has-arrow" aria-expanded="false"><i class="lnr lnr-cog"></i> <span>Setting</span></a>
						</li>';
						} ?>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				<h1 class="sr-only">Dashboard</h1>
				<!-- WEBSITE ANALYTICS -->
				<div class="dashboard-section">
					<div class="section-heading clearfix">
						<h2 class="section-title"><i class="fa fa-pie-chart"></i> Topping &amp; Lossing Hari ini</h2>
						<!--<a href="#" class="right">View Full Analytics Reports</a> -->
					</div>
					<div class="panel-content">
						<div class="row">
							<div class="col-md-3 col-sm-6">
								<div class="number-chart">
									<div class="mini-stat">
										<!--<div id="number-chart1" class="inlinesparkline">23,65,89,32,67,38,63,12,34,22</div>-->
									<img src="./assets/img/topping.png" class="img-rounded" alt="Topping" width="25%" height="25%"> 
										<!-- <i class="fa fa-database fa-5x"></i> -->
							
										<!-- <p class="text-muted"><i class="fa fa-caret-up text-success"></i> 19% compared to last week</p> -->
									</div>
									<?php
									if (count($dataTotalTop)):
										foreach ($dataTotalTop as $key => $value):
									?>							
										<div class="number"><span><?php if ($value['totaltop']==null){echo '<b>0</b>';} echo '<b>'.$value['totaltop'].'</b>'; ?> L</span> <span>Total Topping</span></div>
									<?php
									endforeach;
									endif;
									?>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="number-chart">
									<div class="mini-stat">
										<!--<div id="number-chart2" class="inlinesparkline">77,44,10,80,88,87,19,59,83,88</div> -->
										<!-- <p class="text-muted"><i class="fa fa-caret-up text-success"></i> 24% compared to last week</p> -->
										<img src="./assets/img/lossing.png" class="img-rounded" alt="Topping" width="30%" height="30%"> 
										
									</div>
									<!-- <div class="number"><span>0 L</span> <span>Total Lossing</span></div> -->
									<?php
									if (count($dataTotalLos)):
										foreach ($dataTotalLos as $key => $value):
									?>							
										<div class="number"><span><?php if ($value['totallos']==null){echo '<b>0</b>';}else{ echo '<b>'.$value['totallos'].'</b>'; }?> L</span> <span>Total Lossing</span></div>
									<?php
									endforeach;
									endif;
									?>

								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="number-chart">
									<div class="mini-stat">
										<!--<div id="number-chart3" class="inlinesparkline">99,86,31,72,62,94,50,18,74,18</div>-->
										<!-- <p class="text-muted"><i class="fa fa-caret-up text-success"></i> 44% compared to last week</p> -->
										<img src="./assets/img/tangki2.png" class="img-rounded" alt="Topping" width="30%" height="30%"> 
										
									</div>

									<?php
									$topLaine="";
									if (count($dataTopLain)):
										foreach ($dataTopLain as $key => $value):
										$topLaine .= $value['id'].'-'; 	
										endforeach;
									endif;
									$topLaine= substr($topLaine, 0, strlen($topLaine) - 1);
									
									?>

									<?php
									if (count($dataTopActive)):
										foreach ($dataTopActive as $key => $value):
									?>
									<!-- <div class="number"><span><?php //echo '<b>'.$value['id'].'</b> -'.$topLaine ?></span> <span>Tangki Topping</span></div> -->
									<div class="number"><span>
										<?php 
										if ($value['id']==null){echo '<b>N/A</b>';}elseif (($value['id']!=null) && ($topLaine!=null)) {echo '<b>'.$value['id'].'</b> -'.$topLaine; } elseif (($value['id']!=null) && ($topLaine==null)){echo '<b>'.$value['id'].'</b>'; }
										
										?> 
										</span> <span>Tangki Topping</span></div>
									<?php
									endforeach;
								endif;
								?>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="number-chart">
									<div class="mini-stat">
										<!-- <div id="number-chart4" class="inlinesparkline">28,44,70,21,86,54,90,25,83,42</div> -->
										<!-- <p class="text-muted"><i class="fa fa-caret-down text-danger"></i> 6% compared to last week</p> -->
										<img src="./assets/img/tangki2.png" class="img-rounded" alt="Topping" width="30%" height="30%"> 
										
									</div>
									<!-- <div class="number"><span>5 - 6 - 7 - 8</span> <span>Tangki Lossing</span></div> -->

									<?php
									$losLaine="";
									if (count($dataLosLain)):
										foreach ($dataLosLain as $key => $value):
										$losLaine .= $value['id'].'-'; 	
										endforeach;
									endif;
									$losLaine= substr($losLaine, 0, strlen($losLaine) - 1);
									?>

									<?php
									if (count($dataLosActive)):
										foreach ($dataLosActive as $key => $value):
									?>

									
									<!-- <div class="number"><span><?php //echo '<b>'.$value['id'].'</b> -'.$losLaine ?></span> <span>Tangki Lossing</span></div> -->
									<div class="number"><span>
										<?php 
										if ($value['id']==null){echo '<b>N/A</b>';} elseif (($value['id']!=null) && ($losLaine!=null)){echo '<b>'.$value['id'].'</b> -'.$losLaine; }elseif (($value['id']!=null) && ($losLaine==null)){echo '<b>'.$value['id'].'</b>'; }
										?> 
										</span> <span>Tangki Lossing</span></div>
									<?php
									endforeach;
								endif;
								?>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<!-- TRAFFIC SOURCES -->
							<div class="panel-content">
								<h2 class="heading"><i class="fa fa-square"></i> Stok Tangki</h2>
								<div id="demo-pie-chart" class="ct-chart"></div>
								<?php
									if (count($dataTotalUllage)):
										foreach ($dataTotalUllage as $key => $value):
									?>

								<span class="stok text-info" ><?php echo 'Total Stok: <b>'.number_format($value['totalstok']).'</b> L'?></span>
								<span class="ullage text-danger" ><?php echo 'Total Ullage: <b>'.number_format($value['totalullage']).'</b> L'?></span>
								<?php
									endforeach;
								endif;
								?>
							</div>
							<!-- END TRAFFIC SOURCES -->
						</div>
						<div class="col-md-4">
							<!-- REFERRALS -->
							<div class="panel-content">
								<h2 class="heading"><i class="fa fa-square"></i> Rencana Hari Ini</h2>
								<ul class="list-unstyled list-referrals">
									<li>
									<?php
									if (count($dataPlan)):
										foreach ($dataPlan as $key => $value):
								?>	
										<p><span class="value"><?php echo number_format($value['qtytop']) ?> L</span><span class="text-muted">Topping</span></p>
										<div class="progress progress-xs progress-transparent custom-color-blue">
											<div class="progress-bar" data-transitiongoal="87"></div>
										</div>
									</li>
									<li>
										<p><span class="value"><?php echo number_format($value['qtylos']) ?> L</span><span class="text-muted">Lossing</span></p>
										<div class="progress progress-xs progress-transparent custom-color-purple">
											<div class="progress-bar" data-transitiongoal="34"></div>
										</div>
									</li>
									<li>
									<?php
										if (count($dataTotalTankM)):
										foreach ($dataTotalTankM as $key => $value):
									?>	
										<p><span class="value"><?php echo $value['totTankM'] ?> unit </span><span class="text-muted">Tank on Maintenance</span></p>
										<div class="progress progress-xs progress-transparent custom-color-yellow">
											<div class="progress-bar" data-transitiongoal="54"></div>
										</div>
											<?php
										endforeach;
										endif;
										?>
									</li>
									<li>
									<?php
										if (count($dataTotalRefM)):
										foreach ($dataTotalRefM as $key => $value):
									?>
										<p><span class="value"><?php echo $value['totRefM'] ?> unit</span><span class="text-muted">Refuler on Maintenance</span></p>
										<div class="progress progress-xs progress-transparent custom-color-orange">
											<div class="progress-bar" data-transitiongoal="54"></div>
										</div>
										<?php
										endforeach;
										endif;
										?>
									</li>

									<?php
									endforeach;
								endif;
								?>
								</ul>
							</div>
							<!-- END REFERRALS -->
						</div>
						<div class="col-md-4">
							<div class="panel-content">
								<!-- BROWSERS -->
								<h2 class="heading"><i class="fa fa-square"></i> Topping Terakhir</h2>
								<div class="table-responsive">
									<table id="last4topping" class="table no-margin">
										<thead>
											<tr>
												<th>REFULER</th>
												<th>QTY</th>
												<th>TANK</th>
											</tr>
										</thead>
										<tbody>
											<?php
												if (count($dataRecentTop)):
													$i = 0;
													foreach($dataRecentTop as $key => $value):
											?>
											<tr id="<?php echo $value['id']?>">
												<td>REF <?php echo $value['refnya']?></td>
												<td><?php echo $value['qty_req']?> KL</td>
												<td><?php echo $value['tank_asal']?></td>
											</tr>
											<?php
													if($i++ == 3) break;
													endforeach;
												endif;
											?>
										</tbody>
									</table>
								</div>
								<!-- END BROWSERS -->
							</div>
						</div>
					</div>
				</div>
				<!-- END WEBSITE ANALYTICS -->
				
			</div>
		</div>
		<!-- END MAIN CONTENT -->
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
	<script src="assets/vendor/jquery-sparkline/js/jquery.sparkline.min.js"></script>
	<script src="assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js"></script>
	<script src="assets/vendor/chartist-plugin-axistitle/chartist-plugin-axistitle.min.js"></script>
	<script src="assets/vendor/chartist-plugin-legend-latest/chartist-plugin-legend.js"></script>
	<script src="assets/vendor/toastr/toastr.js"></script>
	<script src="assets/scripts/common.js"></script>
	<script>
	$(function() {

		// sparkline charts
		var sparklineNumberChart = function() {

			var params = {
				width: '140px',
				height: '30px',
				lineWidth: '2',
				lineColor: '#20B2AA',
				fillColor: false,
				spotRadius: '2',
				spotColor: false,
				minSpotColor: false,
				maxSpotColor: false,
				disableInteraction: false
			};

			$('#number-chart1').sparkline('html', params);
			$('#number-chart2').sparkline('html', params);
			$('#number-chart3').sparkline('html', params);
			$('#number-chart4').sparkline('html', params);
		};

		sparklineNumberChart();

		<?php
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
		?>
			
		// traffic sources
		// var dataPie = {
		// 	series: [24011, 45596, 58109, 57942, 99622, 0, 78053, 97520]
		// };

		// var labels = ['T01', 'T02', 'T03','T04', 'T05', 'T06','T07', 'T08'];
		var dataPie = {
			series: [<?php echo $pa1 ;?>, <?php echo $pa2 ;?>, <?php echo $pa3 ;?>, <?php echo $pa4 ;?>, <?php echo $pa5 ;?>, <?php echo $pa6 ;?>, <?php echo $pa7 ;?>, <?php echo $pa8 ;?>]
		};

		var labels = ['<?php echo $t1 ;?>', '<?php echo $t2 ;?>', '<?php echo $t3 ;?>','<?php echo $t4 ;?>', '<?php echo $t5 ;?>', '<?php echo $t6 ;?>','<?php echo $t7 ;?>', '<?php echo $t8 ;?>'];

		var sum = function(a, b) {
			return a + b;
		};

		new Chartist.Pie('#demo-pie-chart', dataPie, {
			height: "360px",
			labelInterpolationFnc: function(value, idx) {
				var percentage = Math.round(value / dataPie.series.reduce(sum) * 100) + '%';
				return labels[idx] + ' (' + percentage + ')';
			}
		});


		// progress bars
		$('.progress .progress-bar').progressbar({
			display_text: 'none'
		});

		// line chart
		var data = {
			labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
			series: [
				[200, 380, 350, 480, 410, 450, 550],
			]
		};

		var options = {
			height: "200px",
			showPoint: true,
			showArea: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
			chartPadding: {
				top: 0,
				right: 0,
				bottom: 30,
				left: 30
			},
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
				Chartist.plugins.ctAxisTitle({
					axisX: {
						axisTitle: 'Day',
						axisClass: 'ct-axis-title',
						offset: {
							x: 0,
							y: 50
						},
						textAnchor: 'middle'
					},
					axisY: {
						axisTitle: 'Reach',
						axisClass: 'ct-axis-title',
						offset: {
							x: 0,
							y: -10
						},
					}
				})
			]
		};

		new Chartist.Line('#demo-line-chart', data, options);


		// sales performance chart
		var sparklineSalesPerformance = function() {

			var lastWeekData = [142, 164, 298, 384, 232, 269, 211];
			var currentWeekData = [352, 267, 373, 222, 533, 111, 60];

			$('#chart-sales-performance').sparkline(lastWeekData, {
				fillColor: 'rgba(90, 90, 90, 0.1)',
				lineColor: '#5A5A5A',
				width: '' + $('#chart-sales-performance').innerWidth() + '',
				height: '100px',
				lineWidth: '2',
				spotColor: false,
				minSpotColor: false,
				maxSpotColor: false,
				chartRangeMin: 0,
				chartRangeMax: 1000
			});

			$('#chart-sales-performance').sparkline(currentWeekData, {
				composite: true,
				fillColor: 'rgba(60, 137, 218, 0.1)',
				lineColor: '#3C89DA',
				lineWidth: '2',
				spotColor: false,
				minSpotColor: false,
				maxSpotColor: false,
				chartRangeMin: 0,
				chartRangeMax: 1000
			});
		}

		sparklineSalesPerformance();

		var sparkResize;
		$(window).on('resize', function() {
			clearTimeout(sparkResize);
			sparkResize = setTimeout(sparklineSalesPerformance, 200);
		});


		// top products
		var dataStackedBar = {
			labels: ['Q1', 'Q2', 'Q3'],
			series: [
				[800000, 1200000, 1400000],
				[200000, 400000, 500000],
				[100000, 200000, 400000]
			]
		};

		new Chartist.Bar('#chart-top-products', dataStackedBar, {
			height: "250px",
			stackBars: true,
			axisX: {
				showGrid: false
			},
			axisY: {
				labelInterpolationFnc: function(value) {
					return (value / 1000) + 'k';
				}
			},
			plugins: [
				Chartist.plugins.tooltip({
					appendToBody: true
				}),
				Chartist.plugins.legend({
					legendNames: ['Phone', 'Laptop', 'PC']
				})
			]
		}).on('draw', function(data) {
			if (data.type === 'bar') {
				data.element.attr({
					style: 'stroke-width: 30px'
				});
			}
		});


		// notification popup
		toastr.options.closeButton = true;
		toastr.options.positionClass = 'toast-bottom-right';
		toastr.options.showDuration = 1000;
		toastr['info']('Hello, welcome to PERTAMINA DPPU ADISUCIPTO.');

	});
	</script>
	<script type="text/javascript" language="javascript" src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

	
</body>
<?php include 'footer.php'; ?>
</html>
