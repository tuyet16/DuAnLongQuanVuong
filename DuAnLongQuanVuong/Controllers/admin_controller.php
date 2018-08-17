<?php 
include_once('../config/bootload.php');
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
    	   header('Location: ?action=donhang');
        break;
        case 'dsshop':
            $user = new Users();
            $dsUsers = $user->getUser();
            $view = Page::View();            
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
        break;
        case 'suashop':
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $user = new Users();
            $dsUsers = $user->getUser();
            $rsUsers = $user->getUserByID($id);
            $view = Page::View();            
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
           
        }
        else
        {
            if(isset($_POST['submit']))
            {
                $id = $_POST['userid'];
                $hoten = $_POST['username'];
                $email = $_POST['email'];
                $diachi= $_POST['address'];
                $sdt = $_POST['tel'];
                $tenshop = $_POST['tenshop'];
                $user = new Users();
                $user->editUsers($hoten,$email,$diachi,$sdt,$tenshop,$id);
                header('Location:admin_controller.php?action=dsshop');
            }
            
        }
            
        break; 
		case 'delete_user':
		if(!isset($_GET['confirm'])){
				if(isset($_GET['id'])){
					MessageBox::Show('Bạn có muốn xóa không?', MB_CONFIRM);
				}
        	}
			else
			{
				if($_GET['confirm'] == true){
					$user_id = $_GET['id'];
					 $user = new Users();
                	$user->deleteUsers($user_id);
					header('Location:admin_controller.php?action=dsshop');
				}
			}
			break; 
        break;
        case 'donhang':
            if(isset($_SESSION['userid']))
            {
                $user = new Users();
                $id = $_SESSION['userid'];   
                
                if(isset($_POST['chonngay']))
                {
                    
                    $ngay = $_POST['chonngay'];
                    $dt=date_create($ngay);
                    $ngay = date_format($dt,'Y-m-d');
                    $DSdonhang1 = $user->gethoadonAmin($ngay);
                    $DSdonhang = $DSdonhang1;
                    $date = $ngay;
                }
                else
                {
                    $DSdonhang1 = $user->gethoadonAmin();
                    $DSdonhang = $DSdonhang1;
                    $date=key($DSdonhang);
                    
                }
               	$view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');
            }
            else
            {
                header('Location:home_controller.php');
            }                    
        break;
        case 'editnhanvien':
            if(isset($_POST['billID']) && isset($_POST['nhanvien']))
            {
                $id= $_POST['billID'];
                $nhanvien= $_POST['nhanvien'];
                $user = new Users();
                $nhanvien = $user->editnhanvien($nhanvien,$id);
                header('Location:?action=donhang');
            }
            
            //header('Location:?action=donhang');
        break;
        case 'tinhtrang':
            $idnv=0;
            $user = new Users();
            $edittinhtrang = $user->getTinhtrang();
            if(isset($_POST['submit']))
            {
                 if(isset($_GET['idnv']))
                 {
                    $idnv = $_GET['idnv'];                     
                 } 
                 if(isset($_POST['billID']) && isset($_POST['rd']) &&isset($_POST['ghichu'])&&isset($_POST['phiship']))
                {
                    $id = $_POST['billID'];
                    $tinhtrang = $_POST['rd'];
                    $ghichu = $_POST['ghichu'];
                    $phiship = $_POST['phiship'];
                    $luongnv = $phiship*0.8;
                    $user = new Users();
                    $edithoadon = $user->edittinhtrang($tinhtrang,$ghichu,$phiship,$luongnv,$id);
                    header('Location:?action=tinhtrang&idnv='.$idnv);                    
                }           
            }
            else
            {
                if(isset($_GET['ngay']))
                {
                    $DSdonhang = $edittinhtrang;
                    $date = $_GET['ngay'];
                }
                else
                {
                    $DSdonhang = $edittinhtrang;
                    $date=key($DSdonhang);
                    
                } 
                $view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');
            }       
           
        break;
        case 'doanhthungay':
            $user = new Users();
            $DSdonhang = $user->getthongkengay();
            
            if(isset($_POST['chonngay']))
            {
                $doanhthu = $DSdonhang;
                $date1 =  date_create($_POST['chonngay']);
                $date = date_format($date1,'Y-m-d');
            }
            else
            {
                $doanhthu = $DSdonhang;
                $date=key($doanhthu);                
            } 
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
        break;
        case 'doanhthuthang':
            $user = new Users();
                        
            if(isset($_POST['chonthang']))
            {
                $chon= explode(' ',$_POST['chonthang']);                
                $thang = $chon[0];
                $nam = $chon[1]; 
                $DSdonhang = $user->getthongkethang($thang,$nam);
                $doanhthu = $DSdonhang;
                $date1 =  date_create($_POST['chonthang']);
                $date = $thang.'-'.$nam;
            }
            else
            {
                $time = $user->getThangNew();
                $DSdonhang = $user->getthongkethang($time['thang'],$time['nam']);
                $doanhthu = $DSdonhang;
                $date= $time['thang'].'-'.$time['nam'];                
            }
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
        break;
        case 'doanhthunam':
            $user = new Users();
                                  
            if(isset($_POST['chonnam']))
            { 
                $nam = $_POST['chonnam'];                  
                $DSdonhang = $user->getThongkeNam($nam);
                $doanhthu = $DSdonhang;
                $date = $nam;
            }
            else
            {
                $time = $user->getNamNew();
                $DSdonhang = $user->getThongkeNam($time['nam']);
                $doanhthu = $DSdonhang;
                $date=$time['nam'];                
            }
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
        break;
        case 'inhoadon':
            if(isset($_GET['billID']))
            {
                $id = $_GET['billID'];
                $user = new Users();                   
                $thongtin = $user->getHDAdminByID($id) ;
                $ar = array('STT','Tên Hàng','Đơn Vị','Số lượng','Đơn Giá','Thành Tiền');
                //print_r($thongtin);   
                //$data = "Some utf-8 characters d?a ch?";          
                foreach($thongtin as $in )
                {
                      //print_r($in);
                    $flag = false;
                    foreach($in as $billID=>$dt)
                    {                      
                        //echo chr(255).chr(254).mb_convert_encoding($data,"UTF-16LE","UTF-8")."\r\n"; 
                        //print_r($in);
                        //print_r($in[1][6]);
                        $ngay =$in[0][3];
                        $chon = explode('-',$ngay);
                        $nam = $chon[0];
                        $thang = $chon[1];
                        $filename = "D:/donhang/".$nam.'/'.'Thang_'.$thang.'/'.$ngay.'/'.$ngay.'_'.$id.".xls";
                        header("Content-Disposition: attachment; filename=\"$filename\"");
                        header("Content-Type: application/vnd.ms-excel");
                        header("Contet-Encoding:UTF-8");
                        if($flag == false)
                        {   
                            echo "Chủ Hàng: \t \t". chr(255).chr(254).mb_convert_encoding($dt[0],"UTF-8")."\n";
                            echo "Ðịa Chỉ: \t ". $dt[1]."\n";
                            echo "Ðon Vận Chuyển: \t \t"."SEVEN SHIPPER \t \t \t". "Ngày \n";
                            echo "Shipper: \t". $dt[4]."\t"."ÐT: \t".$dt[5]."\t \t".$dt[3]."\n";
                            echo "Tên Khách Hàng: \t \t". $dt[6]."\n";
                            echo "Ðịa Chỉ: \t". $dt[2]."\t \t"."ÐT: \t".$dt[7]."\n";
                           // echo implode("\t",chr(255).chr(254).iconv("UTF-8","UTF-16LEIGNORE",$ar))
                           
                            $i=1;
                            echo "<table class='table table-bordered table-hover' style='border:1px solid black'>
                                <tr>
                                    <td>STT</td>
                                    <td>Tên Hàng</td>
                                    <td>ÐVT</td>
                                    <td>Số Lượng</td>
                                    <td>Ðơn Giá</td>
                                    <td>Thành Tiền</td>
                                </tr>";
                                foreach($in[1] as $dh){
                                    //print_r($dt[1]);
                                echo "<tr>
                                    <td>".$i++."</td>
                                    <td>".$dh[4]."</td>
                                    <td>".$dh[5]."</td>
                                    <td>".$dh[2]."</td>
                                    <td>".number_format($dh[6])."</td>
                                    <td>".number_format($dh[3])."</td>
                                </tr>" ;   
                                } 
                           echo " </table>";
                            $flag=true;
                        } 
                     }
                }  
            }
        break;

    }
?>








