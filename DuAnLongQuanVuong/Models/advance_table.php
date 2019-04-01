<?php
class Advance extends Database{
    public function __construct() {
        parent::__construct();
    }
    public function getAdvance(){
        $query = 'SELECT * FROM advance';
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getAdvanceByID($advance_id){   
        $query = 'SELECT * FROM advance WHERE advanceID=?';
        $param = array();
        $param[] = $advance_id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function insertNewAdvance($money,$name){
        $query = 'INSERT INTO advance(money,advanceName)';
        $query.= ' VALUES(?,?)';
        $param = array();
        $param[] = $money;
		$param[] = $name;
        $this->doQuery($query, $param);
    }
    public function deleteAdvance($advance_id){
        $query = 'DELETE FROM advance WHERE advanceID=?';
        $param = array();
        $param[]= $advance_id;
        $this->doQuery($query, $param);
    }
    public function editAdvance($money,$name,$advance_id){
        $query = 'UPDATE advance SET money=?, advanceName=? WHERE advanceID=?';
        $param = array();
        $param[] = $money;
		$param[] = $name;
        $param[] = $advance_id;
        $this->doQuery($query, $param);
    }
}
?>