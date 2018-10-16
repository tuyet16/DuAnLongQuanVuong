<?php
	include_once('../Config/bootload.php');
    $action = filter_input(INPUT_GET,'action');
    if($action==NULL)
    {
        $action =filter_input(INPUT_POST,'action');
        if($action==NULL)
        {
            $action ='index';
        }
    }
	$model = new Customers();
	switch($action){
		case 'index':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
			$tableDB = new Database();
            $tables = $tableDB->getTables();
			$dsCustomers=$model->getCustomersDistrict();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;	
		case 'edit_customer':
		{
		   $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
			$name = filter_input(INPUT_POST, 'tenkh');
			if($name == NULL)
			{
				try{
					$view = Page::View();
					if(file_exists($view) == false)
						throw new MVCException('Tập tin không tồn tại' . $view);
					else
					{
						$tablesDB = new Database();
						$tables = $tablesDB->getTables();
                        $distric = new districts();
                        $dsDistrict =$distric->getDistrict();
						$dsCustomers=$model->getCustomersDistrict();
						$CustomerID = $model->getByIDCustomer($_GET['id']);
						$GLOBALS['template']['menu'] = include_once '../template/menu.php';
						$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
						$GLOBALS['template']['content'] = include_once $view;
						$GLOBALS['template']['title'] = 'Sửa Thông Tin Khách Hàng';
						include_once '../template/index.php';
					}
				}
				catch(MVCException $e){	}
			}
				else
				{
				    $tenkh = $_POST['tenkh'];
                    $dc = $_POST['diachi'];
                    $sdt = $_POST['sdt'];
                    $quan = $_POST['maquan'];
					$id = $_POST['customerID'];
					$model->editCustomer($tenkh,$dc,$sdt,$quan,$id);
					header('Location: customers_controller.php');
				}
				break;
		}
		case "delete_customer":
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsvitriqc2 = $user->carosoulpane2();
			if(!isset($_GET['confirm'])){
				if(isset($_GET['id'])){
					MessageBox::Show('Bạn có muốn xóa không?', MB_CONFIRM);
				}
        	}
			else
			{
				if($_GET['confirm'] == true){
					$id = $_GET['id'];
					$model->deleteCustomer($id);
					header('Location: customers_controller.php');
				}
			}
			break;
	}
?>