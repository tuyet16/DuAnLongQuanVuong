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
			$tableDB = new Database();
            $tables = $tableDB->getTables();
            $product_model = new products();
            $dsProducts = $product_model->getProduct();
            $category = new Categories();
            $dsCategories = $category->getCategories();
            if(isset($_SESSION['userid']))
            {
                $id = $_SESSION['userid'];
                $category = new Categories();
                $dsCategories = $category->getDScategory($id);
            }
            
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once '../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once '../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');           
        break;
        case 'services':
			$tableDB = new Database();
            $tables = $tableDB->getTables();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
        break;
         case 'chitiet':
		 	$tableDB = new Database();
            $tables = $tableDB->getTables();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
        break;
         case 'mypham':
		 	$tableDB = new Database();
            $tables = $tableDB->getTables();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
        break;
        case 'dathang':
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/leftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
    }
    
?>