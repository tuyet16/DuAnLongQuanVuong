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
            if(isset($_POST['user']) && isset($_POST['pass']))
            {
                if($_POST['user']=='admin' && $_POST['pass']=='admin')
                {
                    $role = 1;
                    if(isset($_POST['dangnhap']))
                    {
                        setcookie('user',$_POST['user'],time()+3600);
                        setcookie('pass',$_POST['pass'],time()-3600);
                        
                    }
                    $_SESSION['user']= $_POST['user'];
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