<?php 
    class ShoppingCart extends Database{
        private $total = 0;
        private $tongsl =1;
        public function __construct(){
			parent::__construct();
		}
        public function cart($masp)
        {
            // nến chưa có giỏ hàng
            if(!isset($_SESSION['cart']))
            {
                $_SESSION['cart'] = array();
                $_SESSION['cart'][$masp]=1;
            }
            else
            {
                if(!isset($_SESSION['cart'][$masp]))
                {
                    $_SESSION['cart'][$masp]=1;
                }
                else
                {
                    $_SESSION['cart'][$masp]++;
                }
            }
        }
        
        public function UpdateCart($masp,$soluong)
        {
            $_SESSION['cart'][$masp] = $soluong;
        }
        public function DeleteCart($masp)
        {
            unset($_SESSION['cart'][$masp]);
        }
        public function ViewCart()
        {
            $cart_object = array();
            if(!isset($_SESSION['cart']))
            {
                echo 'Không có sản phẩm nào trong giỏ';
            }
            else
            {
                if(count($_SESSION['cart'])==0)
                {
                    echo 'Không có sản phẩm nào trong giỏ';
                }
                else
                {
                    
                    foreach($_SESSION['cart'] as $masp=>$soluong)
                    {
                        $product_model = new products();
                        $rsProduct = $product_model->getByIDProduct($masp);
                        $thanhtien = $soluong * $rsProduct[0]->price;
                        $this->total += $thanhtien;
                        $cart_object[] = array('hinhanh'=>$rsProduct[0]->image,
                                              'name'=>$rsProduct[0]->productName,
                                              'soluong'=>$soluong,
                                              'gia'=>$rsProduct[0]->price,
                                              'thanhtien'=>$thanhtien,
                                              'masp'=>$masp);                                                
                    }                  
                }
            }
            return $cart_object;
        }
        public function getTotal(){
            return $this->total;
        }
        public function getTongsl(){
            if(isset($_SESSION['cart']))
            {
                $tongsl = count($_SESSION['cart']);
            }
            return $tongsl;
        }
        public function addCustomer($name,$dc,$dt,$districtID)
        {
            $query = 'insert into customers(customerName,address,phone,districtID) values(?,?,?,?)';
            $param = array();
            $param[]=$name;
			$param[]=$dc;
			$param[]=$dt;
			$param[]=$districtID;
            $rs = $this->doQuery($query,$param);
            $con = $this->getconnect();
            return $con->lastInsertId('customerID');
        }
        public function addBills($customerID,$billing,$date,$loaiship,$tongtien,$ship)
        {
            $query = 'insert into bills(customerID,billingAddress,PurchaseDate,delivery,totalPrice,phiship) values(?,?,?,?,?,?)';
            $param = array();
            $param[]=$customerID;
			$param[]=$billing;
			$param[]=$date;
			$param[]=$loaiship;
            $param[]=$tongtien;
            $param[] =$ship;
            $this->doQuery($query,$param);
            $con = $this->getconnect();
            return $con->lastInsertId('billID');
        }
        public function addDetails($prodcutID,$amount,$price,$billID)
        {
            $query ='insert into detailsbills(productID,amount,price,billID) values(?,?,?,?)';
            $param = array();
            $param[] = $prodcutID;
            $param[] = $amount;
            $param[] = $price;
            $param[] = $billID;
            $this->doQuery($query,$param);
        }
        public function tinhphidichvu($quan,$giaohang)
        {
            if($giaohang == 0)
            {
               $sql ='select distinct ar.often as phiship from customers cs, districts ds ,areas ar where cs.districtID=ds.districtID
                     and ar.areasID =ds.areasID and ds.districtID=?';           
            }
            else
            {
                $sql ='select distinct ar.fast as phiship from customers cs, districts ds ,areas ar where cs.districtID = ds.districtID
                     and ar.areasID =ds.areasID and ds.districtID=?';                
            }
            $param = array();
            $param[] = $quan;
            $rs = $this->doQuery($sql,$param);
            return $rs[0]->phiship;
        }
      
    }
    
?>