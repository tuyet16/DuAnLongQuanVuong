<?php
	include_once('../Config/bootload.php');
    $action = filter_input(INPUT_GET,'action');
    if($action==NULL)
    {
        $action =filter_input(INPUT_POST,'action');
        if($action==NULL)
        {
            $action ='add_advance';
        }
	}
	$advance = new Advance();
	switch($action){
		case 'add_advance':
		{
		   $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
			$money = filter_input(INPUT_POST, 'money');
			if($money == NULL)
			{
				try{
					$view = Page::View();
					if(file_exists($view) == false)
						throw new MVCException('Tập tin không tồn tại' . $view);
					else
					{
						$tablesDB = new Database();
						$tables = $tablesDB->getTables();
						$dsAdvance = $advance->getAdvance();
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
				$money = $_POST['money'];
				$ad = $_POST['advance'];
				$advance->insertNewAdvance($money,$ad);
				header('Location: advance_controller.php?action=add_advance');
			}
			break;
		}
		case 'edit_advance':
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
						$dsAdvance = $advance->getAdvance();
						$AdByID = $advance->getAdvanceByID($id);
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
                    $id = $_POST['adID'];
                    $money= $_POST['money'];
                  	$name=$_POST['advance'];
                    $advance->editAdvance($money,$name,$id);
                   	header('Location: advance_controller.php?action=add_advance');
            }
			break;
		case 'delete_advance':
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
					$advance->deleteAdvance($id);
					header('Location: advance_controller.php?action=add_advance');
				}
			}
			break;
	}
	
?>