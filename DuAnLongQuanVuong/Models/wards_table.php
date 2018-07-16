<?php
class Wards extends Database{
    public function __construct() {
        parent::__construct();
        
    }
    public function getWards(){
        $query = 'SELECT * FROM wards';
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getWardByID($ward_id){   
        $query = 'SELECT * FROM wards WHERE wardID=?';
        $param = array();
        $param[] = $ward_id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function insertNewWard($ward_name){
        $query = 'INSERT INTO wards(wardName)';
        $query.= ' VALUES(?)';
        $param = array();
        $param[] = $ward_name;
        $this->doQuery($query, $param);
    }
    public function deleteWard($ward_id){
        $query = 'DELETE FROM wards WHERE wardID=?';
        $param = array();
        $param[]= $ward_id;
        $this->doQuery($query, $param);
    }
    public function editWard($ward_name,$district, $ward_id){
        $query = 'UPDATE wards SET wardName=?,districtID=?  WHERE wardID=?';
        $param = array();
        $param[] = $ward_name;
		$param[]=$district;
        $param[] = $ward_id;
        $this->doQuery($query, $param);
    }
}
?>