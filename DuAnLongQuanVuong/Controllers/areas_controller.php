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
	$model = new Areas();
	switch($action){
		case 'index':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
			$tableDB = new Database();
            $tables = $tableDB->getTables();
			$dsAreas=$model->getAreas();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;	
		case 'add_areas':
		{
		   $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
			 $name = filter_input(INPUT_POST, 'areas_name');
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
						$dsAreas=$model->getAreas();
						$GLOBALS['template']['menu'] = include_once '../template/menu.php';
						$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
						$GLOBALS['template']['content'] = include_once $view;
						$GLOBALS['template']['title'] = 'Thêm khu vực';
						include_once '../template/index.php';
					}
				}
				catch(MVCException $e){}
			}
			else
			{	$km = $_POST['sokm']; $often= $_POST['often'];$fast= $_POST['fast'];
				$model->insertNewAreas($name,$km,$often,$fast);
				header('Location: areas_controller.php');
			}
			break;
		}
		case 'edit_areas':
		{
    		   $user = new Users();
                $rsvitriquangcao1 = $user->carosoulpanel();
				$name = filter_input(INPUT_POST, 'areas_name');
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
							$dsAreas=$model->getAreas();
							$AreasByID = $model->getAreasByID( $_GET['id']);
							$GLOBALS['template']['menu'] = include_once '../template/menu.php';
							$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
							$GLOBALS['template']['content'] = include_once $view;
							$GLOBALS['template']['title'] = 'Sửa khu vực';
							include_once '../template/index.php';
						}
					}
					catch(MVCException $e){	}
				}
				else
				{
					$id = $_POST['id_areas'];
					$km = $_POST['sokm']; $often= $_POST['often'];$fast= $_POST['fast'];
					$model->editAreas($name,$km,$often,$fast,$id);
					header('Location: Areas_controller.php');
				}
				break;
		}
		case "delete_areas":
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
					$areas_id = $_GET['id'];
					$model->deleteAreas($areas_id);
					header('Location: areas_controller.php');
				}
			}
			break;
	}
?>