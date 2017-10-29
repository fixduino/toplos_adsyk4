<?php
include '/admin/config.php';
date_default_timezone_set('Asia/Jakarta');

$s = time ();
 $tgljam =date("Y-m-d H:i:s",$s);

$soundact="";
  $sql = mysql_query("SELECT tb_tank.*,(pa - patarget) AS selisih , COUNT(*) AS Jumlah FROM tb_tank WHERE ((pa - patarget > 0) AND (pa - patarget < 100 ) AND STATUS = '201')");
  $sql2List = mysql_query("SELECT tb_tank.tank,tb_tank.pa,tb_tank.patarget,(pa - patarget) AS selisih FROM tb_tank WHERE ((pa - patarget > 0) AND (pa - patarget < 100 ) AND STATUS='201')");
  $sql3 = mysql_query("SELECT tb_tank.*, COUNT(*) AS tankTopAktif FROM tb_tank WHERE STATUS = '201'");
  
  //   $sqlidalarm = mysql_query("SELECT alarm.id, alarm.idclient,client.lat,client.lng  FROM alarm 
//     INNER JOIN CLIENT ON alarm.idclient = client.idclient
//     WHERE alarm.status = 'ALERT' ORDER BY id DESC LIMIT 1");
 
  $result = mysql_fetch_array($sql);
  $result3 = mysql_fetch_array($sql3);
  // $result2 = mysql_fetch_array($sql2List);
 
        // echo"<div";
      echo "<li class='header'>";
  if (($result['Jumlah']>0) ){ //info jumlah
    // $tangkiAct=$result['id'];
    $soundact="DANGER!!!";
        
      
      echo "<strong class='text-danger'> Tangki ".$result['tank']." Mau Habis!!! </strong></li>";
      
        echo "<li>";
        echo "  <a href='#'>";
        echo "    <div class='media'>";
        echo "      <div class='media-left'>";
        echo "        <i class='fa fa-fw fa-info-circle text-danger'></i>";
        echo "      </div>";
        echo "      <div class='media-body'>";
        echo "        <p class='text text-danger'>Warning!";
        echo "        <p class='text'>Stok Aktual Tangki Topping Aktif <b>".number_format($result['pa'])."L</b>. ";
        echo "        <p class='text'>Sisa <b>".number_format($result['selisih'])."L</b> lagi menuju Unpumpable <b>".number_format($result['patarget'])."L</b></p>";
        echo "        <span class='timestamp'>".$tgljam."</span>";
        echo "      </div>";
        echo "    </div>";
        echo "  </a>";
        echo "</li>";
        echo "	<li class='footer'><a href='#' data-toggle='modal' data-target='#myModalSetTopLos' class='more'>Setting Ulang</a></li>";
        echo "<div><audio autoplay loop>
                <source src='assets/alert.mp3' type='audio/mpeg'>
              </audio>
        </div>";
				
  } else if (($result3['tankTopAktif']>0) ){
  
  $soundact="Safe";
      
       echo "<strong class='text-success'> Tangki Topping Aktiv ".$result3['tank']." Aman </strong><span class='glyphicon glyphicon-ok-circle text-center'></span></li>";
        
          echo "<li>";
          echo "  <a href='#'>";
          echo "    <div class='media'>";
          echo "      <div class='media-left'>";
          echo "        <i class='fa fa-fw fa-info-circle text-success'></i>";
          echo "      </div>";
          echo "      <div class='media-body'>";
          echo "        <p class='text text-success'>Info";
          echo "        <p class='text'>Stok Aktual Tangki Topping Aktif <b>".number_format($result3['pa'])."L</b>. ";
         echo "        <span class='timestamp'>".$tgljam."</span>";
          echo "      </div>";
          echo "    </div>";
          echo "  </a>";
          echo "</li>";
          echo "	<li class='footer'><a href='#' data-toggle='modal' data-target='#myModalSetTopLos' class='more'>Setting</a> <span class='timestamp'>Set Ulang Deret tangki Topping</span></li>";
         

  }


?>