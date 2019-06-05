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
    
	switch($action){
		case 'index':  
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            if(!isset($_SESSION['userid'])){
                $category = new Categories();
                $dsCategories = $category->getCategories();
                $unit = new Units();
                $dsUnits = $unit->getUnits();
            }
            else{
                $id = $_SESSION['userid'];
                $category = new Categories();
                $dsCategories = $category->getCategories();
                $unit = new Units();
                $dsUnits = $unit->getUnits();
            }
            //$pt = $product_model->phantrang();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/shopmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;
        case 'themsanpham':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $category = new Categories();
                $dsCategories = $category->getDScategory($_SESSION['userid']);
                $unit = new Units();
                $dsUnits = $unit->getUnits();
                $product_model = new Products();
                $dsProducts = $product_model->getProductByuserid($_SESSION['userid']);
                $rsProducts = $product_model->getByIDProduct($id);
               	$view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');
            }
            else
            {
                $tensp= $_POST['tensp'];
                $loaisp = $_POST['categoryID'];
                $donvi = $_POST['unitID'];
                $gia = $_POST['gia'];
                $khuyenmai = $_POST['giakhuyenmai'];
                $description = $_POST['description'];
                $userid = $_SESSION['userid'];
                $hinhanh = $_FILES['hinhanh'];
                $count = $_POST['soluong'];
                $img = Image::GetFile($hinhanh);
                $subImageArr = [];
                for($i = 0; $i < 5; $i++){
                    if(is_uploaded_file($_FILES['hinhanhphu']['tmp_name'][$i])){
                        
                        $img_name = Image::GetFile($_FILES['hinhanhphu'], $i);
                        $subImageArr[] = $img_name;
                    }
                    else{
                        $subImageArr[] = '';
                    }
                }
                
                $product_model = new Products();
                $product_model->addProduct($tensp,$loaisp,$userid,$donvi,$gia,$khuyenmai, $img, $subImageArr, $description,$count);
                //print_r($_POST);
                header('Location: shop_controller.php?action=xemdanhmucsanpham');
            }
        break;	
        case 'suasanpham':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $category = new Categories();
                $dsCategories = $category->getCategories();
                $unit = new Units();
                $dsUnits = $unit->getUnits();
                $product_model = new Products();
                $rsProducts = $product_model->getByIDProduct($id);
               	$view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/shopmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');
            }
            else
            {
                if(isset($_POST['submit']))
                {
                    $id = $_POST['productID'];
                    $tensp= $_POST['tensp'];
                    $loaisp = $_POST['categoryID'];
                    $donvi = $_POST['unitID'];
                    $gia = $_POST['gia'];
                    $gia_khuyen_mai = $_POST['giakhuyenmai'];
                    $description = $_POST['description'];
                    $count = $_POST['soluong'];
                    $userid = $_SESSION['userid'];                    
                    
                    if(is_uploaded_file($_FILES['hinhanh']['tmp_name']))
                    {
                        $hinhanh = $_FILES['hinhanh'];
                        $img = Image::GetFile($hinhanh);
                    }
                    else
                    {
                        $img = $_POST['hinhcu'];
                    }
                    $subImageArr = [];
                    for($i = 0; $i < 5; $i++){
                        if(is_uploaded_file($_FILES['hinhanhphu']['tmp_name'][$i])){
                        
                            $img_name = Image::GetFile($_FILES['hinhanhphu'], $i);
                            $subImageArr[] = $img_name;
                        }
                        else{
                            $subImageArr[] = $_POST['hinhphucu'][$i];
                        }
                    }
                    $product_model = new Products();
                    $product_model->editProduct($tensp,$loaisp,$donvi,$gia,$gia_khuyen_mai, $img,$description, $subImageArr,$count, $id);
                    header('Location: shop_controller.php?action=xemdanhmucsanpham');
                    //print_r($_POST);
                }
            }
        break;
        case "xoasanpham":
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
					$product_model = new Products();
                    $product_model->deleteProduct($id);
					 header('Location: products_controller.php');
				}
			}
			break;
   
        
	}
?>









