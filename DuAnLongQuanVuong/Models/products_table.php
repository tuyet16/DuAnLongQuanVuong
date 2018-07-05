<?php
	class products extends Database {
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
        public function addDistricts($name)
        {
            $query = 'insert into districts(districtName) values(?)';
            $param = array();
            $param[]=$name;
            $this->doQuery($query,$param);
        }
        public function editDistricts($name,$id)
        {
            $query = 'update districts set districtName =? where districtID=?';
            $param = array();
            $param[]=$name;
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