<?php
class Customers extends Database {
	
		public function __construct(){
			parent::__construct();
		}
		public function getCustomers()
        {
            $query = 'select * from customers';
            $rs = $this->doQuery($query);
            return $rs;
        }
        public function getByIDCustomer($id)
        {
            $query ='select * from customers where customerID=?';
            $param= array();
            $param[]=$id;
            $rs = $this->doQuery($query,$param);
            return $rs;
        }
        public function addCustomer($name,$dc,$dt,$quan,$phuong)
        {
            $query = 'insert into customers(customerName,address,phone,districtID,wardID) values(?,?,?,?,?)';
            $param = array();
            $param[]=$name;
			$param[]=$dc;
			$param[]=$dt;
			$param[]=$quan;
			$param[]=$phuong;
            $this->doQuery($query,$param);
        }
        public function editCustomer($name,$dc,$dt,$quan,$phuong,$id)
        {
            $query = 'update customers set customerName=?, address=?, phone=?, districtID=?, wardID=?  where customerID=?';
            $param = array();
           	$param[]=$name;
			$param[]=$dc;
			$param[]=$dt;
			$param[]=$quan;
			$param[]=$phuong;
			$param[]=$id;
            $this->doQuery($query,$param);
        }
        public function deleteCustomer($id)
        {
            $query = 'delete from customers where customerID=?';
            $param= array();
            $param[]=$id;
            $this->doQuery($query,$param);
        }
	}
?>