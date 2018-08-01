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
    	   header('Location: ?action=donhang');
        break;
        case 'doanhthungay':
            $tableDB = new Database();
            $tables = $tableDB->getTables();
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
            break;
        case 'dsshop':
            $user = new Users();
            $dsUsers = $user->getUser();
            $view = Page::View();            
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
        break;
        case 'suashop':
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $user = new Users();
            $dsUsers = $user->getUser();
            $rsUsers = $user->getUserByID($id);
            $view = Page::View();            
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
           
        }
        else
        {
            if(isset($_POST['submit']))
            {
                $id = $_POST['userid'];
                $hoten = $_POST['username'];
                $email = $_POST['email'];
                $diachi= $_POST['address'];
                $sdt = $_POST['tel'];
                $tenshop = $_POST['tenshop'];
                $user = new Users();
                $user->editUsers($hoten,$email,$diachi,$sdt,$tenshop,$id);
                header('Location:admin_controller.php?action=dsshop');
            }
            
        }
            
        break; 
		case 'delete_user':
		if(!isset($_GET['confirm'])){
				if(isset($_GET['id'])){
					MessageBox::Show('Bạn có muốn xóa không?', MB_CONFIRM);
				}
        	}
			else
			{
				if($_GET['confirm'] == true){
					$user_id = $_GET['id'];
					 $user = new Users();
                	$user->deleteUsers($user_id);
					header('Location:admin_controller.php?action=dsshop');
				}
			}
			break; 
        break;
        case 'donhang':
            if(isset($_SESSION['userid']))
            {
                $user = new Users();
                $id = $_SESSION['userid'];   
                $DSdonhang1 = $user->gethoadonAmin();
                if(isset($_GET['ngay']))
                {
                    $DSdonhang = $DSdonhang1;
                    $date = $_GET['ngay'];
                }
                else
                {
                    $DSdonhang = $DSdonhang1;
                    $date=key($DSdonhang);
                    
                }
               	$view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');
            }
            else
            {
                header('Location:home_controller.php');
            }                    
        break;
        case 'editnhanvien':
            if(isset($_POST['billID']) && isset($_POST['nhanvien']))
            {
                $id= $_POST['billID'];
                $nhanvien= $_POST['nhanvien'];
                $user = new Users();
                $nhanvien = $user->editnhanvien($nhanvien,$id);
                header('Location:?action=donhang');
            }
            
            //header('Location:?action=donhang');
        break;
        case 'tinhtrang':
            $user = new Users();
            $edittinhtrang = $user->getTinhtrang();
            if(isset($_POST['submit']))
            {
                print_r($_POST);
                if(isset($_POST['billID']) && isset($_POST['rd']) &&isset($_POST['ghichu']))
                {
                    $id = $_POST['billID'];
                    $tinhtrang = $_POST['rd'];
                    $ghichu = $_POST['ghichu'];
                    $user = new Users();
                    $edithoadon = $user->edittinhtrang($tinhtrang,$ghichu,$id);
                    header('Location:?action=tinhtrang');
                    
                }
            }
            else
            {
                if(isset($_GET['ngay']))
                {
                    $DSdonhang = $edittinhtrang;
                    $date = $_GET['ngay'];
                }
                else
                {
                    $DSdonhang = $edittinhtrang;
                    $date=key($DSdonhang);
                    
                } 
                 $view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');
            }       
           
        break;
        
    }
?>








