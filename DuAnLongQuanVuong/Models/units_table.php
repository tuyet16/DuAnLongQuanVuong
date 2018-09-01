<?php
class Units extends Database{
    private $categoryId;
    private $categoryName;
    public function __construct() {
        parent::__construct();
        
    }   
    public function getUnits(){
        $query = 'SELECT * FROM units';
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getUnitByID($unit_id){   
        $query = 'SELECT * FROM units WHERE unitID=?';
        $param = array();
        $param[] = $unit_id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function insertUnit($unitName){
        $query = 'INSERT INTO units(unitName) VALUES(?)';
        $param = array();
        $param[] = $unitName;
        $this->doQuery($query, $param);
    }
    public function deleteUnit($unitID){
        $query = 'DELETE FROM units WHERE unitID=?';
        $param = array();
        $param[]= $unitID;
        $this->doQuery($query, $param);
    }
    public function editUnit($unitName, $unitID){
        $query = 'UPDATE units SET unitName=? WHERE unitID=?';
        $param = array();
        $param[] = $unitName;
        $param[] = $unitID;
        $this->doQuery($query, $param);
    }
}
