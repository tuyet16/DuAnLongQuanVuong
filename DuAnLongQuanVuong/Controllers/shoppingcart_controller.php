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
    }

?>