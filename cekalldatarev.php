 
<?php
   date_default_timezone_set('Asia/Jakarta');
   include("dbcon.php");


	$cari = mysql_query("SELECT id,tank,pa,status FROM tb_tank ORDER BY id ASC")or die(mysql_error());
	if ($cari !== false) {
					$pa1=mysql_result($cari,0,"pa"); 
                   $tank1=mysql_result($cari,0,"tank");
				   $stat1=mysql_result($cari,0,"status");
				   if ($pa1==0){$pa1="BLOKIR"; }
				   
				   $pa2=mysql_result($cari,1,"pa");
                   $tank2=mysql_result($cari,1,"tank");
				   $stat2=mysql_result($cari,1,"status");
				   if ($pa2==0){$pa2="BLOKIR"; }
				   
				   $pa3=mysql_result($cari,2,"pa");
                   $tank3=mysql_result($cari,2,"tank");
				   $stat3=mysql_result($cari,2,"status");
				   if ($pa3==0){$pa3="BLOKIR"; }
				   
				   $pa4=mysql_result($cari,3,"pa");
				   $tank4=mysql_result($cari,3,"tank");
				   $stat4=mysql_result($cari,3,"status");
				   if ($pa4==0){$pa4="BLOKIR"; }
				   
				   $pa5=mysql_result($cari,4,"pa");
				   $tank5=mysql_result($cari,4,"tank");
				   $stat5=mysql_result($cari,4,"status");
				   if ($pa5==0){$pa5="BLOKIR"; }
				   
				   $pa6=mysql_result($cari,5,"pa");
                   $tank6=mysql_result($cari,5,"tank");
				   $stat6=mysql_result($cari,5,"status");
				    if ($pa6==0){$pa6="BLOKIR"; }
					
				   $pa7=mysql_result($cari,6,"pa");
                   $tank7=mysql_result($cari,6,"tank");
				   $stat7=mysql_result($cari,6,"status");
				   if ($pa7==0){$pa7="BLOKIR"; }
				   $pa8=mysql_result($cari,7,"pa");
                   $tank8=mysql_result($cari,7,"tank");
					$stat8=mysql_result($cari,7,"status");
				   if ($pa8==0){$pa8="BLOKIR"; }
	}
	/*
	for ($x = 0; $x <= 10; $x++) {
  echo "The number is: $x <br>";
}
	*/
	
	//cari tank topping
	$cari2_TankTop = "SELECT tank FROM tb_tank WHERE status ='101'"; //Top
	$result = mysql_query($cari2_TankTop);
	$rows = array();
	$TankTops="";
    while($row = mysql_fetch_array($result))
    {
            $rows[]=$row;
			$row["tank"]= substr($row["tank"], -1);
			$TankTops .=$row["tank"].'-';
    
	}
	$TankTops= substr($TankTops, 0, strlen($TankTops) - 1);
	// echo $TankTops;
	
	//cari tank lossing
	$cari2_TankLos = "SELECT tank FROM tb_tank WHERE status ='102'"; //LOS
	$result = mysql_query($cari2_TankLos);
	$rows = array();
	$TankLoss="";
    while($row = mysql_fetch_array($result))
    {
            $rows[]=$row;
			$row["tank"]= substr($row["tank"], -1);
			$TankLoss .=$row["tank"].'-';
    
	}
	$TankLoss= substr($TankLoss, 0, strlen($TankLoss) - 1);
	if ($TankLoss==""){$TankLoss="N/A";}
	// echo $TankLoss;
	
	//cari tank aktif topping
	$cari2_TankTopActiv= "SELECT tank FROM tb_tank WHERE status ='201'"; //LOS
	$result = mysql_query($cari2_TankTopActiv);
	$rows = array();
	$TankTopActiv="";
    while($row = mysql_fetch_array($result))
    {
            $rows[]=$row;
			$row["tank"]= substr($row["tank"], -1);
			$TankTopActiv .=$row["tank"].'-';
    
	}
	$TankTopActiv= substr($TankTopActiv, 0, strlen($TankTopActiv) - 1);
	// echo $TankTopActiv;
	
	//update list tanktop:
	// $TankTops .='-'.$TankTopActiv;
	$ListTankTops = $TankTopActiv."-".$TankTops;
	if ($ListTankTops==""){$ListTankTops="N/A";}
					
	$cari4_lastTopping = mysql_query("SELECT ref, qty_req FROM tb_topp ORDER BY id DESC LIMIT 4 ")or die(mysql_error());
	if ($cari4_lastTopping !== false) {
					$refuler1=mysql_result($cari4_lastTopping,0,"ref");
                   $qtyreq1=mysql_result($cari4_lastTopping,0,"qty_req");
				  
				  $refuler2=mysql_result($cari4_lastTopping,1,"ref");
                   $qtyreq2=mysql_result($cari4_lastTopping,1,"qty_req");
				  
				  $refuler3=mysql_result($cari4_lastTopping,2,"ref");
                   $qtyreq3=mysql_result($cari4_lastTopping,2,"qty_req");
				  
				  $refuler4=mysql_result($cari4_lastTopping,3,"ref");
                   $qtyreq4=mysql_result($cari4_lastTopping,3,"qty_req");
				  
	} //end cari last topping
	
					$topTankAktifOK=(sprintf('%06d', $tt1_topAktif)); //tt1_topAktif
					$ListTopTankOK=(sprintf('%08d', $ListTopTank)); //tt1_topAktif
					
					
					$LosTankAktifOK=(sprintf('%06d', $tt1_LosAktif)); //tt1_topAktif
					$ListLosTankOK=(sprintf('%08d', $ListLosTank)); //tt1_topAktif
					
					
					// echo intval($pa2)+0;
					//T1: = 3 char_from_digit
					// $txtT1 = "T1:";
					// $jumlah = strlen($pa2);
					// $gap= 9- $jumlah - strlen($txtT1);
					
					// $j12 = "alena";
					// echo $gap;
					// echo "<br>";
					// echo strlen($j12);
					
					
						$pa1OK = str_repeat(" ", 6 - strlen($pa1)).$pa1;
						$pa2OK = str_repeat(" ", 6 - strlen($pa2)).$pa2;
						$pa3OK = str_repeat(" ", 6 - strlen($pa3)).$pa3;
						$pa4OK = str_repeat(" ", 6 - strlen($pa4)).$pa4;
						$pa5OK = str_repeat(" ", 6 - strlen($pa5)).$pa5;
						$pa6OK = str_repeat(" ", 6 - strlen($pa6)).$pa6;
						$pa7OK = str_repeat(" ", 6 - strlen($pa7)).$pa7;
						$pa8OK = str_repeat(" ", 6 - strlen($pa8)).$pa8;
						
					$T1OK=(sprintf('%06d', $tank1));
					$T2OK=(sprintf('%06d', $tank2));
					$T3OK=(sprintf('%06d', $tank3));
					$T4OK=(sprintf('%06d', $tank4));
					$T5OK=(sprintf('%06d', $tank5));
					$T6OK=(sprintf('%06d', $tank6));
					$T7OK=(sprintf('%06d', $tank7));
					$T8OK=(sprintf('%06d', $tank8));
					
					$Ref1OK=(sprintf('%06d', $refuler1));
					$Ref2OK=(sprintf('%06d', $refuler2));
					$Ref3OK=(sprintf('%06d', $refuler3));
					$Ref4OK=(sprintf('%06d', $refuler4));
					// $qtyReq1OK=(sprintf('%06d', $qtyreq1));
						$qtyReq1OK = str_repeat(" ", 5 - strlen($qtyreq1)).$qtyreq1;
						$qtyReq2OK = str_repeat(" ", 5 - strlen($qtyreq2)).$qtyreq2;
						$qtyReq3OK = str_repeat(" ", 5 - strlen($qtyreq3)).$qtyreq3;
						$qtyReq4OK = str_repeat(" ", 5 - strlen($qtyreq4)).$qtyreq4;
	echo "parsing result:"; echo "</br>";
					echo "*";
					echo $tank1.":".$pa1OK.",".$tank2.":".$pa2OK.",".$tank3.":".$pa3OK.",".$tank4.":".$pa4OK.",".$tank5.":".$pa5OK.",".$tank6.":".$pa6OK.",".$tank7.":".$pa7OK.",".$tank8.":".$pa8OK."";
					echo ",TOP:".$ListTankTops."|,LOS:".$TankLoss."$,ACTIVE:".$TankTopActiv.",R".$refuler1.":".$qtyReq1OK."^,R".$refuler2.":".$qtyReq2OK."~,R".$refuler3.":".$qtyReq3OK."@,R".$refuler4.":".$qtyReq4OK."";
					// ,".$topTankAktifOK.",".$ListTopTankOK.",".$LosTankAktifOK.",".$ListLosTankOK."]|"; //echo "AKTIFNIH[".$tt1_topAktif."]|";"ZZ[".$tt1.",".$tt2.",".$tt3."]|";
					echo "#";
?>

