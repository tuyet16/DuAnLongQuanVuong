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
        $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();		
             $product_model = new products();
            //$dsProducts = $product_model->getProduct();
            $category = new Categories();
            $dsCategories = $category->getCategories();
            if(isset($_SESSION['userid']))
            {
                $id = $_SESSION['userid'];
                $rsCategories = $category->getDScategory($id);                  
            }  
            //if(isset($_GET['id']))
//            {
//                $id = $_GET['id'];
//                $product = new products();
                $start = 0;
                if(isset($_GET['start']))
                {
                    $start= $_GET['start'];
                }                
                $rsProducts = $product_model->phantrangchu($start);
                $rsProductPage = $product_model->phantrangchu();
                $pagination = Page::createPagination($rsProductPage);             
         //   }
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once '../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once '../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');          
        break;        
        case 'xemsanpham':    
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();      
            $category = new Categories(); 
            $dsCategories = $category->getCategories();
           // $rsCategories = $category->getCategoryByID($id);           
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $product = new products();
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
            $GLOBALS['template']['leftmenu'] = include_once '../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');           
        break;
        case 'chitiet':
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
		 	$category = new Categories(); 
            $dsCategories = $category->getCategories();
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $productsObj = new products();
                $rs_chi_tiet_san_pham = $productsObj->getByIDProduct($id);
            }
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
        break;
        case 'dathang':
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
    }
    
?>