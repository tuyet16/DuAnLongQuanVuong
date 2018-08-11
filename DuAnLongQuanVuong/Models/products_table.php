<?php
	class products extends Database {
		public function __construct(){
			parent::__construct();
		}
		public function getProduct()
        {
            $query = 'select * from products';
            $rs = $this->doQuery($query);
            return $rs;
        }
        public function getProductBycategoryID($id)
        {
            $query= 'select * from products where categoryID =?';
            $param = array();
            $param[] = $id;
            $rs= $this->doQuery($query,$param);
            return $rs;
        }
        public function getProductByuserid($id)
        {
            $query= 'select * from products where userid =?';
            $param = array();
            $param[] = $id;
            $rs= $this->doQuery($query,$param);
            return $rs;
        }
        public function getByIDProduct($id)
        {
            $query ='select * from products where productID=?';
            $param= array();
            $param[]=$id;
            $rs = $this->doQuery($query,$param);
            return $rs;
        }
        public function phantrang($id,$userid,$start=-1,$limit=1)
        {
            if($start==-1)
            {
                $query = 'select *from products where categoryID = ? and userid =?';                    
            }
            else
            {
                $query = 'select * from products where categoryID=? and userid=? LIMIT '.$start.','.$limit;
            }
            $param = array();
            $param[] = $id;   
            $param[] = $userid;
            $rs = $this->doQuery($query,$param);
            return $rs;
        }
        public function phantrangHome($id,$start=-1,$limit=1)
        {
            if($start==-1)
            {
                $query = 'select *from products where categoryID = ?';                    
            }
            else
            {
                $query = 'select * from products where categoryID=? LIMIT '.$start.','.$limit;
            }
            $param = array();
            $param[] = $id;   
            $rs = $this->doQuery($query,$param);
            return $rs;
        }
        public function addProduct($name,$categoryID,$userid,$unit,$price,$hinhanh)
        {
            $query = 'insert into products(productName,categoryID,userid,unitID,price,image) values(?,?,?,?,?,?)';
            $param = array();
            $param[]=$name;
            $param[]= $categoryID;
            $param[] = $userid;
            $param[] = $unit;
            $param[] = $price;
            $param[] = $hinhanh;
            $this->doQuery($query,$param);
        }
        public function editProduct($name,$categoryID,$unit,$price,$hinhanh,$id)
        {
            $query = 'update products set productName=?,categoryID=?,unitID=?,price=?,image=? where productID=?';
            $param = array();
            $param[]=$name;
            $param[]= $categoryID;
            $param[] = $unit;
            $param[] = $price;
            $param[] = $hinhanh;
            $param[]=$id;
            $this->doQuery($query,$param);
        }
        public function deleteProduct($id)
        {
            $query = 'delete from products where productID=?';
            $param= array();
            $param[]=$id;
            $this->doQuery($query,$param);
        }
	}
?>