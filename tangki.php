<?php
class Tangki {
    protected $tank_id;
    protected $tank;
    protected $level;
    protected $max_level;
    protected $pa;
    protected $max_pa;
    protected $status;

    // public function __construct(){
    //     parent::connect();
    // }

    public function setTank($tank){
        $this->tank = $tank;
    }
    public function setMaxLevel($max_level){
        $this->max_level = $max_level;
    }
    public function setPa($pa){
        $this->pa = $pa;
    }


    public function getAll(){
        // $sth = $this->DBH->prepare('SELECT id,tank,level,max_level,pa,max_pa,status,time,deadstok,sisipan FROM tb_tank');
        $db = getDB();
        $sth = $db->prepare('SELECT tb_tank.*, tb_act.act AS statusnya FROM tb_tank
INNER JOIN tb_act ON tb_tank.status = tb_act.id
 GROUP BY tb_tank.id ');
        $sth->execute();

        $data = $sth->fetchAll();
        return $data;
    }
    public function getRefAll(){
        // $sth = $this->DBH->prepare('SELECT id,tank,level,max_level,pa,max_pa,status,time,deadstok,sisipan FROM tb_tank');
        $db = getDB();
        $sth = $db->prepare('SELECT tb_ref.* FROM tb_ref GROUP BY tb_ref.id ');
        $sth->execute();

        $dataRef = $sth->fetchAll();
        return $dataRef;
    }
    public function getBridgerAll(){
        // $sth = $this->DBH->prepare('SELECT id,tank,level,max_level,pa,max_pa,status,time,deadstok,sisipan FROM tb_tank');
        $db = getDB();
        $sth = $db->prepare('SELECT tb_bridger.* FROM tb_bridger GROUP BY tb_bridger.id ');
        $sth->execute();

        $dataBrid = $sth->fetchAll();
        return $dataBrid;
    }

    public function getPlan(){
        // $sth = $this->DBH->prepare('SELECT id,tank,level,max_level,pa,max_pa,status,time,deadstok,sisipan FROM tb_tank');
        $db = getDB();
        $sth = $db->prepare('SELECT tb_plan.* FROM tb_plan GROUP BY tb_plan.id ORDER BY id DESC limit 1');
        $sth->execute();

        $data = $sth->fetchAll();
        return $data;
    }
    public function getLastLoss(){
        // $sth = $this->DBH->prepare('SELECT id,tank,level,max_level,pa,max_pa,status,time,deadstok,sisipan FROM tb_tank');
        $db = getDB();
        $sth = $db->prepare('SELECT tb_loss.*, tb_bridger.kode AS kodebridnya,tb_tank.tank AS tangkinya  FROM tb_loss
        INNER JOIN tb_bridger ON tb_loss.brid = tb_bridger.id
        INNER JOIN tb_tank ON tb_loss.tank_tujuan = tb_tank.id
         GROUP BY tb_loss.id DESC limit 1');
        $sth->execute();

        $dataLoss = $sth->fetchAll();
        return $dataLoss;
    }
   

    public function get($tank_id){
        $db = getDB();
        $sth = $db->prepare('SELECT id,tank,level,max_level,pa,max_pa,status,time,deadstok,sisipan FROM tb_tank WHERE id = ?');
        $sth->execute(array($tank_id));

        $data = $sth->fetchAll();
        return $data;
    }
    public function insert() {
        $db = getDB();
        $sth = $db->prepare('INSERT INTO tb_tank ( id,tank,level,max_level,pa,max_pa,status,time,deadstok,sisipan) VALUES (?,?,?,?,?,?,?,NOW(),?,?)');
        $sth->execute(array($this->first_name, $this->last_name, $this->email, $this->active));
    }

    public function update() {
        $db = getDB();
        $sth = $db->prepare('UPDATE tb_tank SET id = ?,tank = ?,level = ?,max_level = ?,pa = ?,max_pa = ?,status = ?,time = Now(),deadstok = ?,sisipan = ? WHERE tank_id = ?');
        $sth->execute(array($this->id, $this->tank, $this->level, $this->max_level, $this->pa, $this->max_pa, $this->status, $this->time, $this->deadstok, $this->sisipan));
    }
    public function updateTank() {
        $db = getDB();
        $sth = $db->prepare('UPDATE tb_tank SET id = ?,tank = ?,level = ?,max_level = ?,pa = ?,max_pa = ?,status = ?,time = Now(),deadstok = ?,sisipan = ? WHERE tank_id = ?');
        $sth->execute(array($this->id, $this->tank, $this->level, $this->max_level, $this->pa, $this->max_pa, $this->status, $this->time, $this->deadstok, $this->sisipan));
    }

   
    // for ($x = 1; $x < 9; $x++) {
   // echo "The number is: $x <br>";
	//$qupd_tank = mysql_query("UPDATE tb_tank SET status = '100' WHERE id = '{$x}' LIMIT 1;");
	//}
    
    public function update100() { //UPDATE tb_tank SET status = '100' WHERE id = '{$x}' LIMIT 1;
        $db = getDB();
        for ($x = 1; $x < 9; $x++) {
        // $sth = $this->DBH->prepare('UPDATE tb_tank SET id = ?,tank = ?,level = ?,max_level = ?,pa = ?,max_pa = ?,status = ?,time = Now(),deadstok = ?,sisipan = ? WHERE tank_id = ?');
        $sth = $db->prepare('UPDATE tb_tank SET status = "100" WHERE id = "{$x}" LIMIT 1');
        $sth->execute(array($this->id, $this->status));
        }
    }

    public function delete() {
        $db = getDB();
        $sth = $db->prepare('DELETE FROM tb_tank WHERE $tank_id = ?');
        $sth->execute(array($this->tank_id));
    }
}