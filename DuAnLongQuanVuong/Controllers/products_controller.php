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
            $category = new Categories();
            $dsCategories = $category->getCategories();
            $unit = new Units();
            $dsUnits = $unit->getUnits();
            $product_model = new products();
            $dsProducts = $product_model->getProduct();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;
        case 'themsanpham':
            $tensp= $_POST['tensp'];
            $loaisp = $_POST['categoryID'];
            $donvi = $_POST['unitID'];
            $gia = $_POST['gia'];
            $userid = $_SESSION['userid'];
            $hinhanh = $_FILES['hinhanh'];
            $img = Image::GetFile($hinhanh);
            $product_model = new products();
            $product_model->addProduct($tensp,$loaisp,$userid,$donvi,$gia,$img);
            header('Location: products_controller.php');
        break;	
        case 'suasanpham':
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $category = new Categories();
                $dsCategories = $category->getCategories();
                $unit = new Units();
                $dsUnits = $unit->getUnits();
                $product_model = new products();
                $dsProducts = $product_model->getProduct();
                $rsProducts = $product_model->getByIDProduct($id);
               	$view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
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
                    $userid = $_SESSION['userid'];
                    $hinhanh = $_FILES['hinhanh'];
                    $img = Image::GetFile($hinhanh);
                    $product_model = new products();
                    $product_model->editProduct($tensp,$loaisp,$donvi,$gia,$img,$id);
                    header('Location:shop_controller.php');
                }
            }
        break;
        case "xoasanpham":
			if(!isset($_GET['confirm'])){
				if(isset($_GET['id'])){
					MessageBox::Show('Bạn có muốn xóa không?', MB_CONFIRM);
				}
        	}
			else
			{
				if($_GET['confirm'] == true){
					$id = $_GET['id'];
					$product_model = new products();
                    $product_model->deleteProduct($id);
					header('Location: shop_controller.php');
				}
			}
			break;
   
        
	}
?>









