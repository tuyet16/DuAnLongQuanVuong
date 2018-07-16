<?php
class Areas extends Database{
    public function __construct() {
        parent::__construct();
        
    }
    public function getAreas(){
        $query = 'SELECT * FROM areas';
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getAreasByID($areas_id){   
        $query = 'SELECT * FROM areas WHERE areasID=?';
        $param = array();
        $param[] = $areas_id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function insertNewAreas($areas_name,$km,$often,$fast){
        $query = 'INSERT INTO areas(areasName,km,often,fast)';
        $query.= ' VALUES(?,?,?,?)';
        $param = array();
        $param[] = $areas_name;
		$param[] = $km;
		$param[] = $often;
		$param[] = $fast;
        $this->doQuery($query, $param);
    }
    public function deleteAreas($areas_id){
        $query = 'DELETE FROM areas WHERE areasID=?';
        $param = array();
        $param[]= $areas_id;
        $this->doQuery($query, $param);
    }
    public function editAreas($areas_name,$km,$often,$fast,$areas_id){
        $query = 'UPDATE areas SET areasName=?, km=?,often=?, fast=? WHERE areasID=?';
        $param = array();
        $param[] = $areas_name;
		$param[] = $km;
		$param[] = $often;
		$param[] = $fast;
        $param[] = $areas_id;
        $this->doQuery($query, $param);
    }
}
?>