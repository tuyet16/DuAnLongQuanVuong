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
			$tableDB = new Database();
            $tables = $tableDB->getTables();
			$dsCustomers=$model->getCustomers();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;	
		case 'add_customer':
		{
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
						$dsCustomers=$model->getCustomers();
						$GLOBALS['template']['menu'] = include_once '../template/menu.php';
						$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
						$GLOBALS['template']['content'] = include_once $view;
						$GLOBALS['template']['title'] = 'Thêm mới loại sản phẩm';
						include_once '../template/index.php';
					}
				}
				catch(MVCException $e){}
			}
			else
			{
				$dc = $_POST['diachi'];
				$dt = $_POST['sdt'];
				$quan=$_POST['maquan'];
				$model->addCustomer($name);
				header('Location: customers_controller.php');
			}
			break;
		}
		case 'edit_customer':
		{
				$name = filter_input(INPUT_POST, 'ten_kh');
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
							$dsCustomers=$model->getCustomers();
							$CustomerByID = $model->getByIDCustomer( $_GET['id']);
							$GLOBALS['template']['menu'] = include_once '../template/menu.php';
							$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
							$GLOBALS['template']['content'] = include_once $view;
							$GLOBALS['template']['title'] = 'Sửa loại sản phẩm';
							include_once '../template/index.php';
						}
					}
					catch(MVCException $e){	}
				}
				else
				{
					$id = $_POST['category_id'];
					$model->editCategory($name,$id);
					header('Location: customers_controller.php');
				}
				break;
		}
		case "delete_customer":
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