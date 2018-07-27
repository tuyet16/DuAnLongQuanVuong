<?php
	include_once('../Config/bootload.php');
    $action = filter_input(INPUT_GET,'action');
    if($action==NULL)
    {
        $action =filter_input(INPUT_POST,'action');
        if($action==NULL)
        {
            $action ='add_surcharge';
        }
	}
	
	$surcharge = new Surcharge();
	switch($action){
		case 'add_surcharge':
			$name = filter_input(INPUT_POST, 'txtname');
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
						$dsSurcharge = $surcharge->getSurcharge();
						$GLOBALS['template']['menu'] = include_once '../template/menu.php';
						$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
						$GLOBALS['template']['content'] = include_once $view;
						$GLOBALS['template']['title'] = 'Thêm phụ thu phí ship';
						include_once '../template/index.php';
					}
				}
				catch(MVCException $e){}
			}
			else
			{
				$ad = $_POST['surcharge'];
				$surcharge->addSurcharge($name,$ad);
				header('Location: surcharge_controller.php?action=add_surcharge');
			}
			break;
			
		case 'edit_surcharge':
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
						$dsSurcharge = $surcharge->getSurcharge();
						$AdByID = $surcharge->getSurchargeByID($id);
						$GLOBALS['template']['menu'] = include_once '../template/menu.php';
						$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
						$GLOBALS['template']['content'] = include_once $view;
						$GLOBALS['template']['title'] = 'Sửa phí phụ thu';
						include_once '../template/index.php';
					}
				}
				catch(MVCException $e){}
            }
            else
            {
                    $id = $_POST['adID'];
                    $money= $_POST['txtname'];
                  	$name=$_POST['surcharge'];
                    $surcharge->editAdvance($money,$name,$id);
                   	header('Location: surcharge_controller.php?action=add_surcharge');
            }
			break;
		case 'delete_surcharge':
			if(!isset($_GET['confirm'])){
				if(isset($_GET['id'])){
					MessageBox::Show('Bạn có muốn xóa không?', MB_CONFIRM);
				}
        	}
			else
			{
				if($_GET['confirm'] == true){
					$id = $_GET['id'];
					$surcharge->deleteSurcharge($id);
					header('Location: surcharge_controller.php?action=add_surcharge');
				}
			}
			break;
	}
	
?>