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
    $units = new Units();
	$model = new Categories(); 
	switch($action){
		case 'index':  
            $dsUnit = $units->getUnits();
			$dsCategories= $model->getCategories();   
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;
<<<<<<< HEAD
        case 'add':
        
        
        
        break;
        case 'edit':
        
        break;
        case 'delete':
        
        break;
=======
        case 'add_unit':
		{
            $name = filter_input(INPUT_POST, 'unit_name');
			if($name == NULL)
			{	
				$tablesDB = new Database();
				$tables = $tablesDB->getTables();
				$dsCategories=$model->getCategories();
				$dsUnit = $units->getUnits();
				$GLOBALS['template']['menu'] = include_once '../template/menu.php';
				$GLOBALS['template']['leftmenu'] = include_once '../template/adminleftmenu.php';
				$GLOBALS['template']['content'] = include_once '../Views/units/index.php';
				$GLOBALS['template']['title'] = 'Thêm mới loại sản phẩm';
				include_once '../template/index.php';
					
			}
			else
			{
				$units->insertNewUnit($name);
				header('Location: units_controller.php');
			}
			break;
		}
		case 'edit_unit':
		{
				$name = filter_input(INPUT_POST, 'unit_name');
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
							$dsCategories=$model->getCategories();
							$UnitByID = $units->getUnitByID( $_GET['id']);
							 $dsUnit = $units->getUnits();
							$GLOBALS['template']['menu'] = include_once '../template/menu.php';
							$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
							$GLOBALS['template']['content'] = include_once $view;
							$GLOBALS['template']['title'] = 'Sửa đơn vị tính';
							include_once '../template/index.php';
						}
					}
					catch(MVCException $e){	}
				}
				else
				{
					$id = $_POST['unitID'];
					$units->editUnit($name,$id);
					header('Location: units_controller.php');
				}
				break;
		}
		case "delete_unit":
			if(!isset($_GET['confirm'])){
				if(isset($_GET['id'])){
					MessageBox::Show('Bạn có muốn xóa không?', MB_CONFIRM);
				}
        	}
			else
			{
				if($_GET['confirm'] == true){
					$unit_id = $_GET['id'];
					$units->deleteUnit($unit_id);
					header('Location: units_controller.php');
				}
			}
			break;
>>>>>>> 7f5699dc970c62f2edc0fbcd9025088f3bf9ad2b
	}
?>









