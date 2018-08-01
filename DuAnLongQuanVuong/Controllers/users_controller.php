<?php 
include_once('../config/bootload.php');
include_once('../Libs/messagebox_lib.php');
    $action = filter_input(INPUT_POST,'action');
    if($action == Null)
    {
        $action = filter_input(INPUT_GET,'action');
        if($action==null)
        {
            $action='index';
        }
    }
    switch($action)
    {
        case 'index':
    	$user = new Users();
        $dsuser = $user->getUser();
		$view = Page::View();
        $GLOBALS['template']['menu'] = include_once'../template/menu.php';
        $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
        $GLOBALS['template']['content'] = include_once $view;
        include_once('../template/index.php');
        break;
        case 'dangnhap':
            
            if(isset($_POST['email1']) && isset($_POST['password']))
            {
                $email = $_POST['email1'];
                $pass = $_POST['password'];
                $user = new Users();
                $login = $user->login($email,$pass);
               if(isset($login))
               {
                    $_SESSION['fullname']= $login[0]->fullname;
                    $_SESSION['role'] = $login[0]->role; 
                    $_SESSION['userid'] = $login[0]->userid;
                    if($_SESSION['role']=='0')
                    {
                        header('Location: admin_controller.php');
                        exit();
                    }
                     else if($_SESSION['role']=='1')
                     {
                        header('Location: shop_controller.php');
                        exit();  
                     } 
                     else
                     {
                         header('Location: home_controller.php');
                            exit(); 
                     }                  
               }
			  else
				 {
					 header('Location: home_controller.php');
						exit(); 
				 }
			                   
            }
                   
        break;
        case 'logout':
            session_destroy();
            header('Location: home_controller.php');
        break;        
        case 'dangky':
            $hoten = $_POST['username'];
            $email = $_POST['email'];
            $tenshop = $_POST['tenshop'];
            $diachi= $_POST['address'];
            $sdt = $_POST['tel'];
            $pass = $_POST['password1'];
            $user = new Users();
            $dsUsers = $user->addUser($pass,$hoten,$email,$diachi,$sdt,$tenshop);
           // print_r($_POST);
           header('Location:admin_controller.php');
        break;
        case 'donhang':
            $product_model = new products();
            $dsProducts = $product_model->getProduct();
            if(isset($_SESSION['userid']))
            {
                $user = new Users();
                $id = $_SESSION['userid'];
                $category = new Categories(); 
                $dsCategories = $category->getDScategory($id);    
                $DSdonhang1 = $user->getHoadon($id);
                if(isset($_GET['ngay']))
                {
                    $DSdonhang = $DSdonhang1;
                    $date = $_GET['ngay'];
                }
                else
                {
                    $DSdonhang = $DSdonhang1;
                    $date=key($DSdonhang);
                    
                }
               	$view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');
            }
            else
            {
                header('Location:home_controller.php');
            }                    
        break;
        case 'shopedit':
            if(isset($_POST['submit']))
            {
                //print_r($_POST);
                $tong = 1;
                $tongtien =0;
                foreach($_POST as $detail_id=>$edit)
                {
                    if($detail_id != 'submit')
                    {                      
                        if(strpos($detail_id,'giamgia') === false && strpos($detail_id,'gia') === false)
                        {
                            //  echo $detail_id.'<br>';
                            $tong *= $_POST[$detail_id] * $_POST['gia' . $detail_id] * ((100 - $_POST['giamgia' . $detail_id])/100);
                            $user = new Users();
                            $user->editDetailPriceByID($_POST[$detail_id],$tong,$_POST['giamgia'.$detail_id],$detail_id);
                            $tongtien += $tong;
                            $tong=1;                           
                        }
                    }
                }
                $billID = $_POST['billID'];
                $user = new Users();
                $user->editBillByID($tongtien,$billID);
                header('Location:?action=donhang&ngay='.$_GET['ngay']);
                
            }
        break;
        case 'guidonhang':
            $guidonhang =0;
            if(isset($_GET['id']))
            {
                $id= $_GET['id'];
                $user = new Users();
                $guidonhang = $user->guidonhang($id);
            }
            header('Location:?action=donhang');
        break;
    }

?>





