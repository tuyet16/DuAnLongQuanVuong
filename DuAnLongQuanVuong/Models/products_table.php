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
        public function getByIDProduct($id)
        {
            $query ='select * from products where productID=?';
            $param= array();
            $param[]=$id;
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