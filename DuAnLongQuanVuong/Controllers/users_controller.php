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
                    $role = 1;
                    if(isset($_POST['dangnhap']))
                    {
                        setcookie('email',$_POST['email'],time()+3600);
                        setcookie('password',$_POST['password'],time()-3600);                        
                    }
                    $_SESSION['email']= $_POST['email'];
                    $_SESSION['role']= $role;
                    header('Location: shop_controller.php');
                    exit();
                }
                else
                {
                    MessageBox::Show('Tài khoản hoặc mật khẩu không đúng',MB_CONFIRM);                    
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
    }

?>