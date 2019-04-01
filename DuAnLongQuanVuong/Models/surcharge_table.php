<?php
class Surcharge extends Database{
    public function __construct() {
        parent::__construct();
        
    }
    public function getSurcharge(){
        $query = 'SELECT * FROM surcharge';
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getSurchargeByID($surcharge_id){   
        $query = 'SELECT * FROM surcharge WHERE surchargeID=?';
        $param = array();
        $param[] = $surcharge_id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function addSurcharge($name,$nd){
        $query = 'INSERT INTO surcharge(surchargeName,content) VALUES (?,?)';
        $param = array();
        $param[] = $name;
		$param[] = $nd;
        $this->doQuery($query, $param);
    }
    public function deleteSurcharge($surcharge_id){
        $query = 'DELETE FROM surcharge WHERE surchargeID=?';
        $param = array();
        $param[]= $surcharge_id;
        $this->doQuery($query, $param);
    }
    public function editSurcharge($name,$nd,$surcharge_id){
        $query = 'UPDATE surcharge SET surchargeName=?, content=? WHERE surchargeID=?';
        $param = array();
        $param[] = $name;
		$param[] = $nd;
        $param[] = $surcharge_id;
        $this->doQuery($query, $param);
    }
}
?>