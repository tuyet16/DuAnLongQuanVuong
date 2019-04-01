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
            if(isset($_GET['id']))
            {
                $masp = $_GET['id'];
                $shoppingcart = new ShoppingCart();
                $shoppingcart->cart($masp);
                $_SESSION['sosl'] = $shoppingcart->getTongsl();
                header('Location: home_controller.php?' . base64_decode($_GET['q']));
                
            }
        break;
        case 'viewcart':
            $category = new Categories();
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
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            
        break;
        case 'updatecart':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();

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
            $dt_model = new Districts();
            $DSdistrict = $dt_model->getDistrict();
            $shoppingcart = new ShoppingCart();
            $rsCart = $shoppingcart->ViewCart();
            $tongtien = $shoppingcart->getTotal();
            $GLOBALS['template']['menu'] = include_once '../template/menu.php';
            //$GLOBALS['template']['footer'] = include_once '../template/footer.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
        break;
        case 'dathang':
            $hoten = $_POST['hoten'];
            $dienthoai = $_POST['dienthoai'];
            $quan = $_POST['quan'];
            $diachi = $_POST['diachi'];
            $district = new Districts();
            $DSdistrict = $district->getByIDDistrict($quan);
            $shopping_ml = new ShoppingCart();  
            $shopping_ml->ViewCart(); 
            $tongtien = $shopping_ml->getTotal();
            $customer_id = $shopping_ml->addCustomer($hoten,$diachi,$dienthoai,$quan);
            $nguoitra = $_POST['nguoitraship'];           
            if($customer_id != Null)
            {
                $thoigian = date("Y-m-d H:i:s");
                $giaohang= $_POST['giaohang'];
                $address = $diachi.' '.$DSdistrict[0]->districtName;
                $ship = $shopping_ml->tinhphidichvu($quan,$giaohang);
                
                $bills_id = $shopping_ml->addBills($customer_id, $address, $thoigian, $giaohang, 0, $ship,$nguoitra);                 
                if($bills_id != null)
                {
                    $numberShop = $shopping_ml->countShopsFromSession($_SESSION['cart']);
                    $feePerShop = ceil($ship/$numberShop);
                    if($feePerShop%1000 != 0 ){
                        $feePerShop = intval($feePerShop/1000) * 1000 + 1000;
                    }
                    $checkShop = [];
                    foreach($_SESSION['cart'] as $masp=>$amount)
                    {
                        $model_pr = new Products();
                        $rsProducts = $model_pr->getByIDProduct($masp);
                        if($rsProducts[0]->PromotionPrice > 0):
                            $gia = $rsProducts[0]->PromotionPrice;
                            $thanhtien = $amount * $rsProducts[0]->PromotionPrice;
                        else:
                            $gia = $rsProducts[0]->price;
                            $thanhtien = $amount * $rsProducts[0]->price;
                        endif;
                        if(!in_array($rsProducts[0]->userid, $checkShop)){
                            array_push($checkShop, $rsProducts[0]->userid);
                            $detail_id = $shopping_ml->addDetails($masp, $amount, $gia, $thanhtien,  $nguoitra, $feePerShop, $bills_id);
                        }
                        else
                        {
                            
                            $detail_id = $shopping_ml->addDetails($masp, $amount, $gia, $thanhtien,  $nguoitra, 0, $bills_id);
                        }
                    }
                    unset($_SESSION['cart']); 
                    MessageBox::Show("Đặt hàng thành công", MB_SHOPPINGCART);                   
                }
            }
            else
            {
                MessageBox::Show("Hệ thống đang bảo trì,bạn vui lòng đặt hàng sau");
            } 
        break;
        case "timkiem":
                $shopcarts = new ShoppingCart();
                $tk = $shopcarts->timkiem($_POST['sdt']);
                $tt = $shopcarts->ViewCart();
                $tongtien = $shopcarts->getTotal();
                $Arrtimkiem = array();
                if($tk !=null)
                {
                    foreach($tk as $sdt)
                    {
                        $Arrtimkiem['ten'] = $sdt->customerName;
                        $Arrtimkiem['quan'] = $sdt->districtID;
                        $Arrtimkiem['diachi'] = $sdt->address;                        
                    }
                    $phiship  = $shopcarts->tinhphidichvu($Arrtimkiem['quan'],$_POST['ghthuong']);
                    $Arrtimkiem['phiship'] = number_format($phiship);
                    $Arrtimkiem['tongtien'] = number_format($tongtien);
                }
                else
                {
                    
                    $Arrtimkiem['ten'] = "";
                    $Arrtimkiem['diachi'] = "";
                }
                 echo json_encode($Arrtimkiem);
        break;
        case 'timphiship':
            $maquan = $_POST['maquan'];
            $shopcartObj = new ShoppingCart();
            $phi = $shopcartObj->timphiship($maquan);
            $jsonPhiship = [];
            $jsonPhiship['phiship'] = number_format($phi);
            echo json_encode($jsonPhiship);
        break;
        case 'changequantity':
            $productID = $_POST['productID'];
            $quantity = $_POST['quantity'];
            $shopcartObj = new ShoppingCart();
            $newprice = $shopcartObj->changeQuantity($productID, $quantity);
            $shopcartObj->ViewCart();
            $tongtien = $shopcartObj->getTotal();
            $newprice['tongcong'] = number_format($tongtien) . ' đ';
            echo json_encode($newprice);
        break;
        
    }

?>