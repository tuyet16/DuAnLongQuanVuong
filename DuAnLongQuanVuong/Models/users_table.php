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
    public function getHoadon($id)
    {
        $tongtien =0;
        $donhangarr = array();
        $query ='select distinct bi.* from bills bi,products pr, detailsbills dt 
                        where bi.billID = dt.billID and dt.productID = pr.productID and pr.userid=? order by bi.setDate desc';
        $param = array();
        $param[] = $id;
        $rs = $this->doQuery($query,$param);
        foreach($rs as $bill)
        {
            $donhangarr[$bill->setDate][$bill->billID][0]= array($bill->customerID,$bill->billingAddress
                                    ,$bill->delivery,$bill->totalPrice,$bill->tinhtrang);
            $tongtien += $bill->totalPrice;
            $sql = 'select * from customers cs, districts dt where cs.districtID = dt.districtID and customerID=?';
            $param =array();
            $param[]=$bill->customerID;
            $cs = $this->doQuery($sql,$param);
            $donhangarr[$bill->setDate][$bill->billID][1] = array($cs[0]->customerName
                                ,$cs[0]->address,$cs[0]->phone,$cs[0]->districtName);
            
            $sql1 = 'select dt.*,pr.productName, pr.unitID,un.unitName,pr.price as gia from detailsbills dt , products pr,units un             
                                where dt.productID=pr.productID and pr.unitID=un.unitID and dt.billID=?';
            $param = array();
            $param[]= $bill->billID;
            $dt = $this->doQuery($sql1,$param);
            foreach($dt as $detail)
            {
                $donhangarr[$bill->setDate][$bill->billID][2][]=array($detail->detailID,$detail->productID,$detail->amount
                                            ,$detail->price,$detail->productName,$detail->unitName,$detail->gia,$detail->discount);
                
            }                        
        }
        return $donhangarr;
    }
    public function editDetailPriceByID($soluong,$gia,$giamgia,$id)
    {
        $sql ='update detailsbills set amount=?,price=?,discount=? where detailID =?';
        $param = array();
        $param[]=$soluong;
        $param[]= $gia;
        $param[] = $giamgia;
        $param[] =$id;
        $this->doQuery($sql,$param);
    }
    public function editBillByID($price,$billID)
    {
        $sql ='update bills set totalPrice=? where billID=? ';
        $param = array();
        $param[]= $price;
        $param[] = $billID;
        $this->doQuery($sql,$param);
    }
}












