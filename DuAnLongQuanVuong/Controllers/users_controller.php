<?php 
include_once('../config/bootload.php');
include_once('../Libs/messagebox_lib.php');
    $action = filter_input(INPUT_POST,'action');
    if($action == Null)
    {
        $action = filter_input(INPUT_GET,'action');
        if($action==null)
        {
            $action='index';
        }
    }
    switch($action)
    {
        case 'index':
    	$tableDB = new Database();
        $tables = $tableDB->getTables();
		$view = Page::View();
        $GLOBALS['template']['menu'] = include_once'../template/menu.php';
        $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
        $GLOBALS['template']['content'] = include_once $view;
        include_once('../template/index.php');
        break;
        case 'dangnhap':
            
            if(isset($_POST['email']) && isset($_POST['password']))
            {
                if($_POST['email']=='admin' && $_POST['password']=='admin')
                {
                    $_SESSION['email']= $_POST['email'];
                    header('Location: admin_controller.php');
                    exit();
                }
                else
                {
                    if($_POST['email']=='abc' && $_POST['password']=='abc')
                    {
                        $_SESSION['email']= $_POST['email'];
                        header('Location: shop_controller.php');
                        exit();
                    }
                }
            }
            else
            {
                if(isset($_GET['confirm']))
                {
                     header('Location: home_controller.php'); 
                }
            }           
        break;
        case 'logout':
            session_destroy();
            header('Location: home_controller.php');
        break;
        
    }

?>