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
	$model = new Categories();
	switch($action){
		case 'index':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
			$dsCategories= $model->getCategories();            
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;	
		case 'add_category':
		{
		   $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $name = filter_input(INPUT_POST, 'category_name');
            if(is_uploaded_file($_FILES['cate_img']['tmp_name'])){
                $cate_img = Image::GetFile($_FILES['cate_img']);
            }
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
				$model->insertNewCategory($name, $cate_img);
				header('Location: categories_controller.php');
			}
			break;
		}
		case 'edit_category':
		{
		   $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
			$name = filter_input(INPUT_POST, 'category_name');
            
			if($name == NULL)
			{
				try{
					$view = Page::View();
					if(file_exists($view) == false)
						throw new MVCException('Tập tin không tồn tại' . $view);
					else
					{
						$model = new Categories();
						$dsCategories=$model->getCategories();
						$CateByID = $model->getCategoryByID( $_GET['id']);
						$GLOBALS['template']['menu'] = include_once '../template/menu.php';
						$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
						$GLOBALS['template']['content'] = include_once $view;
						$GLOBALS['template']['title'] = 'Sửa loại mặt hàng';
						include_once '../template/index.php';
					}
				}
				catch(MVCException $e){	}
			}
			else
			{
                if(is_uploaded_file($_FILES['cate_img']['tmp_name'])){
                    $img_name = Image::GetFile($_FILES['cate_img']);
                }
                else{
                    $img_name = null;
                }
				$id = $_POST['category_id'];
				$model->editCategory($name,$img_name, $id);
				header('Location: categories_controller.php');
			}
			break;
		}
		case "delete_category":
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
					$category_id = $_GET['id'];
					$model->deleteCategory($category_id);
					header('Location: categories_controller.php');
				}
			}
			break;
	}
?>