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
         $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
            if(isset($_GET['id']))
            {
                $masp = $_GET['id'];
                $shoppingcart = new ShoppingCart();
                $shoppingcart->cart($masp);
                $_SESSION['sosl'] = $shoppingcart->getTongsl();
                //MessageBox::Show('Giỏ hàng có sản phẩm');
                header('Location: home_controller.php');
            }
        break;
        case 'viewcart':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
            $category = new Categories();
            
            $dsCategories = $category->getCategories();
            if(isset($_SESSION['userid']))
            {
                $id = $_SESSION['userid'];
                $rsCategories = $category->getDScategory($id);                
            }  
            $shoppingcart = new ShoppingCart();
            
            $view = Page::View();
            
            $rsCart = $shoppingcart->ViewCart();
            $tongtien = $shoppingcart->getTotal();
            $category = new Categories();
            $dsCategories = $category->getCategories();
            $_SESSION['sosl'] = $shoppingcart->getTongsl();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
            
        break;
        case 'updatecart':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
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
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
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
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
            $quan = $_POST['quan'];
            $giaohang= $_POST['giaohang'];
            $view = Page::View();
            $dt_model = new districts();
            $DSdistrict = $dt_model->getDistrict();
            $shoppingcart = new ShoppingCart();
            
            $ship = $shoppingcart->tinhphidichvu($quan,$giaohang);
            $rsCart = $shoppingcart->ViewCart();
            $tongtien = $shoppingcart->getTotal();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
        break;
        case 'dathang':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
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
            $nguoitra = $_POST['nguoitraship'];
            if($customer_id !=Null)
            {
                $thoigian = date("Y-m-d H:i:s");
                $giaohang= $_POST['giaohang'];
                $address = $diachi.' '.$DSdistrict[0]->districtName;
                $ship = $shopping_ml->tinhphidichvu($quan,$giaohang);
               // echo $ship;
                $bills_id = $shopping_ml->addBills($customer_id,$address,$thoigian,$giaohang,$tongtien,$ship,$nguoitra);                 
                if($bills_id !=null)
                {
                    foreach($_SESSION['cart'] as $masp=>$amount)
                    {
                        $model_pr = new products();
                        $rsProducts = $model_pr->getByIDProduct($masp);
                        $gia = $rsProducts[0]->price;
                        $thanhtien = $amount * $rsProducts[0]->price;
                        $detail_id = $shopping_ml->addDetails($masp,$amount,$gia,$thanhtien,$ship,$bills_id);
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
        case "timkiem":
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
                $shopcarts = new ShoppingCart();
                $tk = $shopcarts->timkiem($_POST['sdt']);
                if($tk !=null)
                {
                    $Arrtimkiem = array();
                    foreach($tk as $sdt)
                    {
                        $Arrtimkiem['ten'] = $sdt->customerName;
                        $Arrtimkiem['quan'] = $sdt->districtID;
                        $Arrtimkiem['diachi'] = $sdt->address;                        
                    }
                }
                else
                {
                    $Arrtimkiem['ten'] = " ";
                    $Arrtimkiem['quan'] = " ";
                    $Arrtimkiem['diachi'] = "";
                   
                }
                 echo json_encode($Arrtimkiem);
        break;
        
    }

?>