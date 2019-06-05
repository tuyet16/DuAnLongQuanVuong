<?php
	class Products extends Database {
		public function __construct(){
			parent::__construct();
		}
		public function getProduct()
        {
            $query = 'select * from products order by created desc, productID desc';
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
            $productByCate = [];
            $query= 'select DISTINCT c.categoryID, c.categoryName 
                    FROM products p, categories c 
                    WHERE p.categoryID = c.categoryID AND p.userid=?
                    Order by c.categoryName ASC
                    ';
            $param = array();
            $param[] = $id;
            $rs= $this->doQuery($query,$param);
            foreach($rs as $category):
                $productByCate['cateInfo'][$category->categoryID] = ['cateId'=>$category->categoryID, 
                                                                    'cateName'=>$category->categoryName,
                                                                    'productCategory'=>[]];
                $sql = "
                        SELECT DISTINCT productID, productName, price, PromotionPrice, StartDate, EndDate, image, count
                        FROM products p, units u
                        WHERE p.userid = ? AND p.categoryID = ?
                        "; 
                $param = [];
                $param[] = $id;
                $param[] = $category->categoryID;
               
                $rsProduct = $this->doQuery($sql, $param);
                foreach($rsProduct as $product):
                    $productByCate['cateinfo'][$category->categoryID]['productCategory'][] = ['productID'=>$product->productID,
                                                                            'productName'=>$product->productName,
                                                                            'price'=>$product->price,
                                                                            'PromotionPrice'=>$product->PromotionPrice,
                                                                            'StartDate'=>$product->StartDate,
                                                                            'EndDate'=>$product->EndDate,
                                                                            'image'=>$product->image,
                                                                            'count'=>$product->count                                                                           
                                                                            
                                                                            ]; 
                endforeach;
            endforeach;
            return $productByCate;
        }
        public function UpdateCountProduct($count,$masp)
        {
            $sql = "UPDATE products SET count = ? WHERE productID=?";
            $param = [];
            $param[] = $count;
            $param[] = $masp;
            $this->doQuery($sql, $param);
        }
        public function getByIDProduct($id)
        {
            $query ='select p.*, u.unitName, c.categoryName  
                    from products p, units u, categories c 
                    where p.productID=? AND p.unitID = u.unitID AND p.categoryID = c.categoryID';
            $param= array();
            $param[]=$id;
            $rs = $this->doQuery($query,$param);
            return $rs;
        }
        public function countViewProduct($id)
        {
            $sql = "SELECT viewnumber
                    FROM products
                    WHERE productID = ?
                    ";
            $param = [];
            $param[] = $id;
            $rs = $this->doQuery($sql, $param);
            $views = $rs[0]->viewnumber + 1;
            $sql = "UPDATE products SET viewnumber = ? WHERE productID = ?";
            $param = [];
            $param[] = $views;
            $param[] = $id;
            $this->doQuery($sql, $param);
        }
        public function getMostView(){
            $c = parse_ini_file('../Config/config.ini', true);
            $sql = "SELECT p.productID, p.productName, p.price, p.PromotionPrice, p.image, u.unitName, c.categoryID, c.categoryName  
                    FROM  products p, units u, categories c
                    WHERE p.unitID = u.unitID AND p.categoryID = c.categoryID
                    ORDER BY p.viewnumber DESC 
                    LIMIT 0," . $c['mostviewproduct']['quantity'];
            $rs = $this->doQuery($sql);
            return $rs;
        }
        public function getNewProducts()
        {
            $c = parse_ini_file('../Config/config.ini', true);
            $sql = "SELECT p.productID, p.productName, p.price, p.PromotionPrice, p.image, u.unitName, c.categoryID, c.categoryName  
                    FROM  products p, units u, categories c
                    WHERE p.unitID = u.unitID AND p.categoryID = c.categoryID AND DATEDIFF(NOW(), p.created) < 30
                    ORDER BY p.created DESC 
                    LIMIT 0," . $c['newproduct']['quantity'];
            $rs = $this->doQuery($sql);
            return $rs;
        }
        public function getProductsOfShop($productID)
        {
            $sql = "SELECT p.productID, p.productName, p.price, p.PromotionPrice, p.image, u.unitName  
                    FROM products p, units u
                    WHERE userid = (SELECT userid FROM products WHERE productID=?)
                            AND p.unitID = u.unitID
                    ORDER BY p.productName ASC
                    ";
            $param = [];
            $param[] = $productID;
            $rs = $this->doQuery($sql, $param);
            return $rs;
        }
        public function phantrang($id,$userid,$start=-1,$limit=12)
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
        public function phantrangchu($start=-1,$limit=12)
        {
            if($start==-1)
            {
                $query = 'select *from products';                    
            }
            else
            {
                $query = 'select * from products LIMIT '.$start.','.$limit;
            }
            //$param = array();
//            $param[] = $id;   
            $rs = $this->doQuery($query);
            return $rs;
        }
        public function phantrangHome($id,$start=-1,$limit=12)
        {
            if($start==-1)
            {
                $query = 'select p.*, u.unitName from products p, units u where p.categoryID = ? AND p.unitID = u.unitID';                    
            }
            else
            {
                $query = 'select p.*, u.unitName from products p, units u where p.categoryID = ? AND p.unitID = u.unitID LIMIT '.$start.','.$limit;
            }
            $param = array();
            $param[] = $id;   
            $rs = $this->doQuery($query,$param);
            return $rs;
        }
        public function addProduct($name,$categoryID,$userid,$unit,$price,$khuyenmai, $hinhanh, $subImageArr, $description,$count)
        {
            
            $query = 'insert into products(productName,categoryID,userid,unitID,price, PromotionPrice, image, image1, image2, image3, image4, image5, description, created,count) 
                        values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
            $param = array();
            $param[]=$name;
            $param[]= $categoryID;
            $param[] = $userid;
            $param[] = $unit;
            $param[] = $price;
            $param[] = $khuyenmai;
            $param[] = $hinhanh;
            for($i = 0 ; $i < 5; $i++){
                $param[] = $subImageArr[$i];
            }
            $param[] = $description;
            $dt = date_create('');
            $date = date_format($dt,'Y-m-d');
            $param[] = $date;
            $param[]= $count;
            $this->doQuery($query,$param);
        }
        public function editProduct($name,$categoryID,$unit,$price,$promotionPrice, $hinhanh,$description, $subImageArr,$count, $id)
        {
            $query = 'update products set 
                                productName=?,
                                categoryID=?,
                                unitID=?,
                                price=?,
                                PromotionPrice=?,
                                image=?,
                                image1=?,
                                image2=?,
                                image3=?,
                                image4=?,
                                image5=?,
                                description=?, 
                                count=?
                                where productID=?';
            $param = array();
            $param[]=$name;
            $param[]= $categoryID;
            $param[] = $unit;
            $param[] = $price;
            $param[] = $promotionPrice;
            $param[] = $hinhanh;
            for($i = 0; $i < 5; $i++ ){
                $param[] = $subImageArr[$i];
            }
            $param[] = $description;
            $param[] = $count;
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