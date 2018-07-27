<?php
	class districts extends Database {
		public function __construct(){
			parent::__construct();
		}
		public function getDistrict()
        {
            $query = 'select * from districts';
            $rs = $this->doQuery($query);
            return $rs;
        }
        public function getByIDDistrict($id)
        {
            $query ='select * from districts where districtID=?';
            $param= array();
            $param[]=$id;
            $rs = $this->doQuery($query,$param);
            return $rs;
        }
        public function addDistricts($name,$areas)
        {
            $query = 'insert into districts(districtName,areasID) values(?,?)';
            $param = array();
            $param[]=$name;
			$param[]=$areas;
            $this->doQuery($query,$param);
        }
        public function editDistricts($name,$areas,$id)
        {
            $query = 'update districts set districtName =?,areasID=? where districtID=?';
            $param = array();
            $param[]=$name;
			$param[]=$areas;
            $param[]=$id;
            $this->doQuery($query,$param);
        }
        public function deleteDistrict($id)
        {
            $query = 'delete from districts where districtID=?';
            $param= array();
            $param[]=$id;
            $this->doQuery($query,$param);
        }
   
	}
?>