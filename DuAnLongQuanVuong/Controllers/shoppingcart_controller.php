<?php 
     include_once('../Config/bootload.php');
    $action = filter_input(INPUT_GET,'action');
    if($action==NUll)
    {
        $action =filter_input(INPUT_POST,'action');
        if($action==Null)
        {
            $action ='index';
        }
    }
    switch($action)
    {
        case 'add':
            if(isset($_GET['id']))
            {
                $masp = $_GET['id'];
                $shoppingcart = new ShoppingCart();
                $_SESSION['sosl'] = $shoppingcart->getTongsl();
                $shoppingcart->cart($masp);
                //MessageBox::Show('Giỏ hàng có sản phẩm');
                header('Location: home_controller.php');
            }
        break;
        case 'viewcart':
            $view = Page::View();
            $shoppingcart = new ShoppingCart();
            $rsCart = $shoppingcart->ViewCart();
            $tongtien = $shoppingcart->getTotal();
            $_SESSION['sosl'] = $shoppingcart->getTongsl();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
            
        break;
        case 'updatecart':
            $shopcart = new ShoppingCart();
            $_SESSION['sosl'] = $shopcart->getTongsl();
            if(isset($_POST['submit'])){
                foreach($_POST as $masp=>$sl):
                    if($masp != 'submit'):
                        $shopcart->UpdateCart($masp, $sl);
                    endif;
                endforeach;
            }
            header('Location: shoppingcart_controller.php?action=viewcart');
        break;
        case 'deletecart':
            if(isset($_GET['id']))
            {
                $masp = $_GET['id'];
                $shopcart = new ShoppingCart();
                $shopcart->DeleteCart($masp);
                $_SESSION['sosl'] = $shopcart->getTongsl();
            }
            header('Location: shoppingcart_controller.php?action=viewcart');            
        break;
        case 'muahang':
            $view = Page::View();
            $dt_model = new districts();
            $DSdistrict = $dt_model->getDistrict();
            $model = new Wards();
            $dsWards = $model->getWards();
            $shoppingcart = new ShoppingCart();
            $rsCart = $shoppingcart->ViewCart();
            $tongtien = $shoppingcart->getTotal();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
        break;
        case 'dathang':
            $hoten = $_POST['hoten'];
            $dienthoai = $_POST['dienthoai'];
            $quan = $_POST['quan'];
            $diachi = $_POST['diachi'];
            $district = new districts();
            $DSdistrict = $district->getByIDDistrict($quan);
            $shopping_ml = new ShoppingCart();  
            $shopping_ml->ViewCart(); 
            $tongtien = $shopping_ml->getTotal();
            $customer_id = $shopping_ml->addCustomer($hoten,$diachi,$dienthoai,$quan);
            if($customer_id !=Null)
            {
                $thoigian = date("Y-m-d H:i:s");
                $giaohang= $_POST['giaohang'];
                if($giaohang =='thuong')
                {
                    $giaohang = 'Giao thường';
                }
                else
                {
                    $giaohang = 'Giao nhanh';
                }
                $address = $diachi.' '.$dsWards[0]->wardName.' '.$DSdistrict[0]->districtName;
                $bills_id = $shopping_ml->addBills($customer_id,$address,$thoigian,$giaohang,$tongtien);
                if($bills_id !=null)
                {
                    foreach($_SESSION['cart'] as $masp=>$amount)
                    {
                        $model_pr = new products();
                        $rsProducts = $model_pr->getByIDProduct($masp);
                        $thanhtien = $amount * $rsProducts[0]->price;
                        $detail_id = $shopping_ml->addDetails($masp,$amount,$thanhtien,$bills_id);
                    }
                    unset($_SESSION['cart']); 
                    header('Location: home_controller.php');                   
                }
            }
            else
            {
                MessageBox::Show("Hệ thống đang bảo trì,bạn vui lòng đặt hàng sau");
            }
            
                
            
        break;
    }

?>