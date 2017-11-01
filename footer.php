<?php
require_once 'DBConnect.php';
require_once 'session.php';

date_default_timezone_set('Asia/Jakarta');

require_once 'topping.php';
require_once 'tangki.php';

$topA = new Topping();
$dataTopActive = $topA ->getTopActive();

$topB = new Topping();
$dataTopLain = $topB ->getTopLain();

$losC = new Topping();
$dataLosActive = $losC ->getLosActive();

$losD = new Topping();
$dataLosLain = $losD ->getLosLain();

$DetailUsers = new Topping();
$dataDetailUser = $DetailUsers->getDataUser();
$listUserType = new Topping();
$dataUserType = $listUserType->getDataUserType();
?>


<div id="myModalSetTopLos" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Setting Tangki Topping Lossing</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_SetTopLos_act.php" method="post">
					<div class="form-group">
						<label>Tangki Top</label>
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
									<!-- <div class="number"><span><?php// if ($value['id']==null){echo '<b>N/A</b>';}else {echo '<b>'.$value['id'].'</b> -'.$topLaine; }?> </span> <span>Tangki Topping</span></div> -->
									<input name="deretTop" type="text" class="form-control" placeholder="Deret Tangki Topping Cth. 1-2-3" required="required" value="<?php if ($value['id']==null){echo '0';}else {echo $value['id'].'-'.$topLaine; }?>">
					
									<?php
									endforeach;
								endif;
								?>
						</div>
					<div class="form-group">
						<label>Tangki Los</label>
						<!-- <input name="deretLos" type="text" class="form-control" placeholder="Deret Tangki Lossing Cth. 4-5-6" required="required"> -->
						
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
									<!-- <div class="number"><span><?php// if ($value['id']==null){echo '<b>N/A</b>';} else {echo '<b>'.$value['id'].'</b> -'.$losLaine; }?> </span> <span>Tangki Lossing</span></div> -->
									<input name="deretLos" type="text" class="form-control" placeholder="Deret Tangki Lossing Cth. 4-5-6" required="required" value="<?php if ($value['id']==null){echo '0';} else {echo $value['id'].'-'.$losLaine; }?>">
					
									<?php
									endforeach;
								endif;
								?>
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

<script> //cari jumlah status alert 
	function sendRequestAlertC(){
		$.ajax({
        url: "cariJumlahAlert.php",
        cache: false,
        success: function(html){
				$("#Jumlah").html(html) ;
				}
    		});		
		};
		setInterval(sendRequestAlertC, 3000); 
</script>


	

<script>
	$(function() {
		// photo upload
		$('#btn-upload-photo').on('click', function() {
			$(this).siblings('#filePhoto').trigger('click');
		});
		// photo upload
		$('#btn-upload-photo2').on('click', function() {
			$(this).siblings('#filePhoto2').trigger('click');
		});
		// photo upload
		$('#btn-upload-photo3').on('click', function() {
			$(this).siblings('#filePhoto3').trigger('click');
		});

		// plans
		$('.btn-choose-plan').on('click', function() {
			$('.plan').removeClass('selected-plan');
			$('.plan-title span').find('i').remove();

			$(this).parent().addClass('selected-plan');
			$(this).parent().find('.plan-title').append('<span><i class="fa fa-check-circle"></i></span>');
		});
	});
	</script>



<!-- modal input -->
<div id="myModalProfile" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">My Profile</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<!-- <div class="section-heading">
						<h1 class="page-title">User Profile</h1>
					</div> -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="active"><a href="#myprofile" role="tab" data-toggle="tab">Profile</a></li>
						<?php if ($userDetails->type=='superuser'){
							echo '<li><a href="#account" role="tab" data-toggle="tab">List User</a></li>';
							echo '<li><a href="#addnew" role="tab" data-toggle="tab">Add user </a></li>';

						} else{}; ?>
						
						
					</ul>
				</div>
				<!-- <form> -->
				<div class="tab-content content-profile">
						<!-- MY PROFILE -->
						<div class="tab-pane fade in active" id="myprofile">
							<form action="tmb_userEdit_act.php" method="post">
								<div class="profile-section">
									<h2 class="profile-heading">Profile Photo</h2>
									<div class="media">
										<div class="media-left">
											<img src="assets/img/<?php echo $userDetails->foto; ?>" class="user-photo media-object" alt="User">
										</div>
										<div class="media-body">
											<p>Upload photo.
												<br> <em>Image should be at least 140px x 140px</em></p>
											<button type="button" class="btn btn-default-dark" id="btn-upload-photo">Upload Photo</button>
											<input type="file" id="filePhoto" name="ufoto" class="sr-only">
										</div>
									</div>
								</div>
								<div class="profile-section">
									<!-- <h2 class="profile-heading">Basic Information</h2> -->
									<div class="clearfix">
										<!-- LEFT SECTION -->
										<div class="left">
											<div class="form-group">
												<label>First Name</label>
												<input type="text" name="uname" class="form-control" value="<?php echo $userDetails->username; ?>" required="required" >
											</div>
											<div class="form-group">
												<label>Type</label>
												<!-- <input type="text" name="utype" class="form-control" value="<?php //echo $userDetails->type; ?>" required="required"> -->
												<select class="form-control" name="utype" required="required">
													<?php
													if (count($dataUserType)):
														$i = 0;
														foreach ($dataUserType as $key => $value):
													?>		
															<option> <?php 
															if (($userDetails->type=='superuser') and ($userDetails->username=='admin')){ echo 'superuser';} 
															elseif (($userDetails->type=='superuser') && ($userDetails->username!='admin')){ echo $value['type'];}	
															else { echo 'operator';}
															?></option>
													<?php
													if($i++ == 1) break;
													endforeach;
													endif;
													?>
												</select>
											</div>
											<div class="form-group">
												<label>Password</label>
												<input type="password" name="upass" class="form-control" required="required">
											</div>
											<div class="form-group">
													<input type="submit" class="btn btn-primary" value="Update">	
											</div>
										</div>
									</div>
								</div>

							</form >
						</div>
						<!-- edit other user -->
						<div class="tab-pane fade" id="account">
							<form action="tmb_userEdit2_act.php" method="post">
							<!-- <div class="profile-section">
								<h2 class="profile-heading">Profile Photo</h2>
								<div class="media">
									<div class="media-left">
										<img src="assets/img/<?php echo $userDetails->foto; ?>" class="user-photo media-object" alt="User">
									</div>
									<div class="media-body">
										<p>Upload photo.
											<br> <em>Image should be at least 140px x 140px</em></p>
										<button type="button" class="btn btn-default-dark" id="btn-upload-photo2">Upload Photo</button>
										<input type="file" id="filePhoto2" name="ufoto2" class="sr-only">
									</div>
								</div>
							</div> -->
							<div class="form-group">
								<label for="exampleInputFile" class="control-label">File Foto</label>
								<input type="file" name="ufoto2" id="exampleInputFile">
								<p class="help-block"><em>Cari file foto.</em></p>
							</div>
							<div class="profile-section">
								<!-- <h2 class="profile-heading">Basic Information</h2> -->
								<div class="clearfix">
									<!-- LEFT SECTION -->
									<div class="left">
											<div class="form-group">
												<label>Username</label>
												<select class="form-control" name="uname2" required="required">
												<?php
												if (count($dataDetailUser)):
													foreach ($dataDetailUser as $key => $value):
												?>		
														<option> <?php echo $value['username']; ?></option>
												<?php
												endforeach;
												endif;
												?>
												</select>
											</div>
											<div class="form-group">
												<label>Type</label>
												<select class="form-control" name="utype2" required="required">
												<?php
												if (count($dataUserType)):
													$i=0;
													foreach ($dataUserType as $key => $value):
												?>		
														<option> <?php echo $value['type']; ?></option>
												<?php
												if($i++ == 1) break;
												endforeach;
												endif;
												?>
												</select>
											</div>
											<div class="form-group">
												<label>Password</label>
												<input type="password" name="upass2" class="form-control"  required="required">
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-primary" value="Update">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div><div class="tab-pane fade" id="addnew">
							<form action="tmb_userAdd_act.php" method="post">
							<!-- <div class="profile-section">
								<h2 class="profile-heading">Profile Photo</h2>
								<div class="media">
									<div class="media-left">
										<img src="assets/img/<?php echo $userDetails->foto; ?>" class="user-photo media-object" alt="User">
									</div>
									<div class="media-body">
										<p>Upload photo.
											<br> <em>Image should be at least 140px x 140px</em></p>
										<button type="button" class="btn btn-default-dark" id="btn-upload-photo3">Upload Photo</button>
										<input type="file" id="filePhoto3" name="ufoto3" class="sr-only">
									</div>
								</div>
							</div> -->
							<div class="form-group">
								<label for="exampleInputFile" class="control-label">File Foto</label>
								<input type="file" name="ufoto3" id="exampleInputFile">
								<p class="help-block"><em>Cari file foto.</em></p>
							</div>
							<div class="profile-section">
								<!-- <h2 class="profile-heading">Basic Information</h2> -->
								<div class="clearfix">
									<!-- LEFT SECTION -->
									<div class="left">
											<div class="form-group">
												<label>Username</label>
												<input type="text" name="uname3" class="form-control" placeholder="Isikan Nama" value="" required="required" >
											</div>
											<div class="form-group">
												<label>Type</label>
												<select class="form-control" name="utype3" required="required">
												<?php
												if (count($dataUserType)):
													$i=0;
													foreach ($dataUserType as $key => $value):
												?>		
														<option> <?php echo $value['type']; ?></option>
												<?php
												if($i++ == 1) break;
												endforeach;
												endif;
												?>
												</select>
											</div>
											<div class="form-group">
												<label>Password</label>
												<input type="password" name="upass3" class="form-control"  required="required">
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-primary" value="Update">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

				</div>	

				
				
			</div>
		</div>
	</div>
</div>
