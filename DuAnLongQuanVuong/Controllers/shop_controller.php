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
                $category = new Categories(); 
                $dsCategories = $category->getDScategory($userid);
                $product_model = new products();
               // $dsProducts = $product_model->getProductByuserid($userid);     
            
            
                $start = 0;
                if(isset($_GET['start']))
                {
                    $start= $_GET['start'];
                }                
                $rsProducts = $product_model->phantrangHome($userid,$start);
                $rsProductPage = $product_model->phantrangHome($userid);
                $pagination = Page::createPagination($rsProductPage);                
            }
            else
            {
                header('Location:home_controller.php');
            } 
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once '../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once '../template/shopleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');           
        break;
        case 'xemsanpham':
            if(isset($_SESSION['userid']))
            {
                $userid = $_SESSION['userid'];
                $category = new Categories(); 
                $dsCategories = $category->getDScategory($userid);
            }
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $product = new products();
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
            $GLOBALS['template']['menu'] = include_once '../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once '../template/shopleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');           
        break;
        case 'dangnhap':
			$tableDB = new Database();
            $tables = $tableDB->getTables();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
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
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
         case 'themsanpham':
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
            $tableDB = new Database();
            $tables = $tableDB->getTables();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
            $GLOBALS['template']['content'] = include_once '';
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
         
            case 'doanhthu':
            $tableDB = new Database();
            $tables = $tableDB->getTables();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
            
    }
    
?>