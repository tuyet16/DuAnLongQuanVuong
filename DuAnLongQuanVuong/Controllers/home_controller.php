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
        case 'index':
       	    //end mail
             $product_model = new Products();
            //$dsProducts = $product_model->getProduct();
            $category = new Categories();
            $dsCategories = $category->getCategories();
            $productsObj= new Products();
            $rsMostViewProduct = $productsObj->getMostView();
            $rsNewProduct = $productsObj->getNewProducts();
            if(isset($_SESSION['userid']))
            {
                $id = $_SESSION['userid'];
                $rsCategories = $category->getDScategory($id);                  
            }  
            //if(isset($_GET['id']))
//            {
//                $id = $_GET['id'];
//                $product = new products();
                //$start = 0;
//                if(isset($_GET['start']))
//                {
//                    $start= $_GET['start'];
//                }                
//                $rsProducts = $product_model->phantrangchu($start);
//                $rsProductPage = $product_model->phantrangchu();
//                $pagination = Page::createPagination($rsProductPage);             
         //   }
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once '../template/menu.php';
            $GLOBALS['template']['carousel'] = include_once '../template/carousel.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');          
        break;        
        case 'xemsanpham':    
            if(isset($_GET['id'])){
                $cate_id = $_GET['id'];
            }
            if(isset($_GET['id_pr'])){
                $id_pr = $_GET['id_pr'];
            }
            $category = new Categories();
            $rsCategory = $category->getCategoryByID($cate_id);
            $category_name = $rsCategory[0]->categoryName;    
            $product = new Products(); 
            //$rsProductsByCategory = $product->getProductBycategoryID($cate_id) ;           
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $product = new Products();  
                $start = 0;
                if(isset($_GET['start']))
                {
                    $start= $_GET['start'];
                }                
                $rsProducts = $product->phantrangHome($id,$start);
                $rsProductPage = $product->phantrangHome($id);
                $pagination = Page::createPagination($rsProductPage);                
            }
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once '../template/menu.php';
            $GLOBALS['template']['carousel'] = include_once '../template/carousel.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');           
        break;
        case 'chitiet':
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $productsObj = new Products();
                $rs_chi_tiet_san_pham = $productsObj->getByIDProduct($id);
                $productsObj->countViewProduct($id);
                $rsOtherProductShop = $productsObj->getProductsOfShop($id);
                $view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['footer'] = include_once'../template/footer.php';
                include_once('../template/index.php');    
            }
            else{
                header("Location: home_controller.php");
            }
        break;
        case 'dathang':
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
        case 'nhanship':
            $districtObj = new Districts();
            $rsDistrict = $districtObj->getDistrict();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
        break;
        case 'nhanhoadonship':
            if(isset($_POST['submit'])){
                $date = date_create();
                $start_date = $date->format('Y-m-d h:i:s');
                $shop_service_invoice_obj = new ShipServiceInvoice();
                $shop_service_invoice_obj->AddShipServiceInVoice($_POST['tenshop'],
                                                                $_POST['diachishop'],
                                                                $_POST['dienthoaishop'], 
                                                                $_POST['shopdistrict'],
                                                                $_POST['tennguoinhan'],
                                                                $_POST['district'],
                                                                $_POST['diachinguoinhan'],
                                                                $_POST['dienthoainguoinhan'],
                                                                $_POST['tienhang'], 
                                                                $_POST['tienship'],
                                                                $start_date,
                                                                $_POST['customer_require']
                                                                );
                //header('Location: /');
                MessageBox::Show("Đặt hàng thành công", MB_SHOPPINGCART);
               
            }
        break;
    }
    
?>