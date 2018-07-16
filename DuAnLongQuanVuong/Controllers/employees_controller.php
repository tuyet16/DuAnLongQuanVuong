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
	$model = new Employees();
	switch($action){
		case 'index':
		{
			$tableDB = new Database();
            $tables = $tableDB->getTables();
			$dsEmployees=$model->getEmployees();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
			break;	
		}
		case 'add_employee':
		{					
			$manv = $_POST['manv'];
			$tennv=$_POST['tennv'];
			$dc = $_POST['diachi'];
			$dt = $_POST['sdt'];
            $i = $_FILES['hinhanh'];
            $img = Image::GetFile($i);
			$model->insertNewEmployee($manv,$tennv,$dc,$dt,$img);
			header('Location: employees_controller.php');
			break;
		}
        case 'bangluong':
			$tableDB = new Database();
            $tables = $tableDB->getTables();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;
		case 'edit_employee':
		{
				$name = filter_input(INPUT_POST, 'idem');
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
							$dsEmployees=$model->getEmployees();
							$EmployeeByID = $model->getEmployeeByID( $_GET['id']);
							$GLOBALS['template']['menu'] = include_once '../template/menu.php';
							$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
							$GLOBALS['template']['content'] = include_once $view;
							$GLOBALS['template']['title'] = 'Sửa thông tin nhân viên';
							include_once '../template/index.php';
						}
					}
					catch(MVCException $e){	}
				}
				else
				{
					$manv = $_POST['manv'];
					$tennv=$_POST['tennv'];
					$dc = $_POST['diachi'];
					$dt = $_POST['sdt'];
					$id = $_POST['idem'];
                    $i = $_FILES['hinhanh'];
                    $img = Image::GetFile($i);
					$model->editEmployee($manv,$tennv,$dc,$dt,$img,$id);
					header('Location: employees_controller.php');
				}
			break;
		}
		case "delete_employee":
		{
			if(!isset($_GET['confirm'])){
				if(isset($_GET['id'])){
					MessageBox::Show('Bạn có muốn xóa không?', MB_CONFIRM);
				}
        	}
			else
			{
				if($_GET['confirm'] == true){
					$employ_id = $_GET['id'];
					$model->deleteEmployee($employ_id);
					header('Location: employees_controller.php');
				}
			}
			break;
		}
	}
?>