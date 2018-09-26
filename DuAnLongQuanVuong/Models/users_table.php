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
        $donhangarr = array();
        $query ='select distinct us.fullname,us.address,
                        bi.billID,
                        bi.setDate,
                        bi.billingAddress,
                        bi.phiship,
                        bi.nguoitraship,
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
                           ,$bill->sdtNV,$bill->customerName,$bill->sdtkh,$bill->phiship,$bill->totalPrice,$bill->nguoitraship);
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
                                                        $bill->address);
                
            }                        
        }
        return $donhangarr;
    }
    public function gethoadonAmin($ngay=null)
    {
        $tongtien =0;
        $donhangarr = array();
        if($ngay != null)
        {
            $query ='select distinct bi.* from bills bi,products pr, detailsbills dt
                where bi.billID = dt.billID and dt.productID = pr.productID 
                        and dt.shop_acceptance=1 and PurchaseDate=? order by bi.PurchaseDate desc';
            $param = array();
            $param[] = $ngay;
            $rs = $this->doQuery($query,$param);
        }
        else
        {
            $query ='select distinct bi.* from bills bi,products pr, detailsbills dt
                where bi.billID = dt.billID and dt.productID = pr.productID and bi.shopcheck=1 order by bi.PurchaseDate desc limit 0,1';
            $param = array();
            $rs = $this->doQuery($query);
        }
        foreach($rs as $bill)
        {
            $donhangarr[$bill->setDate][$bill->billID][0]= array($bill->customerID,$bill->billingAddress,$bill->delivery
                                    ,$bill->totalPrice,$bill->tinhtrang,$bill->shopcheck,$bill->idEm,$bill->nguoitraship);
            $donhangarr[$bill->PurchaseDate][$bill->billID][0]= array($bill->customerID,$bill->billingAddress,$bill->delivery
                                    ,$bill->totalPrice,$bill->tinhtrang,$bill->shopcheck, $bill->idEm,$bill->nguoitraship);
            $tongtien += $bill->totalPrice;
            $sql = 'select * from customers cs, districts dt where cs.districtID = dt.districtID and customerID=?';
            $param =array();
            $param[]=$bill->customerID;
            $cs = $this->doQuery($sql,$param);
            $donhangarr[$bill->PurchaseDate][$bill->billID][1] = array($cs[0]->customerName
                                ,$cs[0]->address,$cs[0]->phone,$cs[0]->districtName);            
            $sql1 = 'select dt.*,pr.productName, pr.unitID,un.unitName,pr.price as gia from detailsbills dt , products pr,units un             
                                where dt.productID=pr.productID and pr.unitID=un.unitID and dt.billID=?';
            $param = array();
            $param[]= $bill->billID;
            $dt = $this->doQuery($sql1,$param);
            foreach($dt as $detail)
            {
                $donhangarr[$bill->PurchaseDate][$bill->billID][2][]=array($detail->detailID,$detail->productID,$detail->amount
                                            ,$detail->price,$detail->productName,$detail->unitName,$detail->gia,$detail->discount);
            } 
            $sqlnhanvien = 'select * from employees ';
            $nv = $this->doQuery($sqlnhanvien);
            foreach($nv as $employee)
            {
                $donhangarr[$bill->PurchaseDate][$bill->billID][3][]=array($employee->idEm,$employee->employeeID,$employee->employeeName);
            }                                   
        }
        return $donhangarr;
    } 
    public function editnhanvien($date, $idEm,$id)
    {
        $query = 'update bills set setDate=?, idEm=? where billID=?';
        $param = array();
        $param[] = $date;
        $param[] = $idEm;
        $param[] = $id;
        $rs = $this->doQuery($query,$param);
        return $rs;
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
    public function getTinhtrang($date='')
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
    public function getthongkengay()
    {
        $thongkeArr = array();
        $query ='select distinct * from bills order by setDate desc';
        $rs = $this->doQuery($query);        
        foreach($rs as $bill)
        {   
            $tongship =0;
            $tongluong =0;
            $tongdoanhthu=0;
            $thongkeArr[$bill->setDate]=array();            
            $sql = 'select distinct bi.*,cs.customerName,ep.employeeName from bills bi, customers cs,
                        employees ep where bi.customerID = cs.customerID and bi.idEm = ep.idEm and bi.setDate=?';
            $param = array();
            $param[] = $bill->setDate;
            $thongtin = $this->doQuery($sql,$param);
            foreach($thongtin as $tt)
            {
                $thongkeArr[$bill->setDate][$tt->billID][]= array($tt->billID,$tt->customerName,$tt->totalPrice,$tt->employeeName,
                                        $tt->tinhtrang,$tt->phiship,$tt->luongnv);
                if($tt->tinhtrang == 2)
                {
                 $tongship += $tt->phiship;
                 $tongluong += $tt->luongnv;
                 $tongdoanhthu += $tt->totalPrice;
                }
            }
            //tong tien ship va tien luong  
                      
            $thongkeArr[$bill->setDate]['tongship']=$tongship;
            $thongkeArr[$bill->setDate]['tongluong']= $tongluong;
            $thongkeArr[$bill->setDate]['tongdoanhthu'] = $tongdoanhthu;
            //tinh so hoa don da giao va chua giao
            $tongchuagiao = 0;
            $tongdagiao =0;
            
            $tongcg = 'select count(tinhtrang) as chuagiao from bills where tinhtrang <> 2 and setDate=?';
            $param =array();
            $param[] = $bill->setDate ;
            $hd = $this->doQuery($tongcg,$param);
            $tongchuagiao = $hd[0]->chuagiao;
            $thongkeArr[$bill->setDate]['chuagiao'] = $tongchuagiao;
            
            $tongdg = 'select count(tinhtrang) as dagiao from bills where tinhtrang = 2 and setDate=?';
            $param =array();
            $param[] = $bill->setDate ;
            $dg = $this->doQuery($tongdg,$param);
            $tongdagiao = $dg[0]->dagiao;
            $thongkeArr[$bill->setDate]['dagiao'] = $tongdagiao;     
        }
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
    
}
















