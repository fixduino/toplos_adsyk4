<?php
require_once 'session.php';
class Topping {
    protected $id;
    protected $time;
    protected $ref;
    protected $qty_req;
    protected $tank_asal;

    // public function __construct(){
    //     parent::connect();
    // }
    // public function setTopping() {

    // }
    public function getAllTop(){
        $db = getDB();
        $sth = $db->prepare('SELECT tb_topp.*, tb_ref.kode AS koderefnya, tb_tank.tank AS tangkinya FROM tb_topp
        INNER JOIN tb_ref ON tb_topp.ref = tb_ref.id
        INNER JOIN tb_tank ON tb_topp.tank_asal = tb_tank.id
         GROUP BY tb_topp.id DESC');
        $sth->execute();

        $data = $sth->fetchAll();
        return $data;
    }
    public function getAllLoss(){
        $db = getDB();
        $sth = $db->prepare('SELECT tb_loss.*, tb_bridger.kode AS kodebridnya,tb_tank.tank AS tangkinya  FROM tb_loss
        INNER JOIN tb_bridger ON tb_loss.brid = tb_bridger.id
        INNER JOIN tb_tank ON tb_loss.tank_tujuan = tb_tank.id
         GROUP BY tb_loss.id');
        $sth->execute();

        $dataAllLoss = $sth->fetchAll();
        return $dataAllLoss;
    }
    public function get4(){
        $db = getDB();
        $sth = $db->prepare('SELECT tb_topp.*, tb_ref.kode AS refnya FROM tb_topp
        INNER JOIN tb_ref ON tb_topp.ref = tb_ref.id
        GROUP BY tb_topp.id DESC');
        $sth->execute();

        $dataRecentTop = $sth->fetchAll();
        return $dataRecentTop;
    }
    public function get5RecentLos(){
        $db = getDB();
        $sth = $db->prepare('SELECT tb_loss.*, tb_bridger.kode AS bridnya, tb_tank.tank as tangkinya FROM tb_loss
        INNER JOIN tb_bridger ON tb_loss.brid = tb_bridger.id
        INNER JOIN tb_tank ON tb_loss.tank_tujuan = tb_tank.id
        GROUP BY tb_loss.id DESC');
        $sth->execute();

        $dataRecentLos = $sth->fetchAll();
        return $dataRecentLos;
    }
    public function getTopActive(){
        $db = getDB();
        $sth = $db->prepare('SELECT id, count(*) as tangkiTopAct  FROM tb_tank WHERE status="201"');
        $sth->execute();

        $dataTopActive = $sth->fetchAll();
        return $dataTopActive;
    }
    public function getTopLain(){
        $db = getDB();
        $sth = $db->prepare('SELECT id FROM tb_tank WHERE status="101"');
        $sth->execute();

        $dataTopLain = $sth->fetchAll();
        return $dataTopLain;
    }
    public function getLosActive(){
        $db = getDB();
        $sth = $db->prepare('SELECT id, count(*) as tangkiLosAct FROM tb_tank WHERE status="202"');
        $sth->execute();

        $dataLosActive = $sth->fetchAll();
        return $dataLosActive;
    }
    public function getTotalTankM(){
        // $sth = $this->DBH->prepare('SELECT count(*) as totTankM FROM tb_tank WHERE status="99"');
        $db = getDB();
		$sth = $db->prepare('SELECT count(*) as totTankM FROM tb_tank WHERE status="99"');
        
		$sth->execute();

        $dataTotalTankM = $sth->fetchAll();
        return $dataTotalTankM;
    }
    public function getTotalRefM(){
        // $sth = $this->DBH->prepare('SELECT count(*) as totRefM FROM tb_ref WHERE status="0"');
        
		$db = getDB();
		$sth = $db->prepare('SELECT count(*) as totRefM FROM tb_ref WHERE status="0"');
        
		$sth->execute();

        $dataTotalRefM = $sth->fetchAll();
        return $dataTotalRefM;
    }
    public function getLosLain(){
        $db = getDB();
        $sth = $db->prepare('SELECT id FROM tb_tank WHERE status="102"');
        $sth->execute();

        $dataLosLain = $sth->fetchAll();
        return $dataLosLain;
    }

    public function getTotalTop() { //total top this day
        $db = getDB();
        $sth = $db->prepare('SELECT id, DATE_FORMAT(tb_topp.time, "%Y-%m-%d"), SUM(tb_topp.qty_req) AS totaltop 
        FROM tb_topp 
        WHERE DATE(TIME) = CURDATE()');
        // $sth->bindValue($id);
        // try{
        //     $sth->execute();
        //     $rows = $sth->fetch();
        //     return $rows[0];   
        // }catch(PDOException $e){
        //     die($e->getMessage());
        // }

        $sth->execute();
        
        $dataTotalTop = $sth->fetchAll();
        return $dataTotalTop;
    }
    public function getTotalUllage() { //total Ullage
        $db = getDB();
        $sth = $db->prepare('SELECT SUM(tb_tank.pa) AS totalstok,SUM(tb_tank.max_pa - tb_tank.pa) AS totalullage
        FROM tb_tank');

        $sth->execute();
        
        $dataTotalUllage = $sth->fetchAll();
        return $dataTotalUllage;
    }
  
    public function getTotalLos() { //total los this day
        $db = getDB();
        $sth = $db->prepare('SELECT id, DATE_FORMAT(tb_loss.time, "%Y-%m-%d") AS tglnow, SUM(tb_loss.qty_req) AS totallos
        FROM tb_loss
        WHERE DATE(TIME) = CURDATE()');
        $sth->execute();

        $dataTotalLos = $sth->fetchAll();
        return $dataTotalLos;
    }
   
    public function get($id) {
        $db = getDB();
        $sth = $db->prepare('SELECT id,time,ref,qty_req,tank_asal Form tb_topp');
        $sth->execute(array($id));

        $data = $sth->fetchAll();
        return $data;
    }
    // if(!empty($_SESSION['id']))
    // {
    // $session_id=$_SESSION['id'];
    // include('users.php');
    // $userClass = new userClass();
    // }
    public function getDataUser() { //total Ullage
        $db = getDB();
        $sth = $db->prepare("SELECT users.username FROM users WHERE NOT username='admin' " );

        $sth->execute();
        
        $dataDetailUser = $sth->fetchAll();
        return $dataDetailUser;
    }
    public function getDataUserType() { //total Ullage
        $db = getDB();
        $sth = $db->prepare("SELECT type FROM tb_type GROUP BY id DESC " );

        $sth->execute();
        
        $dataUserType = $sth->fetchAll();
        return $dataUserType;
    }


// $TopLastWeek = new Topping();
// $dataTopLastWeek = $TopLastWeek->getDataTopLastWeek();
// $TopThisWeek = new Topping();
// $dataTopThisWeek = $TopThisWeek->getDataTopThisWeek();


    public function getDataTopLastWeek() { //total Ullage
        $db = getDB();
        $sth = $db->prepare("SELECT tb_topp.*, SUM(qty_req) AS totTopLastWeek FROM tb_topp WHERE TIME BETWEEN (NOW() - INTERVAL 14 DAY) AND (NOW() - INTERVAL 7 DAY)" );

        $sth->execute();
        
        $dataTopLastWeek = $sth->fetchAll();
        return $dataTopLastWeek;
    }
    public function getDataTopThisWeek() { //total Ullage
        $db = getDB();
        $sth = $db->prepare("SELECT tb_topp.*, SUM(qty_req) AS totTopThisWeek  FROM tb_topp  WHERE TIME BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()" );

        $sth->execute();
        
        $dataTopThisWeek = $sth->fetchAll();
        return $dataTopThisWeek;
    }
    public function getDataLosLastWeek() { //total Ullage
        $db = getDB();
        $sth = $db->prepare("SELECT tb_loss.*, SUM(qty_req) AS totLosLastWeek FROM tb_loss WHERE TIME BETWEEN (NOW() - INTERVAL 14 DAY) AND (NOW() - INTERVAL 7 DAY)" );

        $sth->execute();
        
        $dataLosLastWeek = $sth->fetchAll();
        return $dataLosLastWeek;
    }
    public function getDataLosThisWeek() { //total Ullage
        $db = getDB();
        $sth = $db->prepare("SELECT tb_loss.*, SUM(qty_req) AS totLosThisWeek  FROM tb_loss  WHERE TIME BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()" );

        $sth->execute();
        
        $dataLosThisWeek = $sth->fetchAll();
        return $dataLosThisWeek;
    }
}