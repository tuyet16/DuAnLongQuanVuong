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
	$model = new Wards();
	$model_districts = new districts();
	switch($action){
		case 'index':
			$tableDB = new Database();
            $tables = $tableDB->getTables();
			$dsWards=$model->getWards();
			$dsDistricts=$model_districts->getDistrict();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;	
		case 'add_ward':
		{
			 $name = filter_input(INPUT_POST, 'ward_name');
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
						$dsWards=$model->getWards();
						$dsDistricts=$model_districts->getDistrict();
						$GLOBALS['template']['menu'] = include_once '../template/menu.php';
						$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
						$GLOBALS['template']['content'] = include_once $view;
						$GLOBALS['template']['title'] = 'Thêm phường';
						include_once '../template/index.php';
					}
				}
				catch(MVCException $e){}
			}
			else
			{	$id_district = $_POST['quan'];
				$model->insertNewWard($name,$district);
				header('Location: wards_controller.php');
			}
			break;
		}
		case 'edit_ward':
		{
				$name = filter_input(INPUT_POST, 'ward_name');
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
							$dsWards=$model->getWards();
							$dsDistricts=$model_districts->getDistrict();
							$WardByID = $model->getWardByID( $_GET['id']);
							$GLOBALS['template']['menu'] = include_once '../template/menu.php';
							$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
							$GLOBALS['template']['content'] = include_once $view;
							$GLOBALS['template']['title'] = 'Sửa phường';
							include_once '../template/index.php';
						}
					}
					catch(MVCException $e){	}
				}
				else
				{
					$id = $_POST['id_ward'];
					$district=$_POST['quan'];
					$model->editWard($name,$district,$id);
					header('Location: wards_controller.php');
				}
				break;
		}
		case "delete_ward":
			if(!isset($_GET['confirm'])){
				if(isset($_GET['id'])){
					MessageBox::Show('Bạn có muốn xóa không?', MB_CONFIRM);
				}
        	}
			else
			{
				if($_GET['confirm'] == true){
					$ward_id = $_GET['id'];
					$model->deleteWard($ward_id);
					header('Location: wards_controller.php');
				}
			}
			break;
	}
?>