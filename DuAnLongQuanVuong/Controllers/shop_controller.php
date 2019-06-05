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
            if(isset($_SESSION['userid']))
            {
                $userid = $_SESSION['userid'];                  
                $bills = new Bills();
                $rsBillByDate = $bills->getInvoicebyShopId($userid);
                $start = 0;
                if(isset($_GET['start']))
                {
                    $start= $_GET['start'];
                }   
                            
                //$rsProducts = $product_model->phantrangHome($userid,$start);
                //$rsProductPage = $product_model->phantrangHome($userid);
                //$pagination = Page::createPagination($rsProductPage);    
                //print_r($rsProducts);             
            }
            else
            {
                header('Location:home_controller.php');
            } 
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once '../template/shopmenu.php'; 
            $GLOBALS['template']['content'] = include_once $view;
            //$GLOBALS['template']['leftmenu'] = include_once '../template/shopleftmenu.php';
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');           
        break;
        case 'xemsanpham':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            if(isset($_SESSION['userid']))
            {
                $userid = $_SESSION['userid'];
                $category = new Categories(); 
                $dsCategories = $category->getDScategory($userid);
            }
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $product = new Products();
                $start = 0;
                if(isset($_GET['start']))
                {
                    $start= $_GET['start'];
                }                
                $rsProducts = $product->phantrang($id,$userid,$start);
                $rsProductPage = $product->phantrang($id,$userid);
                $pagination = Page::createPagination($rsProductPage);
                
            }
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once '../template/shopmenu.php';
            
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');           
        break;
        case 'dangnhap':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
			$tableDB = new Database();
            $tables = $tableDB->getTables();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/shopmenu.php';
            
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
        break;
        case 'suasanpham':
            
            if(isset($_SESSION['userid']))
            {
                $userid = $_SESSION['userid'];
                $category = new Categories(); 
                $dsCategories = $category->getDScategory($userid);
            }
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/shopmenu.php';
            
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
         case 'themsanpham':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
            $tableDB = new Database();
            $tables = $tableDB->getTables();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
         case 'donhang':
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
         
            case 'doanhthu':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
          
            $tableDB = new Database();
            $tables = $tableDB->getTables();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
         case 'shopchangequantity':
            $detailId = $_POST['detailID'];
            $quantity = $_POST['quantity'];
            $billObj = new Bills();
            $billObj->changeDetailProductQuantiy($detailId, $quantity);
            $rsDetail = $billObj->getDetailById($detailId);
            $detailJSON = [];
            $detailJSON['total'] = $rsDetail[0]->thanhtien;
            echo json_encode($detailJSON);
         break;
         case 'shopupdateinvoice':
            ?>
            <script>
                window.location.reload();
            </script>
            <?php
         break;
        case 'xemdanhmucsanpham':            
        if(isset($_SESSION['userid']))
            {
                $userid = $_SESSION['userid'];                  
                $product_model = new Products();
                $dsProducts = $product_model->getProductByuserid($userid);    
                $start = 0;
                if(isset($_GET['start']))
                {
                    $start= $_GET['start'];
                }   
                            
                //$rsProducts = $product_model->phantrangHome($userid,$start);
                //$rsProductPage = $product_model->phantrangHome($userid);
                //$pagination = Page::createPagination($rsProductPage);    
                //print_r($rsProducts);             
            }
            else
            {
                header('Location:home_controller.php');
            } 
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once '../template/shopmenu.php'; 
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');       
         break;
         case 'shopinvoices':
            if(isset($_SESSION['userid']))
            {
                $userid = $_SESSION['userid'];                  
                $bills = new Bills();
                $rsBillByDate = $bills->getInvoicebyShopId($userid);
                $start = 0;
                if(isset($_GET['start']))
                {
                    $start= $_GET['start'];
                }   
                            
                //$rsProducts = $product_model->phantrangHome($userid,$start);
                //$rsProductPage = $product_model->phantrangHome($userid);
                //$pagination = Page::createPagination($rsProductPage);    
                //print_r($rsProducts);             
            }
            else
            {
                header('Location:home_controller.php');
            } 
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once '../template/shopmenu.php'; 
            $GLOBALS['template']['content'] = include_once $view;
            //$GLOBALS['template']['leftmenu'] = include_once '../template/shopleftmenu.php';
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');        
         break;
         case 'shopedit':
            if(isset($_POST['submit']))
            { 
                $tong = 1;
                $tongtien = 0;
                $detailBillID;
                //$billID = $_POST['billID'];
                $user = new Users();
                foreach($_POST as $detail_id=>$edit)
                {
                    if($detail_id != 'submit')
                    {                      
                        if(strpos($detail_id,'giamgia') === false && strpos($detail_id,'gia') === false)
                        {
                            if(is_numeric($detail_id)){
                              //echo $detail_id.'<br>';
                              $detailBillID = $detail_id;              
                            $tong *= $_POST[$detail_id] * $_POST['gia' . $detail_id] * ((100 - $_POST['giamgia' . $detail_id])/100);
                            $user->editDetailPriceByID($_POST[$detail_id], $tong, $_POST['giamgia'.$detail_id], $_POST['nguoitraship'],$detail_id);
                            $tongtien += $tong;
                            $tong=1;
                            //echo $_POST['nguoitraship'] . '--' . $_POST['phishipshop'] . '---' . $_POST['phishipkh'] . '<br/><br/>'; 
                            }        
                        }
                    }
                    
                }
                
                $phishipshop = $_POST['nguoitraship'];
                
                if($_POST['phishipshop'] == 0){
                    $user->editShipFee($phishipshop, $detailBillID);
                }
                else{
                    $user->editShipFee($phishipshop, $detailBillID, 1);
                }                    
                header('Location: shop_controller.php');
            }
        break;
        case 'guidonhang':
            $guidonhang=0;
            $user = new Users();    
            if(isset($_GET['detail_id']))
            {
                $id= $_GET['detail_id'];
                $guidonhang = $user->guidonhang($id);
            }
            header('Location: shop_controller.php');
        break;
        case 'xoasanpham':
            if(isset($_GET['detailID'])){
                $user = new Users();
                $user->deleteDetailID($_GET['detailID']);
            }   
            header('location: shop_controller.php');         
        break;
    }
    
?>