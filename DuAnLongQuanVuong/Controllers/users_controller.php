<?php include_once('../Config/bootload.php');
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
        $rsvitriquangcao1 = $user->carosoulpanel();

        $dsuser = $user->getUser();
		$view = Page::View();
        $GLOBALS['template']['menu'] = include_once'../template/menu.php';
        $GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';
        $GLOBALS['template']['content'] = include_once $view;
        include_once('../template/index.php');
        break;
        case 'dangnhap': 
		$user = new Users();
		 $rsvitriquangcao1 = $user->carosoulpanel();           
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
			 $rsvitriquangcao1 = $user->carosoulpanel();
            $dsUsers = $user->addUser($pass,$hoten,$email,$diachi,$sdt,$tenshop);
           // print_r($_POST);
           header('Location:admin_controller.php');
        break;
		case 'changepass':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
			$view = Page::View();
				if(isset($_SESSION['userid'])){
					$id = $_SESSION['userid'];
					$category = new Categories(); 
					$dsCategories = $category->getDScategory($id);
					$model = new Users();
					$u = $model->getUserByID($id);
					$pass = $u[0]->password;
					$old= filter_input(INPUT_POST, 'passOld');
					if($old !=NULL)
					{	if($old==$pass){
							$new = $_POST['passNew'];
							$test=$model->changePass($new,$id);
							//$_SESSION['error']=$test->rowCount();
							if(!isset($test)){
								$_SESSION['error']="Đổi mật khẩu thành công";
							}else{ $_SESSION['error']="Nếu không thay đổi mật khẩu được <br> Vui lòng liên hệ qua SĐT : .....";}
							
						}
						else{
						$_SESSION['error']="Kiểm tra lại mật khẩu hiện tại";	}
					}
				}
				$GLOBALS['template']['menu'] = include_once'../template/shopmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');
		break;
        case 'donhang':
             $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $product_model = new Products();
            $dsProducts = $product_model->getProduct();
            if(isset($_SESSION['userid']))
            {
                $user = new Users();
                $id = $_SESSION['userid'];
                $category = new Categories(); 
                $dsCategories = $category->getDScategory($id);    
                if(isset($_POST['chonngay']))
                {
                    $date1 =  date_create($_POST['chonngay']);
                    $date = date_format($date1,'Y-m-d');
                    $DSdonhang1 = $user->getHoadon($id, $date);
                    $DSdonhang = $DSdonhang1;
                }
                else
                {
                    if(!isset($_GET['date'])){
                        $date1 =  date_create('');
                        $date = date_format($date1,'Y-m-d');
                        $DSdonhang1 = $user->getHoadon($id, $date);
                        $DSdonhang = $DSdonhang1;
                    }
                    else
                    {
                        $date =  $_GET['date'];
                        $DSdonhang1 = $user->getHoadon($id, $date);
                        $DSdonhang = $DSdonhang1;
                    }
                    //$DSdonhang = $DSdonhang1;
                    //$date=key($DSdonhang);
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
                $tong = 1;
                $tongtien =0;
                //$billID = $_POST['billID'];
                $user = new Users();
                foreach($_POST as $detail_id=>$edit)
                {
                    if($detail_id != 'submit')
                    {                      
                        if(strpos($detail_id,'giamgia') === false && strpos($detail_id,'gia') === false)
                        {
                            if(is_numeric($detail_id)){
                              //echo $detail_id.'<br>';              
                            $tong *= $_POST[$detail_id] * $_POST['gia' . $detail_id] * ((100 - $_POST['giamgia' . $detail_id])/100);
                            $user->editDetailPriceByID($_POST[$detail_id],$tong,$_POST['giamgia'.$detail_id],$_POST['nguoitraship'],$detail_id);
                            $tongtien += $tong;
                            $tong=1;
                            echo $_POST['nguoitraship'] . '--' . $_POST['phishipshop'] . '---' . $_POST['phishipkh'] . '<br/><br/>'; 
                                if($_POST['nguoitraship'] == 0){
                                    
                                    $phishipshop = $_POST['phishipshop'] > 0 ? $_POST['phishipshop'] : $_POST['phishipkh'];
                                    $user->editShipFee($phishipshop, $detail_id);
                                }
                                else{
                                    
                                    $phishipshop = $_POST['phishipkh'] > 0 ? $_POST['phishipkh'] : $_POST['phishipshop'];
                                    $user->editShipFee($phishipshop, $detail_id, 1);
                                }                    
                            }        
                        }
                    }
                }
                header('Location: ?action=donhang&id=' . $billID.'&date='.$_GET['ngay']);  
            }
        break;
        case 'guidonhang':
            $guidonhang=0;
            if(isset($_GET['detail_id']))
            {
                $id= $_GET['detail_id'];
                $guidonhang = $user->guidonhang($id);
            }
            header('Location:?action=donhang');
        break;
        case 'xoasanpham':
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            if(isset($_GET['detailID'])){
                $user = new Users();
                $user->deleteDetailID($_GET['detailID']);
                $dt = date_create($_GET['date']);
                $date = date_format($dt, 'Y-m-d');
                header('Location: ?action=donhang&date=' . $date);
            }            
        break;
        case 'tra_cuu_don_hang':
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            if(isset($_POST['phone'])){
                $userBills = new Bills();
                $rsUserBills = $userBills->getBillsByCustomerID($_POST['phone']);
                $findingWord = $_POST['phone'];
                $view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['footer'] = include_once'../template/footer.php';
                include_once('../template/index.php');
            }
        break;
    }







