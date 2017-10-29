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
