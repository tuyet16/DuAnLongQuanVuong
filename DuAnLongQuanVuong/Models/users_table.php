<?php
class Users extends Database{
    private $categoryId;
    private $categoryName;
    public function __construct() {
        parent::__construct();
        
    }   
    public function getUser(){
        $query = 'SELECT * FROM users';
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getUserByID($id){   
        $query = 'SELECT * FROM users WHERE userid=?';
        $param = array();
        $param[] = $id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function login($email, $pass)
    {
        $query = 'select * from users where email=? and password=?';
        $param = array();
        $param[] = $email;
        $param[] = $pass;
        $rs = $this->doQuery($query,$param);
        return $rs;
   }
   public function changePass($pass,$id){
		$query = 'UPDATE users SET password=? WHERE userid=?';
        $param = array();
        $param[] = $pass;
        $param[] = $id;
        $this->doQuery($query, $param);   
   }
    public function addUser($pass,$fullname,$email,$address,$phone,$tenshop){
        $query = 'INSERT INTO users(password,fullname,email,address,phone,shopName) VALUES(?,?,?,?,?,?)';
        $param = array();
        $param[] = $pass;
        $param[] = $fullname;
        $param[] = $email;
        $param[] = $address;
        $param[] = $phone;
        $param[] = $tenshop;
        $this->doQuery($query, $param);
    }
    public function deleteUsers($unitID){
        $query = 'DELETE FROM users WHERE userid=?';
        $param = array();
        $param[]= $unitID;
        $this->doQuery($query, $param);
    }
    public function editUsers($fullname,$email,$address,$phone,$tenshop,$id){
        $query = 'UPDATE users SET fullname=?,email=?,address=?,phone=?,shopName=? WHERE userid=?';
        $param = array();
        $param[] = $fullname;
        $param[] = $email;
        $param[] = $address;
        $param[] = $phone;
        $param[] = $tenshop;
        $param[] = $id;
        $this->doQuery($query, $param);
    }
    //Hoa don cho cac chu shop
    public function getHoadon($id, $date)
    {
        $tongtien =0;
        $donhangarr = array();
        $query ='select distinct bi.* from bills bi,products pr, detailsbills dt 
                        where bi.billID = dt.billID and dt.productID = pr.productID 
                                and pr.userid=? and bi.PurchaseDate = ? 
                        order by bi.PurchaseDate desc';
        $param = array();
        $param[] = $id;
        $param[] = $date;
        $rs = $this->doQuery($query,$param);
        foreach($rs as $bill)
        {
            $donhangarr[$bill->PurchaseDate][$bill->billID][0]= array($bill->customerID,$bill->billingAddress
                                                                    ,$bill->delivery,$bill->totalPrice,
                                                                    $bill->tinhtrang,$bill->shopcheck, 
                                                                    $bill->PurchaseDate);
            $tongtien += $bill->totalPrice;
            $sql = 'select * from customers cs, districts dt where cs.districtID = dt.districtID and customerID=?';
            $param =array();
            $param[]=$bill->customerID;
            $cs = $this->doQuery($sql,$param);
            $donhangarr[$bill->PurchaseDate][$bill->billID][1] = array($cs[0]->customerName
                                ,$cs[0]->address,$cs[0]->phone,$cs[0]->districtName);
                         
            $sql1 = 'select dt.*,pr.productName, pr.unitID,un.unitName,pr.price as gia from detailsbills dt,products pr,units un             
                                where dt.productID=pr.productID and pr.unitID=un.unitID 
                                        and dt.billID=? and pr.userid=?';
            $param = array();
            $param[]= $bill->billID;
            $param[] = $id;
            $dt = $this->doQuery($sql1,$param);
            $tong_dt = 0;
            foreach($dt as $detail)
            {
                $donhangarr[$bill->PurchaseDate][$bill->billID][2][]=array($detail->detailID,
                                                                    $detail->amount,
                                                                    $detail->price,
                                                                    $detail->productName,
                                                                    $detail->unitName,
                                                                    $detail->gia,
                                                                    $detail->discount,
                                                                    $detail->shop_acceptance,
                                                                    $detail->nguoitraship);
                if($detail->discount != 0){
                    $tong_dt += $detail->amount * $detail->gia * ((100-$detail->discount)/100);
                }
                else{
                    $tong_dt += $detail->amount * $detail->gia;
                }
                
            }                        
            $donhangarr[$bill->PurchaseDate][$bill->billID][0][3] = $tong_dt;
        }
        return $donhangarr;
    }
    public function deleteDetailID($id){
        $sql ='DELETE FROM detailsbills WHERE detailID =?';
        $param = array();
        $param[] =$id;
        $this->doQuery($sql,$param);
    }
    //cập nhật số tiền mà shop đã trao đổi với khách hàng về đơn hàng và thay đổi phí ship là do ai trả khách hay shop
    public function editDetailPriceByID($soluong,$gia,$giamgia,$nguoitra,$detailID)
    {
        $sql ='update detailsbills set amount=?,price=?,discount=?, nguoitraship=? where detailID =?';
        $param = array();
        $param[]=$soluong;
        $param[]= $gia;
        $param[] = $giamgia;
        $param[] = $nguoitra;        
        $param[] =$detailID;
        $this->doQuery($sql,$param);
        
       // $sql1 ="update bills set nguoitraship=? where detailID=?";
//        $param = array();
//        $param[] = $nguoitra;
//        $param[] =$billID;
//        $this->doQuery($sql1,$param);
    }
    public function editBillByID($price,$billID)
    {
        $sql ='update bills set totalPrice=? where billID=? ';
        $param = array();
        $param[]= $price;
        $param[] = $billID;
        $this->doQuery($sql,$param);
    }
    //khi nhấn gửi đơn hàng thì sẽ cập nhật tình trạng shop đã gửi đơn hàng cho shop
    public function guidonhang($id)
    {
        $detail_id_arr = explode('_', $id);
        $questions = str_repeat('?,', count($detail_id_arr)-1) . '?';
        print_r($detail_id_arr);
        $query = "update detailsbills set shop_acceptance=1 where detailID IN ($questions)";
        $param = array();
        foreach($detail_id_arr as $detail_id){
            $param[] = $detail_id;
        }
        $rs = $this->doQuery1($query,$param);
        $query1= "select bi.totalPrice, bi.billID from detailsbills dt, bills bi where dt.billID = bi.billID and dt.detailID =?";
        $param = array();
        $param[] = $detail_id_arr[0];
        $rs = $this->doQuery($query1,$param);
        $totalprice = $rs[0]->totalPrice;
       // echo $totalprice;
        
        $billID = $rs[0]->billID;
        //echo $billID.'<br/>';
        $sql = "select thanhtien from detailsbills where detailID=?";        
        foreach($detail_id_arr as $detailID )
        {
            $param = array();
            $param[] = $detailID;
            $rs1 = $this->doQuery($sql,$param);
            $totalprice+= $rs1[0]->thanhtien;
           // echo $rs1[0]->thanhtien.'<br/>';
            //echo $totalprice.'<br/>';
        }
        echo $totalprice;
        $sql1 ='update bills set totalPrice=? where billID=? ';
        $param = array();
        $param[]= $totalprice;
        $param[] = $billID;
        $this->doQuery($sql1,$param);
    
    }
    //Phần  này của admin
    
    //In hóa Đơn
     public function getHDAdminByID($id)
    {
        $tongphuthu=0;
        $shipshop=0;
        $donhangarr = array();
        $query ='select distinct us.fullname,us.address,
                        bi.billID,
                        bi.setDate,
                        bi.billingAddress,
                        bi.phiship,
                        bi.nguoitraship,
                        bi.idEm,
                        bi.totalPrice,ep.employeeName,
                    ep.phone as sdtNV,cs.customerName,cs.phone as sdtkh,
                    dt.productID 
                    from bills bi,users us,customers cs,employees ep,
                    detailsbills dt,products pr where bi.idEm = ep.idEm and bi.customerID = cs.customerID and 
                    dt.productID = pr.productID and pr.userid=us.userid and bi.billID=?';
        $param = array();
        $param[] = $id;
        $rs = $this->doQuery($query,$param);
       
        foreach($rs as $bill)
        {
            $donhangarr[$bill->billID][0]= array($bill->fullname,$bill->address,$bill->billingAddress,$bill->setDate,$bill->employeeName
                           ,$bill->sdtNV,$bill->customerName,$bill->sdtkh,$bill->phiship,$bill->totalPrice,$bill->nguoitraship,$bill->idEm);
            $sql1 = 'select dt.*,pr.productName, pr.unitID,un.unitName,pr.price as gia from detailsbills dt,products pr,units un             
                                where dt.productID=pr.productID and pr.unitID=un.unitID and dt.billID=? and dt.ProductID=?';
            $param = array();
            $param[] = $id;
            $param[] = $bill->productID;
            $dt = $this->doQuery($sql1,$param);
            
            foreach($dt as $detail)
            {
                $donhangarr[$bill->billID][1][]=array($detail->detailID,
                                                        $detail->productID,
                                                        $detail->amount,
                                                        $detail->price,
                                                        $detail->productName,
                                                        $detail->unitName,
                                                        $detail->gia,
                                                        $detail->discount,
                                                        $bill->fullname,
                                                        $bill->address,
                                                        $detail->phuthu,                                                        
                                                        $detail->phishipshop,
                                                        $detail->phishipkh,
                                                        $detail->nguoitraship);
                $tongphuthu += $detail->phuthu;
                if($detail->nguoitraship ==1)
                {
                    $shipshop += $detail->phishipkh;
                }
            }
                $donhangarr[$bill->billID]['tongphuthu'] =$tongphuthu;   
                $donhangarr[$bill->billID]['shipshop'] =$shipshop;        
        }
              
        return $donhangarr;
    }
    //đơn hàng mà admin nhận mỗi ngày
    public function gethoadonAmin($ngay=null)
    {
        $tongtien =0;
        $donhangarr = array();
        if($ngay != null)
        {
            $query ='select distinct bi.* from bills bi,products pr, detailsbills dt,users us
                where bi.billID = dt.billID and dt.productID = pr.productID and us.userid=pr.userid
                        and dt.shop_acceptance=1 and bi.PurchaseDate=? order by bi.PurchaseDate desc';
            $param = array();
            $param[] = $ngay;
            $bi = $this->doQuery($query,$param); 
        }
        else
        {        
            $query ='select distinct bi.* from bills bi,products pr, detailsbills dt ,users us
                    where bi.billID = dt.billID and dt.productID = pr.productID and us.userid=pr.userid and dt.shop_acceptance=1 
                    order by bi.PurchaseDate';
            $param = array();
            $bi = $this->doQuery($query); 
        }    
                          
        foreach($bi as $bill)
        {
            $donhangarr[$bill->billID]['thongtinbill']= array($bill->customerID,$bill->billingAddress,$bill->delivery
                ,$bill->totalPrice,$bill->tinhtrang,$bill->shopcheck,$bill->idEm,$bill->nguoitraship,$bill->phiship);
            $tongtien += $bill->totalPrice;
            //khach hangf
            $sql = 'select cs.*, dt.districtName  from customers cs, districts dt where cs.districtID = dt.districtID and cs.customerID=?';
            $param =array();
            $param[]=$bill->customerID;
            $cs = $this->doQuery($sql,$param);
            
            $donhangarr[$bill->billID]['thongtinkh'] = array($cs[0]->customerName
                                ,$cs[0]->address,$cs[0]->phone,$cs[0]->districtName); 
              //cacs shop                      
            $query1 = 'select distinct bi.*,us.userid,us.fullname,us.phone from bills bi,products pr, detailsbills dt ,users us
                    where bi.billID = dt.billID and dt.productID = pr.productID and dt.shop_acceptance=1 and us.userid =pr.userid 
                  and bi.billID=? order by bi.PurchaseDate ';
            $param = array();
            $param[] =$bill->billID;
            $rs = $this->doQuery($query1,$param); 
            $soshop=0;   
             
            foreach($rs as $user)
            {
                $donhangarr[$bill->billID][$user->userid]['tenshop']= array($user->fullname,$user->phone);        
                $soshop ++; 
                $sql1 = 'select dt.*,pr.productName, pr.unitID,un.unitName,pr.price as gia ,dt.phuthu  
                            from detailsbills dt , users us ,products pr,units un where dt.productID=pr.productID 
                            and pr.userid= us.userid and pr.unitID=un.unitID and dt.billID=? and us.userid =?';
                $param = array();
                $param[]= $bill->billID;
                $param[]= $user->userid;
                $dt = $this->doQuery($sql1,$param);         
                foreach($dt as $detail)
                {
                    $donhangarr[$bill->billID][$user->userid]['detail'][]=array($detail->detailID,$detail->productID,$detail->amount
                                            ,$detail->price,$detail->productName,$detail->unitName,$detail->gia,$detail->discount,
                                            $detail->phuthu,$detail->phishipshop,$detail->phishipkh,$detail->nguoitraship,$detail->thanhtien);
                    //$tongtien = sum($detail->thanhtien); 
            
                }                                                   
            } $donhangarr[$bill->billID]['soshop']= $soshop; 
           // $donhangarr[$bill->billID]['thanhtien']= $tongtien;      
        }
        return $donhangarr;
    } 
   //Cập nhật nhân viên giao hàng, cập nhật phí ship và phụ thu các shop
    public function editnhanvien($date, $idEm,$phuthu,$phishipshop,$id)
    {
        $query = 'update bills set setDate=?, idEm=? where billID=?';
        $param = array();
        $param[] = $date;
        $param[] = $idEm;
        $param[] = $id;
        $this->doQuery($query,$param);
        
       foreach($phuthu as $dtID=>$pt){
            $sql = 'update detailsbills set phuthu=? where detailID=?';
            $param = array();
            $param[] = $pt;    
            $param[] = $dtID;
            $this->doQuery($sql,$param);
        }
    //print_r($phishipshop);
        foreach($phishipshop as $k=>$ps)
        {
            $sql = 'update detailsbills set phishipshop=?, phishipkh=? where detailID=? ';
            $param = array();
            $param[] = $ps[0];
            $param[] = $ps[1];
            $param[] = $k;
            $this->doQuery($sql,$param);
            // print_r($sql);
        }
       
    } 
   //edit tình trạng giao hàng đã giao hoặc chưa giao
    public function edittinhtrang($tinhtrang,$ghichu,$phiship,$luongnv,$id)
    {
        $query ='Update bills set tinhtrang =?, ghichu=?, phiship=?,luongnv=?  where billID=?';
        $param = array();
        $param[] = $tinhtrang;
        $param[] = $ghichu;
        $param[] = $phiship;
        $param[] =$luongnv;
        $param[] = $id;
        $rs = $this->doQuery($query,$param);
        return $rs;
    }
    //Danh sách các đơn hàng và trong tình trạng đã giao hay chưa
    public function getTinhtrang($date=null)
    {
        $tinhtrangArr = array();
        
        $query ='select distinct * from bills Where setDate = ? order by setDate desc';
        $param = array();
        $param[] = $date;
        $rs = $this->doQuery($query, $param);
        foreach($rs as $bill)
        {    
            $tinhtrangArr[$bill->setDate]= array();
            $ep = 'select distinct bi.*,ep.employeeName,ep.phone from 
                    bills bi,employees ep where bi.idEm = ep.idEm and bi.setDate=?';
            $param = array();
            $param[] = $bill->setDate;
            $nv = $this->doQuery($ep,$param);
            foreach($nv as $nvngay)
            {                
                $tinhtrangArr[$bill->setDate][$nvngay->idEm][0]=array($nvngay->employeeName,$nvngay->phone,$nvngay->idEm,0);
                $sql1 ='select distinct bi.*,ep.employeeName,ep.phone,cs.customerName,ds.districtName,ds.districtID from 
                    bills bi,employees ep, customers cs, districts ds where bi.idEm = ep.idEm and 
                         bi.customerID=cs.customerID and cs.districtID = ds.districtID and bi.idEm=? and bi.setDate=?';
                $param= array();
                $param[]= $nvngay->idEm;
                $param[] = $bill->setDate;                
                $getma = $this->doQuery($sql1,$param);
                $j=0;
                foreach($getma as $hd)
                {
                    $tinhtrangArr[$bill->setDate][$nvngay->idEm][1][$j]=array($hd->billingAddress , $hd->customerName 
                    ,$hd->delivery,$hd->totalPrice,$hd->tinhtrang,$hd->ghichu,$hd->districtName,$hd->districtID,$hd->billID,
                    $hd->phiship,$hd->luongnv);
                   $j++;
                }                
            }
        }
        return $tinhtrangArr;        
    } 
    //thống kê doanh thu theo ngày
    public function getthongkengay($ngay=null)
    {     
        $thongkeArr = array();
        $tongdoanhthu=0;
        $tongphuthuall =0;
        
        if($ngay != null)
        {
            $query ='select distinct us.userid,us.fullname from bills bi,products pr, detailsbills dt ,users us
                where bi.billID = dt.billID and dt.productID = pr.productID and us.userid= pr.userid and 
                dt.shop_acceptance=1 and setDate=? order by bi.setDate desc';
            $param = array();
            $param[] = $ngay;
            $dtngay = $this->doQuery($query,$param); 
        }
        else
        {
            $query ='select distinct us.userid,us.fullname from bills bi,products pr, detailsbills dt ,users us
                    where bi.billID = dt.billID and dt.productID = pr.productID and us.userid=pr.userid and 
                    dt.shop_acceptance=1 order by bi.setDate desc';
            $param = array();
            $dtngay = $this->doQuery($query); 
        }
        $tongluong =0;
        foreach($dtngay as $user)
        {  
            $thongkeArr[$user->userid]['thongtinshop'][0]= $user->fullname;    
                           
            $sql = 'select distinct bi.*,cs.customerName,ep.employeeName
                    from bills bi, customers cs, employees ep, detailsbills dt, products pr, users us
                    where bi.customerID = cs.customerID and bi.idEm = ep.idEm and dt.billID = bi.billID 
                        and dt.productID = pr.productID and us.userid = pr.userid and bi.setDate=? and us.userid = ?' ;
            $param = array();
            $param[] = $ngay;
            $param[] = $user->userid;
            $thongtin = $this->doQuery($sql,$param);
            //Khai báo các biến tính tong
            $tongdoanhthushop=0; 
            $tongshipshop =0;
            $tongshipkh =0;
            $tongphuthushop =0;
            $i=1;
             $tongship =0;  
             
             //lấy thông tin bill
            foreach($thongtin as $tt)
            {                
                $thongkeArr[$user->userid]['thongtinshop'][$i][0]= array($tt->billID,$tt->customerName,$tt->totalPrice,$tt->employeeName,
                                        $tt->tinhtrang,$tt->phiship,$tt->luongnv);     
                 $sql1 = 'select dt.* from detailsbills dt, products pr, users us
                                 where dt.productID= pr.productID and us.userid = pr.userid and dt.billID=? and us.userid=?';
                 $param = array();
                 $param[] = $tt->billID;
                 $param[] = $user->userid;
                 $dt = $this->doQuery($sql1,$param);
                 
                 $tongphuthu=0;                      
                 $tongtientungbill=0;
                 $shiptungshop = 0;  
                 if($tt->tinhtrang == 2)
                 {  
                     $tongluong +=$tt->luongnv ;
                 }
                 
                 //lay thong tin detail                
                 foreach($dt as $detail)
                 {
                    $thongkeArr[$user->userid]['thongtinshop'][$i][1][]=array($detail->detailID,$detail->phuthu,
                                    $detail->price,$detail->amount,$detail->thanhtien,$detail->phishipshop,$detail->phishipkh,
                                    $detail->nguoitraship);
                                    
                    $tongphuthu += $detail->phuthu;
                    $tongtientungbill += $detail->price * $detail->amount;
                    $shiptungshop += $detail->phishipshop;
                    
                   if($tt->tinhtrang == 2)
                   {  
                        $tongdoanhthushop += $detail->thanhtien;  
                        $tongphuthushop+= $detail->phuthu;
                        if($detail->nguoitraship == 0)
                        {
                            $tongshipshop += $detail->phishipshop;
                        }
                        if($detail->nguoitraship ==1)
                        {
                            $tongshipkh += $detail->phishipkh;                        
                        }
                    }
                   $thongkeArr[$user->userid]['thongtinshop'][$i][0]['tongtientungbill']=$tongtientungbill;             
                 } 
                 
                  $tongship = $tongshipshop+$tongshipkh ; 
                 $thongkeArr[$user->userid]['thongtinshop'][$i][0]['tongphuthu']=$tongphuthu;
                  $thongkeArr[$user->userid]['thongtinshop'][$i][0]['shiptungshop']=$shiptungshop;                 
                  
                //tinh so hoa don da giao va chua giao
                $tongchuagiao = 0;
                $tongdagiao =0;                                
                $tongdg = 'select count(bi.tinhtrang) as dagiao
                        from bills bi, customers cs, employees ep, detailsbills dt, products pr, users us
                        where bi.customerID = cs.customerID and bi.idEm = ep.idEm and dt.billID = bi.billID and 
                        dt.productID = pr.productID and us.userid = pr.userid and tinhtrang = 2  and bi.setDate=? and us.userid = ?';
                $param =array();
                $param[] = $ngay;
                $param[] =$user->userid;
                $dg = $this->doQuery($tongdg,$param);
                $tongdagiao = $dg[0]->dagiao;
                $thongkeArr[$user->userid]['dagiao'] = $tongdagiao;  
                
                 $tongcg = 'select count(bi.tinhtrang) as chuagiao
                    from bills bi, customers cs, employees ep, detailsbills dt, products pr, users us
                    where bi.customerID = cs.customerID and bi.idEm = ep.idEm and dt.billID = bi.billID and 
                    dt.productID = pr.productID and us.userid = pr.userid and tinhtrang <> 2  and bi.setDate=? and us.userid = ?';
                $param =array();
                $param[] =$ngay;
                $param[] =$user->userid;
                $hd = $this->doQuery($tongcg,$param);
                $tongchuagiao = $hd[0]->chuagiao;
                //$thongkeArr[$user->userid]['chuagiao'] = $tongchuagiao; 
                $i++;
            }
            
            
            //số hóa đơn đã giao của từng shop
                $thongkeArr[$user->userid]['tongdtshop']=$tongdoanhthushop;
                $thongkeArr[$user->userid]['tongshipshop']=$tongshipshop;
                $thongkeArr[$user->userid]['tongshipkh']=$tongshipkh;
                $thongkeArr[$user->userid]['tongphuthushop']=$tongphuthushop;
                $tongdoanhthu += $tongdoanhthushop;
                $tongphuthuall += $tongphuthushop;
                //$tongluong +=$tt->luongnv;
               
                //$thongkeArr[$user->userid]['tongdoanhthushop']=$tongdoanhthushop;  
                 $thongkeArr['tongship']= $tongship;
                 
        }
          $thongkeArr['tongluong']= $tongluong;
          $thongkeArr['tongdoanhthu'] = $tongdoanhthu;
          $thongkeArr['tongphuthuall']= $tongphuthuall;  
           
          //$thongkeArr['dagiao'] = $tongdagiao;
         // $thongkeArr['chuagiao'] = $tongchuagiao;
        return $thongkeArr;
    } 
    //thong kê doanh thu hàng tháng
    public function getthongkethang($thang,$nam)
    {
        $thongkethangArr=array();
        $query = 'select distinct setDate from bills where Month(setDate)=? and Year(setDate)=? order by setDate desc';
        $param = array();
        $param[] = $thang;
        $param[] = $nam;
        $rs= $this->doQuery($query,$param);
        foreach($rs as $dt)
        {            
            $thongkethangArr[$dt->setDate] = array();
            $sql ='select count(*) as tonghd, SUM(totalPrice) as doanhthu,SUM(phiship) as tongphiship,
                            SUM(luongnv) as tongluonngnv from bills where setDate=? and tinhtrang=2';
            $param =array();
            $param[] = $dt->setDate ;
            $doanhthu = $this->doQuery($sql,$param);    
            foreach($doanhthu as $tt)
            {
                $thongkethangArr[$dt->setDate]['tonghdngay'] = $tt->tonghd;
                $thongkethangArr[$dt->setDate]['doanhthungay'] = $tt->doanhthu;
                $thongkethangArr[$dt->setDate]['tongphishipngay'] = $tt->tongphiship;
                $thongkethangArr[$dt->setDate]['tongluongnvngay'] = $tt->tongluonngnv;
            }  
           
            $tongcg = 'select count(*) as tonghd, SUM(totalPrice) as doanhthu,SUM(phiship) as tongphiship,
                            SUM(luongnv) as tongluonngnv from bills where setDate=? and tinhtrang<>2';
            $param =array();
            $param[] = $dt->setDate ;
            $chuagiao = $this->doQuery($tongcg,$param);            
            foreach($chuagiao as $cg)
            {
                $thongkethangArr[$dt->setDate]['hdchuagiao'] = $cg->tonghd;
                $thongkethangArr[$dt->setDate]['doanhthuchuagiao'] = $cg->doanhthu;
                $thongkethangArr[$dt->setDate]['phishipchuagiao'] = $cg->tongphiship;
                $thongkethangArr[$dt->setDate]['luongchuagiao'] = $cg->tongluonngnv;
            }                     
        }
            $dagiaothang = 'select count(*) as tonghd, SUM(totalPrice) as doanhthu,SUM(phiship) as tongphiship,
                SUM(luongnv) as tongluonngnv from bills where Month(setDate)=? and Year(setDate)=? and tinhtrang =2';
            $param = array();
            $param[] = $thang;
            $param[] = $nam;
            $hddagiao = $this->doQuery($dagiaothang,$param);
            foreach($hddagiao as $hddg)
            {
                $thongkethangArr['hdthanggiao'] = $hddg->tonghd;
                $thongkethangArr['doanhthuthanggiao'] = $hddg->doanhthu;
                $thongkethangArr['shipthanggiao'] = $hddg->tongphiship;
                $thongkethangArr['luongthanggiao'] = $hddg->tongluonngnv;
            }    
            $chuagiaothang = 'select count(*) as tonghd, SUM(totalPrice) as doanhthu,SUM(phiship) as tongphiship,
                SUM(luongnv) as tongluonngnv from bills where Month(setDate)=? and Year(setDate)=? and tinhtrang <>2';
            $param = array();
            $param[] = $thang;
            $param[] = $nam;
            $hddagiao = $this->doQuery($chuagiaothang,$param);
            foreach($hddagiao as $hdcdg)
            {
                $thongkethangArr['hdthangchuagiao'] = $hdcdg->tonghd;
                $thongkethangArr['doanhthuthangchuagiao'] = $hdcdg->doanhthu;
                $thongkethangArr['shipthangchuagiao'] = $hdcdg->tongphiship;
                $thongkethangArr['luongthangchuagiao'] = $hdcdg->tongluonngnv;
            }      
        return $thongkethangArr;
    }
    public function getThangNew()
    {
        $query ='select Month(setDate) as thang, Year(setDate) as nam from bills order by setDate desc Limit 0,1';
        $rs = $this->doQuery($query);
        $param = array();
        $param['thang'] = $rs[0]->thang;
        $param['nam'] = $rs[0]->nam;  
        return $param;
    }
    public function getNamNew()
    {
        $query ='select Year(setDate) as nam from bills order by setDate desc Limit 0,1';
        $rs = $this->doQuery($query);
        $param = array();
        $param['nam'] = $rs[0]->nam;  
        return $param;
    }
    //Thống kê doanh thu theo năm
    public function getThongkeNam($nam)
    {
        $thongkenamArr=array();
        $query = 'select distinct Month(setDate) as thang, Year(setDate) as nam from bills where Year(setDate)=? order by setDate desc';
        $param = array();
        $param[] = $nam;
        $rs= $this->doQuery($query,$param);
        foreach($rs as $dt)
        {            
            $thongkenamArr[$dt->thang] = array();
            $sql ='select count(*) as tonghd, SUM(totalPrice) as doanhthu,SUM(phiship) as tongphiship,
            SUM(luongnv) as tongluonngnv from bills where Month(setDate)=? and Year(setDate)=? and tinhtrang=2';
            $param =array();
            $param[] = $dt->thang ;
            $param[] = $nam;
            $doanhthu = $this->doQuery($sql,$param);    
            foreach($doanhthu as $tt)
            {
                $thongkenamArr[$dt->thang]['tonghdthang'] = $tt->tonghd;
                $thongkenamArr[$dt->thang]['doanhthuthang'] = $tt->doanhthu;
                $thongkenamArr[$dt->thang]['phishipthang'] = $tt->tongphiship;
                $thongkenamArr[$dt->thang]['luongnvthang'] = $tt->tongluonngnv;
            }
            $tongcg = 'select count(*) as tonghd, SUM(totalPrice) as doanhthu,SUM(phiship) as tongphiship,
            SUM(luongnv) as tongluonngnv from bills where Month(setDate)=? and Year(setDate)=? and tinhtrang<>2';
            $param =array();
            $param[] = $dt->thang ;
            $param[] = $nam;
            $chuagiao = $this->doQuery($tongcg,$param);            
            foreach($chuagiao as $cg)
            {
                $thongkenamArr[$dt->thang]['hdchuagiao'] = $cg->tonghd;
                $thongkenamArr[$dt->thang]['dtchuagiao'] = $cg->doanhthu;
                $thongkenamArr[$dt->thang]['pschuagiao'] = $cg->tongphiship;
                $thongkenamArr[$dt->thang]['lchuagiao'] = $cg->tongluonngnv;
            } 
        }
            $dagiaonam = 'select count(*) as tonghd, SUM(totalPrice) as doanhthu,SUM(phiship) as tongphiship,
                SUM(luongnv) as tongluonngnv from bills where Year(setDate)=? and tinhtrang =2';
            $param = array();
            $param[] = $nam;
            $hddagiao = $this->doQuery($dagiaonam,$param);
            foreach($hddagiao as $hddg)
            {
                $thongkenamArr['hdnamgiao'] = $hddg->tonghd;
                $thongkenamArr['doanhthunamgiao'] = $hddg->doanhthu;
                $thongkenamArr['shipnamgiao'] = $hddg->tongphiship;
                $thongkenamArr['luongnamgiao'] = $hddg->tongluonngnv;
            }    
            $chuagiaonam = 'select count(*) as tonghd, SUM(totalPrice) as doanhthu,SUM(phiship) as tongphiship,
                SUM(luongnv) as tongluonngnv from bills where Year(setDate)=? and tinhtrang <>2';
            $param = array();
            $param[] = $nam;
            $hdnamchuagiao = $this->doQuery($chuagiaonam,$param);
            foreach($hdnamchuagiao as $hdcdg)
            {
                $thongkenamArr['hdnamchuagiao'] = $hdcdg->tonghd;
                $thongkenamArr['doanhthunamchuagiao'] = $hdcdg->doanhthu;
                $thongkenamArr['shipnamchuagiao'] = $hdcdg->tongphiship;
                $thongkenamArr['luongnamchuagiao'] = $hdcdg->tongluonngnv;
            }      
        return $thongkenamArr;
    }
    //đổi hình ảnh panel
    public function doihinhpanel($ngay,$id)
    {
        $query = 'update hinhanh set ngay=? where hinhID=?';
        $param = array();
		$param[]=$ngay;
        $param[] = $id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function addhinhanh($hinh,$ngay)
    {
        $query = 'INSERT INTO hinhanh(hinh1,ngay) VALUES (?,?)';
        $param = array();
        $param[] = $hinh;
        $param[] = $ngay;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function hinhdoi()
    {
        $query = 'select * from hinhanh order by hinhID';
        $param = array();
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function deleteHinh($id)
    {
        $query = 'delete from hinhanh where hinhID=? ';
        $param = array();
        $param[] = $id;
        $rs = $this->doQuery($query,$param);
        return $rs;
    }
    public function carosoulpanel()
    {
        $config = parse_ini_file('../Config/config.ini', true);
        $soluong = $config['soluonghinh']['sl'];
        $query ="select * from hinhanh order by ngay desc limit 0,$soluong ";
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function carosoulpane2()
    {
        $query ="select * from hinhanh order by hinhID desc limit 0,1 ";
        $rs = $this->doQuery($query);
        return $rs;
    }
    //Thay đổi tiêu đề quy định tăng phí ship vào các giờ trễ
    public function tieude()
    {
        $query ="select * from tieude  ";
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getIDtieude($id)
    {
        $query ="select * from tieude where tieudeid =?  ";
        $param =array();
        $param[] =$id;
        $rs = $this->doQuery($query,$param);
        return $rs;
    }
    public function editquydinh($tentd, $id)
    {
        $quey = 'update tieude set tentieude=? where tieudeid=?';
        $param =array();
        $param[]=$tentd;
        $param[] =$id;
        $rs = $this->doQuery($quey,$param);
        return $rs;
    }
}
















