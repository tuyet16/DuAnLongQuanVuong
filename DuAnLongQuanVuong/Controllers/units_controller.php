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
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $dsUnit = $units->getUnits();
			$dsCategories= $model->getCategories();   
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
			break;	
		case 'add_unit':
		{
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
       
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
        }
		break;
      //  case 'add_unit':
//		{
//            $name = filter_input(INPUT_POST, 'unit_name');
//			if($name == NULL)
//			{	
//				$tablesDB = new Database();
//				$tables = $tablesDB->getTables();
//				$dsCategories=$model->getCategories();
//				$dsUnit = $units->getUnits();
//				$GLOBALS['template']['menu'] = include_once '../template/menu.php';
//				$GLOBALS['template']['leftmenu'] = include_once '../template/adminleftmenu.php';
//				$GLOBALS['template']['content'] = include_once '../Views/units/index.php';
//				$GLOBALS['template']['title'] = 'Thêm mới loại sản phẩm';
//				include_once '../template/index.php';		
//			}
//			else
//			{
//				$units->insertNewUnit($name);
//				header('Location: units_controller.php');
//			}
//			break;
//		}
		case 'edit_unit':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
      
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
		//case 'delete_unit':
//		{
//				$name = filter_input(INPUT_POST, 'unit_name');
//				if($name == NULL)
//				{
//					try{
//						$view = Page::View();
//						if(file_exists($view) == false)
//							throw new MVCException('Tập tin không tồn tại' . $view);
//						else
//						{
//							$tablesDB = new Database();
//							$tables = $tablesDB->getTables();
//							$dsCategories=$model->getCategories();
//							$UnitByID = $units->getUnitByID( $_GET['id']);
//							 $dsUnit = $units->getUnits();
//							$GLOBALS['template']['menu'] = include_once '../template/menu.php';
//							$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
//							$GLOBALS['template']['content'] = include_once $view;
//							$GLOBALS['template']['title'] = 'Sửa đơn vị tính';
//							include_once '../template/index.php';
//						}
//					}
//					catch(MVCException $e){	}
//				}
//				else
//				{
//					$id = $_POST['unitID'];
//					$units->editUnit($name,$id);
//					header('Location: units_controller.php');
//				}
//				break;
//		}
		case "delete_unit":
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
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