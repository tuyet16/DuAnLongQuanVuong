<?php 
    class ShoppingCart extends Database{
        private $total = 0;
        private $tongsl =0;
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
    }
    
?>