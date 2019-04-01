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
            ob_clean();
            header('Location: ?action=donhang' , true, 301);
            
            break;
        case 'dsshop':
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $dsUsers = $user->getUser();
            $view = Page::View();            
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
        break;
        case 'suashop':
        	$user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
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
					$user_id = $_GET['id'];
					 $user = new Users();
                	$user->deleteUsers($user_id);
					header('Location:admin_controller.php?action=dsshop');
                    
				}
			}
			break; 
        break;
         case 'xemdhshop':
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            
            if(isset($_POST['chonngay'])){
                $date = $_POST['chonngay'];
                $dt = date_create($date);
                $date = date_format($dt, 'Y-m-d');
                $dsdonhangshop = $user->Xemdonhangshop($date);
            }
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
            
         break;
        case 'donhang':
            $employ = new Employees();
            $rsEmploy = $employ->getEmployees();
            if(isset($_SESSION['userid']))
            {
                $DSdonhang = null;
                $date = "";
                $user = new Users();
                $id = $_SESSION['userid'];   
                $view = Page::View();
                if(isset($_POST['chonngay']))
                {
                    $ngay = $_POST['chonngay'];
                    $dt=date_create($ngay);
                    $ngay = date_format($dt,'Y-m-d');
                    $DSdonhang1 = $user->gethoadonAmin($ngay);
                    $DSdonhang = $DSdonhang1;
                    $date = $ngay;
                    
                }
                else if(isset($_GET['chonngay']))
                {
                    
                    $ngay = $_GET['chonngay'];
                    $dt=date_create($ngay);
                    $ngay = date_format($dt,'Y-m-d');
                    $DSdonhang1 = $user->gethoadonAmin($ngay);
                    $DSdonhang = $DSdonhang1;
                    $date = $ngay;
                    
                }
                else
                {
                    $date=$user->getNewestDay();
                    $DSdonhang1 = $user->gethoadonAmin($date);
                    $DSdonhang = $DSdonhang1; 
                }
               	$GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');
            
            }
            else
            {
                header('Location:home_controller.php');
                exit;
            }                    
        break;
        //Edit nhan vien và phí phụ thu của khách hàng
        case 'editnhanvien':
            if(isset($_POST['billID']) && isset($_POST['nhanvien'])&&isset($_POST['detailID']))
            {
                $id= $_POST['billID'];
                $nhanvien= $_POST['nhanvien'];
                $phuthu = [];
                $phiship =[];
                $dt = date_create('');
                $date = date_format($dt, 'Y-m-d');
                  
                 foreach($_POST as $k=>$value)
                 {
                    if(strpos($k,'phuthu') > -1 ){
                        $t = trim(str_replace('phuthu','',$k));                                             
                        $phuthu[$t] = $_POST[$k];                        
                    }
                    if(strpos($k,'phiship')>-1){
                        $ps = trim(str_replace('phiship','',$k));
                        $psArr = explode('_',$ps);
                        if($psArr[1]==1)
                        {
                            $phiship[$psArr[0]] = array(0,$_POST[$k]*1000);
                        }
                        else
                        {
                            $phiship[$psArr[0]] = array($_POST[$k]*1000,0);
                        }
                        
                    }
                 }                    
                $user = new Users();
                //print_r($phiship);                
                $user->editnhanvien($date, $nhanvien,$phuthu,$phiship,$id);                                      
                header('Location: ?action=donhang&BillID='. $id .'&chonngay='. $_POST['ngay']);  
            }
        break;
        case 'tinhtrang':
            $idnv=0;
          	$user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            //$edittinhtrang = $user->getTinhtrang();
            if(isset($_POST['submit']))
            {
                if(isset($_POST['chonngay'])){
                    $date = $_POST['chonngay'];
                    $dt = date_create($date);
                    $date = date_format($dt, 'Y-m-d');
                    $edittinhtrang = $user->getTinhtrang($date);
                    $DSdonhang = $edittinhtrang;
                }
                else{
                     if(isset($_GET['idnv']))
                     {
                        $idnv = $_GET['idnv'];                     
                     } 
                        $date = $_GET['ngay'];                     
                        $id = $_POST['billID'];
                        $tinhtrang = $_POST['rd'];
                        $ghichu = $_POST['ghichu'];
                        $phiship = $_POST['phiship'];
                        $luongnv = $phiship * 0.8;
                        $user = new Users();
                        $edithoadon = $user->edittinhtrang($tinhtrang,$ghichu,$phiship,$luongnv,$id);
                        header('Location: ?action=tinhtrang&idnv='.$idnv.'&ngay=' . $date);
                                               
                } 
                $view = Page::View();
                $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');      
            }
            else
            {
                if(isset($_GET['ngay']))
                {
                    $date = $_GET['ngay'];
                    $edittinhtrang = $user->getTinhtrang($date);
                    $DSdonhang = $edittinhtrang;                    
                }
                else
                {
                    $date=null;
                    $dt = date_create($date);
                    $date = date_format($dt, 'Y-m-d');
                    $edittinhtrang = $user->getTinhtrang($date);
                    $DSdonhang = $edittinhtrang;
                    
                } 
                $view = Page::View();
               // $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
                $GLOBALS['template']['content'] = include_once $view;
                include_once('../template/index.php');
            }       
           
        break;
        case 'doanhthungay':
            $doanhthu=null;
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            if(isset($_POST['chonngay']))
            {                
                $date1 =  date_create($_POST['chonngay']);
                $date = date_format($date1,'Y-m-d');
                $DSdonhang = $user->getthongkengay($date);
                $doanhthu = $DSdonhang;
            }
           
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
        break;
        case 'doanhthuthang':
           $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
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
            $rsvitriquangcao1 = $user->carosoulpanel();
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
        //thay doi hinh panel
        case 'doihinh':  
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $rsdoihinh = $user->hinhdoi();   
			if(isset($_FILES['upimg'])){ 
					 $i = $_FILES['upimg'];
                    $img = Image::GetFile($i);
                	$ngay=date('Y-m-d H:i:s');               
                	$user->addhinhanh($img,$ngay);
					header('Location:admin_controller.php?action=doihinh');
                    
			}
			$view = Page::View();
			$GLOBALS['template']['menu'] = include_once'../template/menu.php';
			$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
			$GLOBALS['template']['content'] = include_once $view;
			include_once('../template/index.php');
           	
        break;
        case 'doiquangcao':
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
			if(isset($_GET['id']))
          	{	$id = $_GET['id'];
				$ngay=date('Y-m-d H:i:s');
				$user->doihinhpanel($ngay,$id);
				header('Location:admin_controller.php?action=doihinh');
                
			}
        break;
        case 'deletehinh':
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
                    	$user->deleteHinh($id);
    					header('Location:admin_controller.php?action=doihinh');
                        
    				}
    			}
        break;
        
        //In hóa đơn
        case 'inhoadon':
            if(isset($_GET['billID']))
            {
                 $id = $_GET['billID'];
                $user = new Users();                   
                $thongtin = $user->getHDAdminByID($id) ;
                $header = array('STT','Tên Hàng','ĐVT','SL','Đơn Giá','Thành Tiền');        
                $in = $thongtin;
                //print_r($in);
                    $flag = false;
                        $ngay =$in[$id][0][3];
                        $tem = date_create($ngay);
                        $ngay = date_format($tem, 'd-m-Y');
                        $filename = $ngay . '_' . $in[$id][0][0] . '_' . $id . '.pdf';
                        
                        $pdf = new tFPDF('P', 'mm', 'A6');
                        $pdf->AddPage();
                        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
                        $pdf->SetFont('DejaVu','',9);
                        
                        if($flag == false)
                        {   
                            $pdf->AddFont('DejaVuBold','','DejaVuSansCondensed-Bold.ttf',true);
                            $pdf->SetFont('DejaVuBold','',14);
                            $pdf->Cell(0, 6, "PHIẾU GIAO HÀNG", 0, 0, 'C', false );
                            $pdf->Ln();
                            //$pdf->Write(6, "Ðơn Vị Vận Chuyển SEVEN SHIPPER");
                            $pdf->SetFontSize(10);
                            $pdf->Cell(0, 6, "Ðơn Vị Vận Chuyển SEVEN SHIPPER", 0, 0, 'C', false );
                            $pdf->Ln();
                            $pdf->SetFontSize(9);
                            $pdf->Cell(0, 6, "Ngày giao : " . $ngay, 0, 0, 'C', false );
                            $pdf->Ln();
                            $pdf->SetFont('DejaVu','',9);
                            $pdf->SetTextColor(0);
                            $pdf->SetFillColor(255,255,255);
                            //$pdf->Write(6, "Chủ Hàng: ". $in[$id][0][0]);
//                            $pdf->Ln();
//                            $pdf->Write(6, "Ðịa Chỉ: ". $in[$id][0][1]);
//                            $pdf->Ln();
                            $str = $in[$id][0][6];
                            $pdf->Cell(40,6,"Tên khách hàng : " . $in[$id][0][6],0,0,'L',true);
                            $pdf->Ln();
                            $pdf->Cell(40,6,"Ðịa chỉ : " . ucwords($in[$id][0][2]) ,0,0,'L',true);
                            $pdf->Ln();
                            
                            $pdf->Write(6, "Ðiện thoại khách hàng : " . $in[$id][0][7]);
                            $pdf->Ln();
                            
                            
                            $pdf->Cell(40,6,"Shipper : " . $in[$id][0][4],0,0,'L',true);
                            $pdf->Ln();
                            $pdf->Cell(40,6,"Ðiện thoại Shipper : " . $in[$id][0][5],0,0,'L',true);
                            $pdf->Ln();
                            
                            
                            $pdf->SetFillColor(120,120,120);
                            $pdf->SetTextColor(255);
                            $pdf->SetDrawColor(0,0,0);
                            $pdf->SetLineWidth(.3);
                        
                            $w = array(6, 28, 10, 10, 16, 18);
                            for($i=0;$i<count($header);$i++)
                                $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
                            $pdf->Ln();
                             //Color and font restoration
                            $pdf->SetFillColor(224,235,255);
                            $pdf->SetTextColor(0);
                            $i = 0;
                            $fill = false;
                            $tong = 0;
                            $tongshipkh=0;
                            $tongpt= 0;
                            foreach($in[$id][1] as $row){
                                //print_r($row);
                                $pdf->Cell($w[0], 6, ++$i, 'LR', 0, 'C',$fill);
                                $pdf->Cell($w[1], 6, $row[4], 'LR', 0, 'L', $fill);
                                $pdf->Cell($w[2], 6, $row[5], 'LR', 0, 'C', $fill);
                                $pdf->Cell($w[3], 6, $row[2], 'LR', 0, 'C', $fill);
                                if($row[14] > 0):
                                    $pdf->Cell($w[4], 6, number_format($row[14]). ' ', 'LR', 0, 'R', $fill);
                                    $total = $row[14]*$row[2];
                                else:
                                    $pdf->Cell($w[4], 6, number_format($row[6]). ' ', 'LR', 0, 'R', $fill);
                                    $total = $row[6]*$row[2];
                                endif;
                                $pdf->Cell($w[5], 6, number_format($total). ' ', 'LR', 0, 'R', $fill);
                                $tong += $total;
                                if($row[13]==1)
                                {
                                    $tongshipkh += $row[12];
                                    $tongpt += $row[10];
                                }
                                
                                $pdf->Ln();
                                $fill = !$fill;                                
                            }
                            
                            if($tongshipkh >0)
                            {   
                                if($tongpt==0)
                                {
                                    $pdf->Cell($w[0], 6, '', 'LR', 0, 'C',$fill);
                                    $pdf->Cell($w[1], 6, 'Phí Ship', 'LR', 0, 'L', $fill);
                                    $pdf->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[3], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[4], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[5], 6,  number_format($in[$id]['shipshop']) . ' ','LR', 0, 'R', $fill);
                                    $pdf->Ln();
                                    $pdf->Cell($w[0], 6, '', 'LR', 0, 'C',$fill);
                                    $pdf->Cell($w[1], 6, '', 'LR', 0, 'L', $fill);
                                    $pdf->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[3], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->SetFont('DejaVuBold','',9);
                                    $pdf->Cell($w[4], 6, 'TỔNG', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[5], 6, number_format($tong+$in[$id]['shipshop']) . ' ', 'LR', 0, 'R', $fill);
                                    $pdf->Ln();
                                    $pdf->SetFont('DejaVu','',9);
                                }
                                else
                                {
                                    $pdf->Cell($w[0], 6, '', 'LR', 0, 'C',$fill);
                                    $pdf->Cell($w[1], 6, 'Phí Ship', 'LR', 0, 'L', $fill);
                                    $pdf->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[3], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[4], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[5], 6,  number_format($in[$id]['shipshop']) . ' ','LR', 0, 'R', $fill);
                                    $pdf->Ln();
                                    $pdf->Cell($w[0], 6, '', 'LR', 0, 'C',$fill);
                                    $pdf->Cell($w[1], 6, 'Phí Phụ Thu', 'LR', 0, 'L', $fill);
                                    $pdf->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[3], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[4], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[5], 6,  number_format($in[$id]['tongphuthu']) . ' ','LR', 0, 'R', $fill);
                                    $pdf->Ln();
                                    $pdf->Cell($w[0], 6, '', 'LR', 0, 'C',$fill);
                                    $pdf->Cell($w[1], 6, '', 'LR', 0, 'L', $fill);
                                    $pdf->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[3], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->SetFont('DejaVuBold','',9);
                                    $pdf->Cell($w[4], 6, 'TỔNG', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[5], 6, number_format($tong+$in[$id]['shipshop']+$in[$id]['tongphuthu']) . ' ', 'LR', 0, 'R', $fill);
                                    $pdf->Ln();
                                    $pdf->SetFont('DejaVu','',9);
                                }
                            }
                            else
                            {
                                if($tongpt==0)
                                {                                   
                                    $pdf->Cell($w[0], 6, '', 'LR', 0, 'C',$fill);
                                    $pdf->Cell($w[1], 6, '', 'LR', 0, 'L', $fill);
                                    $pdf->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[3], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->SetFont('DejaVuBold','',9);
                                    $pdf->Cell($w[4], 6, 'TỔNG', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[5], 6, number_format($tong) . ' ', 'LR', 0, 'R', $fill);
                                    $pdf->Ln();
                                    $pdf->SetFont('DejaVu','',9);
                                }
                                else
                                {
                                    $pdf->Cell($w[0], 6, '', 'LR', 0, 'C',$fill);
                                    $pdf->Cell($w[1], 6, 'Phí Phụ Thu', 'LR', 0, 'L', $fill);
                                    $pdf->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[3], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[4], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[5], 6,  number_format($in[$id]['tongphuthu']) . ' ','LR', 0, 'R', $fill);
                                    $pdf->Ln();
                                    $pdf->Cell($w[0], 6, '', 'LR', 0, 'C',$fill);
                                    $pdf->Cell($w[1], 6, '', 'LR', 0, 'L', $fill);
                                    $pdf->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[3], 6, '', 'LR', 0, 'C', $fill);
                                    $pdf->SetFont('DejaVuBold','',9);
                                    $pdf->Cell($w[4], 6, 'TỔNG', 'LR', 0, 'C', $fill);
                                    $pdf->Cell($w[5], 6, number_format($tong+$in[$id]['tongphuthu']) . ' ', 'LR', 0, 'R', $fill);
                                    $pdf->Ln();
                                    $pdf->SetFont('DejaVu','',9);
                                }
                            }
                           //print_r($in);
//                        
//                             //Closing line
                            $pdf->Cell(array_sum($w),0,'','T');
                           
                            $pdf->Ln();
                            $pdf->SetTextColor(0);
                            $pdf->SetFillColor(255,255,255);
                            $pdf->Cell(40,15,"     NGƯỜI NHẬN " ,0,0,'L',true);
                            $pdf->Cell(40,15,"         NGUỜI LẬP BẢNG " ,0,0,'L',true);
                            
                            $pdf->Ln();
                            $pdf->Ln();
                            $pdf->Output($filename,'D');
                            //print_r($filename);                           
                        
             }    
            }
        break;
        case 'xemhdnhanship':
            $ship_invoices = new ShipServiceInvoice();
            $rsShipInvoices = $ship_invoices->listShipInvoices();
            $employeeObj = new Employees();
            $rsEmployee = $employeeObj->getEmployees(); 
            $view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            $GLOBALS['template']['footer'] = include_once'../template/footer.php';
            include_once('../template/index.php');
        break;
       case 'capnhathdnhanship':
            if(isset($_POST['submit'])){
                $ship_id = $_POST['ship_id'];
                $surcharge = $_POST['surcharge'];
                $surcharge_reason = $_POST['surcharge_reason'];
                $employee = $_POST['employee'];
                $tienhang = $_POST['tienhang'];
                $date = date_create();
                $delivery_date = $date->format('Y-m-d h:i:s');
                
                $ship_invoices = new ShipServiceInvoice();
                $ship_invoices->updateShipInvoices($tienhang, $surcharge, $surcharge_reason, $employee, $delivery_date, $ship_id);
                MessageBox::Show("Cập Nhật Thành Công", MB_SHOPPINGCART);
            }
       break;
         //In hóa đơn ship ngoai
        case 'in_hd_nhan_ship':
            if(isset($_GET['shipID']))
            {
                $tong = 0;
                 $id = $_GET['shipID'];
                $ship_invoices = new ShipServiceInvoice();
            $rsShipInvoices = $ship_invoices->listShipInvoices($id);
                $header = array('STT','Tên Hàng','ĐVT','SL','Đơn Giá','Thành Tiền');        
                
                //print_r($in);
                    $flag = false;
                        $ngay =$rsShipInvoices[0]->delivery_date;
                        $tem = date_create($ngay);
                        $ngay = date_format($tem, 'd-m-Y');
                        $filename = $ngay . '_' . $rsShipInvoices[0]->customer_shop . '_' . $id . '.pdf';
                        
                        $pdf = new tFPDF('P', 'mm', 'A6');
                        $pdf->AddPage();
                        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
                        $pdf->SetFont('DejaVu','',9);
                        
                        if($flag == false)
                        {   
                            $pdf->AddFont('DejaVuBold','','DejaVuSansCondensed-Bold.ttf',true);
                            $pdf->SetFont('DejaVuBold','',14);
                            $pdf->Cell(0, 6, "PHIẾU GIAO HÀNG", 0, 0, 'C', false );
                            $pdf->Ln();
                            //$pdf->Write(6, "Ðơn Vị Vận Chuyển SEVEN SHIPPER");
                            $pdf->SetFontSize(10);
                            $pdf->Cell(0, 6, "Ðơn Vị Vận Chuyển SEVEN SHIPPER", 0, 0, 'C', false );
                            $pdf->Ln();
                            $pdf->SetFontSize(9);
                            $pdf->Cell(0, 6, "Ngày giao : " . $ngay, 0, 0, 'C', false );
                            $pdf->Ln();
                            $pdf->SetFont('DejaVuBold','',9);
                            $pdf->SetTextColor(0);
                            $pdf->SetFillColor(255,255,255);
                            
                            $pdf->Cell(40,6,"Tên chủ hàng : " . $rsShipInvoices[0]->customer_shop ,0,0,'L',true);
                            $pdf->Ln();
                            $pdf->SetFont('DejaVu','',9);
                            $pdf->Cell(40,6,"Địa chỉ : " . $rsShipInvoices[0]->shopaddress . ', ' . $rsShipInvoices[0]->shopDistrict ,0,0,'L',true);
                            $pdf->Ln();
                            $pdf->Cell(40,6,"Điện thoại : " . $rsShipInvoices[0]->shopphone ,0,0,'L',true);
                            $pdf->Ln();
//                            $pdf->Write(6, "Ðịa Chỉ: ". $in[$id][0][1]);
                            $pdf->SetFont('DejaVuBold','',9);
                            $pdf->Cell(40,6,"Tên khách hàng : " . $rsShipInvoices[0]->customer_client,0,0,'L',true);
                            $pdf->Ln();
                            $pdf->SetFont('DejaVu','',9);
                            $pdf->Cell(40,6,"Ðịa chỉ : " . ucwords($rsShipInvoices[0]->customer_address. ', ' . $rsShipInvoices[0]->clientDistrictName) ,0,0,'L',true);
                            $pdf->Ln();
                            if($rsShipInvoices[0]->customer_require != ""){
                                $pdf->Cell(40,6,"Yêu cầu riêng : " . $rsShipInvoices[0]->customer_require, 0, 0, 'L',true);
                                $pdf->Ln();
                            }
                            $pdf->Cell(40, 6, "Ðiện thoại : " . $rsShipInvoices[0]->clientphone);
                            $pdf->Ln();
                            
                            $pdf->SetFont('DejaVuBold','',10);
                            $pdf->Cell(0, 6, "CHI TIẾT PHIẾU GIAO HÀNG", 0, 0, 'C', false );
                            $pdf->Ln();
                            
                            $pdf->SetFont('DejaVu','',9);
                            $pdf->Cell(40,6,"Tên Shipper : " . $rsShipInvoices[0]->employeeName, 0,0,'L',true);
                            $pdf->Ln();
                            $pdf->Cell(40,6,"Ðiện thoại Shipper : " . $rsShipInvoices[0]->employeePhone,0,0,'L',true);
                            $pdf->Ln();
                            $tong+= $rsShipInvoices[0]->total;
                            $pdf->Cell(40,6,"Tiền hàng : " . number_format($rsShipInvoices[0]->total) . ' VND', 0,0,'L',true);
                            $pdf->Ln();
                            $tong+= $rsShipInvoices[0]->ship_fee;
                            $pdf->Cell(40,6,"Phí ship : " . number_format($rsShipInvoices[0]->ship_fee) . ' VND', 0,0,'L',true);
                            $pdf->Ln();
                            if($rsShipInvoices[0]->surcharge > 0){
                                $tong+= $rsShipInvoices[0]->surcharge;
                                $pdf->Cell(40,6,"Phụ thu : " . number_format($rsShipInvoices[0]->surcharge) . ' VND', 0,0,'L',true);
                                $pdf->Ln();
                                $pdf->Cell(40,6,"Diễn giải phụ thu: " . $rsShipInvoices[0]->surcharge_reason, 0,0,'L',true);
                                $pdf->Ln();
                            }
                          
                            $pdf->SetFont('DejaVuBold','',10);
                            $pdf->Cell(0, 6, "TỔNG CỘNG: " . number_format($tong) . ' VND', 0, 0, 'L', false );
                            $pdf->Ln();
                            
                            $pdf->SetFont('DejaVu','',9);
                            $pdf->Ln();
                            $pdf->SetTextColor(0);
                            $pdf->SetFillColor(255,255,255);
                            $pdf->Cell(40,15,"     NGƯỜI NHẬN " ,0,0,'L',true);
                            $pdf->Cell(40,15,"         NGUỜI LẬP BẢNG " ,0,0,'L',true);
                            
                            $pdf->Ln();
                            $pdf->Ln();
                            $pdf->Output($filename,'D');
                            //print_r($filename);                           
                        
             }    
            }
        break;
}

