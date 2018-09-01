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
	$unit = new Units();
	switch($action){
	   case 'index':
		{
			$tableDB = new Database();
            $tables = $tableDB->getTables();
           	$dsUnit = $unit->getUnits();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
			break;	
		}
		case 'add_unit':
		{
			$ten = filter_input(INPUT_POST, 'ten');
			if($ten == NULL)
			{
				try{
					$view = Page::View();
					if(file_exists($view) == false)
						throw new MVCException('Tập tin không tồn tại' . $view);
					else
					{
						$tablesDB = new Database();
						$tables = $tablesDB->getTables();
						$dsUnit = $unit->getUnits();
						$GLOBALS['template']['menu'] = include_once '../template/menu.php';
						$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
						$GLOBALS['template']['content'] = include_once $view;
						$GLOBALS['template']['title'] = 'Thêm phí ứng trước';
						include_once '../template/index.php';
					}
				}
				catch(MVCException $e){}
			   }
			else
			{
				$ten = $_POST['ten'];
				$unit->insertUnit($ten);
				header('Location: units_controller.php?action=index');
			}
			break;
		}
		case 'edit_unit':
			if(isset($_GET['id']))
            {$id = $_GET['id'];
              try{
					$view = Page::View();
					if(file_exists($view) == false)
						throw new MVCException('Tập tin không tồn tại' . $view);
					else
					{
						$tablesDB = new Database();
						$tables = $tablesDB->getTables();
                        $dsUnit = $unit->getUnits();
                        $rsUnit = $unit->getUnitByID($id);
						$editUnit = $unit->getUnitByID($id);
						$GLOBALS['template']['menu'] = include_once '../template/menu.php';
						$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
						$GLOBALS['template']['content'] = include_once $view;
						$GLOBALS['template']['title'] = 'Sửa phí ứng trước';
						include_once '../template/index.php';
					}
				}
				catch(MVCException $e){}
            }
            else
            {
                    $id = $_POST['id'];
                    $ten= $_POST['ten'];
                    $unit->editUnit($ten,$id);
                   	header('Location: units_controller.php?action=index');
            }
			break;
		case 'delete_unit':
			if(!isset($_GET['confirm'])){
				if(isset($_GET['id'])){
					MessageBox::Show('Bạn có muốn xóa không?', MB_CONFIRM);
				}
        	}
			else
			{
				if($_GET['confirm'] == true){
					$id = $_GET['id'];
					$unit->deleteUnit($id);
					header('Location: units_controller.php?action=index');
				}
			}
			break;
	}
	
?>