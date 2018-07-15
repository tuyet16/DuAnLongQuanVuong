<?php
class Areas extends Database{
    public function __construct() {
        parent::__construct(); 
    }
	public function Services(){
		$sql = "select * from districts d, areas a where d.areasID=a.areasID";
		$rs = $this->doQuery($sql);
		return $rs;	
	}
	public function Services(){
		$sql = "select * from districts d, areas a where d.areasID=a.areasID";
		$rs = $this->doQuery($sql);
		return $rs;	
	}
	
	
}
?>