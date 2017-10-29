<?php
include '/admin/config.php';
date_default_timezone_set('Asia/Jakarta');

$s = time ();
 $tgljam =date("Y-m-d H:i:s",$s);

$soundact="";
  $sql = mysql_query("SELECT tb_tank.*,(pa - patarget) AS selisih , COUNT(*) AS Jumlah FROM tb_tank WHERE ((pa - patarget > 0) AND (pa - patarget < 100 ) AND STATUS = '201')");
  $sql2List = mysql_query("SELECT tb_tank.tank,tb_tank.pa,tb_tank.patarget,(pa - patarget) AS selisih FROM tb_tank WHERE ((pa - patarget > 0) AND (pa - patarget < 100 ) AND STATUS='201')");
//   $sqlidalarm = mysql_query("SELECT alarm.id, alarm.idclient,client.lat,client.lng  FROM alarm 
//     INNER JOIN CLIENT ON alarm.idclient = client.idclient
//     WHERE alarm.status = 'ALERT' ORDER BY id DESC LIMIT 1");
 
  $result = mysql_fetch_array($sql);
  // $result2 = mysql_fetch_array($sql2List);
  
        // echo"<div";
      echo "<li class='header'>";
  if (($result['Jumlah']>0) ){ //info jumlah
    $soundact="DANGER!!!";
        
      
      echo "<strong> Tangki ".$result['id']." Mau Habis!!! </strong></li>";
      
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


      
     

    
    // echo"><center><img src='../images/alert3.gif'></center></div>";	 //alert3.gif Police_Siren_Emote.gif
        // echo "<h3 style='color:red'><center><b> DANGER!! ".$result['Jumlah']." Alert /b></center></h3>"; 
        // echo "<center><a class='btn btn-sm btn-danger' href='http://www.google.com'><i class='glyphicon glyphicon glyphicon-map-marker'></i></a></center>";

        // echo "<div><audio autoplay loop>
        //         <source src='./ajaxtm/alert.mp3' type='audio/mpeg'>
        //       </audio>
        // </div>";
        
        // echo "<a href='pub_alarm.php' class='btn btn-primary' role='button' aria-disabled='true'>Verifikasi</a>"; glyphicon glyphicon-ok-circle
					
  } else
  {
  $soundact="Safe";
      
        // echo"alert-success'><span><center><img class='glyphicon-thumbs-down' src='../images/shield-ok-icon-95223-iloveimg-resized(1).png'></center></span></div>";	
        echo"</br>";
        echo"<center><a style='color:black'> Stok Tangki  ".$result['id']." </a></center>";
        echo"<center><a style='color:green'> Aman <span class='glyphicon glyphicon-ok-circle text-center'></span></a></center>";
       
  }


?>