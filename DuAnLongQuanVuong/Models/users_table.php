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
                                                                    $bill->PurchaseDate,$bill->nguoitraship);
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
                                                                    $detail->shop_acceptance);
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
    public function editDetailPriceByID($soluong,$gia,$giamgia,$nguoitra,$detailID,$billID)
    {
        $sql ='update detailsbills set amount=?,price=?,discount=? where detailID =?';
        $param = array();
        $param[]=$soluong;
        $param[]= $gia;
        $param[] = $giamgia;        
        $param[] =$detailID;
        $this->doQuery($sql,$param);
        
        $sql1 ="update bills set nguoitraship=? where billID=?";
        $param = array();
        $param[] = $nguoitra;
        $param[] =$billID;
        $this->doQuery($sql1,$param);
    }
    public function editBillByID($price,$billID)
    {
        $sql ='update bills set totalPrice=? where billID=? ';
        $param = array();
        $param[]= $price;
        $param[] = $billID;
        $this->doQuery($sql,$param);
    }
    public function guidonhang($id)
    {
        $detail_id_arr = explode('_', $id);
        $questions = str_repeat('?,', count($detail_id_arr)-1) . '?';
        
        $query = "update detailsbills set shop_acceptance=1 where detailID IN ($questions)";
        $param = array();
        foreach($detail_id_arr as $detail_id){
            $param[] = $detail_id;
        }
        $rs = $this->doQuery1($query,$param);
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
                                                        $detail->phishipshop);
                $tongphuthu += $detail->phuthu;
                $shipshop += $detail->phishipshop;
            }
                $donhangarr[$bill->billID]['tongphuthu'] =$tongphuthu;   
                $donhangarr[$bill->billID]['shipshop'] =$shipshop;        
        }
              
        return $donhangarr;
    }
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
                                            $detail->phuthu,$detail->phishipshop,$detail->phishipkh);
                }                            
               
                $sqlnhanvien = 'select * from employees ';
                $nv = $this->doQuery($sqlnhanvien);
                foreach($nv as $employee)
                {
                    $donhangarr[$bill->billID][$user->userid]['nhanvien'][]=array($employee->idEm,$employee->employeeID,$employee->employeeName);
                }                                   
            } $donhangarr[$bill->billID]['soshop']= $soshop; 
        }
        return $donhangarr;
    } 
   
    public function editnhanvien($date, $idEm,$phuthu,$phishipshop, $phishipkh,$id)
    {
        $query = 'update bills set setDate=?, idEm=? where billID=?';
        $param = array();
        $param[] = $date;
        $param[] = $idEm;
        $param[] = $id;
        $this->doQuery($query,$param);
       //print_r($param);
       foreach($phuthu as $dtID=>$pt){
        $sql = 'update detailsbills set phuthu=?, phishipshop=?, phishipkh=? where detailID=?';
        $param = array();
        $param[] = $pt;
        $param[] = $dtID;
        $param[] = $phishipshop;
        $param[] = $phishipkh;
        $this->doQuery($sql,$param);
        }
        //print_r($param);
    } 
   
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
        $tongship =0;
        $tongluong =0;
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
            $tongdoanhthushop=0; 
            $tongshipshop =0;
            $tongphuthushop =0;
            $i=1;
            foreach($thongtin as $tt)
            {                
                $thongkeArr[$user->userid]['thongtinshop'][$i][0]= array($tt->billID,$tt->customerName,$tt->totalPrice,$tt->employeeName,
                                        $tt->tinhtrang,$tt->phiship,$tt->luongnv,'tongphuthu'=>0,'tongtientungbill'=>0);     
                 $sql1 = 'select dt.* from detailsbills dt, products pr, users us
                                 where dt.productID= pr.productID and us.userid = pr.userid and dt.billID=? and us.userid=?';
                 $param = array();
                 $param[] = $tt->billID;
                 $param[] = $user->userid;
                 $dt = $this->doQuery($sql1,$param);
                 $tongphuthu=0;                      
                 $tongtientungbill=0;                        
                 foreach($dt as $detail)
                 {
                    $thongkeArr[$user->userid]['thongtinshop'][$i][1][]=array($detail->detailID,$detail->phuthu,
                                    $detail->price,$detail->amount,$detail->thanhtien);
                    $tongphuthu += $detail->phuthu;
                   if($tt->tinhtrang == 2)
                    { 
                    $tongtientungbill += $detail->price* $detail->amount;
                    $tongdoanhthushop += $detail->thanhtien;  
                    $tongphuthushop+= $detail->phuthu;
                    }
                                
                 }   
                 $thongkeArr[$user->userid]['thongtinshop'][$i][0]['tongphuthu']=$tongphuthu;
                  $thongkeArr[$user->userid]['thongtinshop'][$i][0]['tongtientungbill']=$tongtientungbill;
                  //$thongkeArr[$user->userid]['thongtinshop'][$i][0]['tongdoanhthushop']=$tongdoanhthushop;
                  
                  $i++;
                if($tt->tinhtrang == 2)
                {
                 $tongshipshop += $tt->phiship;
                 $tongluong += $tt->luongnv;
                // $tongdoanhthu += $tongdoanhthushop;                               
                
                }         
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
            }
            //số hóa đơn đã giao của từng shop
            
                $thongkeArr[$user->userid]['tongdtshop']=$tongdoanhthushop;
                 $thongkeArr[$user->userid]['tongshipshop']=$tongshipshop;
                 $thongkeArr[$user->userid]['tongphuthushop']=$tongphuthushop;
                $tongdoanhthu += $tongdoanhthushop;
                $tongship += $tongshipshop;
                $tongphuthuall += $tongphuthushop;
                //$thongkeArr[$user->userid]['tongdoanhthushop']=$tongdoanhthushop;  
        }
         $thongkeArr['tongdoanhthu'] = $tongdoanhthu;
          $thongkeArr['tongship']=$tongship;
          $thongkeArr['tongluong']= $tongluong;
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
    public function doihinhpanel($hinh,$vitri,$id)
    {
        $query = 'update hinhanh set hinh1=?, vitri=? where hinhID=?';
        $param = array();
        $param[] = $hinh;
        $param[] = $vitri;
        $param[] = $id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function addhinhanh($hinh,$ngay)
    {
        $query = 'insert into hinhanh(hinh1,ngay) values(?,?)';
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
    public function doiquangcao($id)
    {
        $query = 'select * from hinhanh where hinhID=?';
        $param = array();
        $param[] =$id;
        $rs = $this->doQuery($query,$param);
        return $rs;
    }
    public function carosoulpanel()
    {
        $query ="select * from hinhanh order by hinhID desc limit 0,3 ";
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function carosoulpane2()
    {
        $query ="select * from hinhanh order by hinhID desc limit 0,1 ";
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function editphiship()
    {
        
    }
    
}
















