<?php
class Employees extends Database{
    private $categoryId;
    private $categoryName;
    public function __construct() {
        parent::__construct();
        
    }
    public function getEmployees(){
        $query = 'SELECT * FROM employees';
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getEmployeeByID($id){   
        $query = 'SELECT * FROM employees WHERE idEm=?';
        $param = array();
        $param[] = $id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function insertNewEmployee($manv,$tennv,$diachi,$sdt){
        $query = 'INSERT INTO employees(employeeID,employeeName,address,phone)';
        $query.= ' VALUES(?,?,?,?)';
        $param = array();
        $param[] = $manv;
		$param[] = $tennv;
		$param[] = $diachi;
		$param[] = $sdt;
        $this->doQuery($query, $param);
    }
    public function deleteEmployee($id){
        $query = 'delete from employees WHERE idEm=?';
        $param = array();
        $param[]= $id;
        $this->doQuery($query, $param);
    }
    public function editEmployee($manv,$tennv,$diachi,$sdt,$id){
        $query = 'UPDATE employees SET employeeID=?,employeeName=?,address=?,phone=? WHERE idEm=?';
        $param = array();
        $param[] = $manv;
		$param[] = $tennv;
		$param[] = $diachi;
		$param[] = $sdt;
        $param[] = $id;
        $this->doQuery($query, $param);
    }
}
