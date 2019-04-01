<?php 
class Bills extends Database{
        public function getBillsByCustomerID($customerPhone)
        {
            $sql = "SELECT distinct c.customerID, c.customerName, CONCAT(c.address,',',d.districtName) as diachi, c.phone 
                    FROM customers c, districts d
                    WHERE c.districtID = d.districtID AND c.phone = ? ORDER BY c.customerID DESC";
            $param = [];
            $param[] = $customerPhone;
            $rs = $this->doQuery($sql, $param);
            $customer = [];
            if($rs != null){
            $customer['info']=['name'=>$rs[0]->customerName, 'diachi'=>$rs[0]->diachi, 'phone'=>$rs[0]->phone];
            
            foreach($rs as $customerItem):
                $sqlBill = "SELECT billID, PurchaseDate, setDate, totalPrice, phiship 
                            FROM bills
                            WHERE customerID = ?
                            ";
                $param = [];
                $param[] = $customerItem->customerID;
                $rsBill = $this->doQuery($sqlBill, $param);
                
                foreach($rsBill as $bill):
                    $customer['bills'][$bill->billID] = ['billID'=>$bill->billID, 'PurchaseDate'=>$bill->PurchaseDate,
                                            'SetDate'=>$bill->setDate, 'totalPrice'=>$bill->totalPrice, 
                                            'phiship'=>$bill->phiship];
                    $sqlDetail = "SELECT d.detailID, d.price, d.amount, d.thanhtien, d.discount, d.phuthu, p.productName  
                                   FROM detailsbills d, products p
                                   WHERE d.productID = p.productID AND billID = ?
                                   ORDER BY detailID";
                    $param = [];
                    $param[] = $bill->billID;
                    $rsDetail = $this->doQuery($sqlDetail, $param);
                    foreach($rsDetail as $detailItem):
                        $customer['bills'][$bill->billID]['detail'][] = ['detailID'=>$detailItem->detailID, 
                                                        'productName'=>$detailItem->productName,
                                                        'price'=>$detailItem->price,
                                                        'amount'=>$detailItem->amount,
                                                        'thanhtien'=>$detailItem->thanhtien,
                                                        'discount'=>$detailItem->discount,
                                                        'phuthu'=>$detailItem->phuthu
                                                        ];
                    endforeach;
                    
                endforeach;
            endforeach;
            }
            return $customer;
        }
        //Lấy hóa đơn theo shop
    public  function getInvoicebyShopId($shopId)
    {
        $billByShopArr = [];
        $sql = "select distinct Date(bi.PurchaseDate) AS PurchaseDate from bills bi,products pr, detailsbills dt 
                        where bi.billID = dt.billID and dt.productID = pr.productID 
                                and pr.userid=? 
                        order by bi.PurchaseDate desc 
                ";
        $param = [];
        $param[] = $shopId;
        $rs = $this->doQuery($sql, $param);
        foreach($rs as $billItem):
            $sql = "select distinct bi.* 
                    from bills bi, products pr, detailsbills dt, customers c 
                    where bi.billID = dt.billID and dt.productID = pr.productID   
                                and pr.userid=? AND Date(bi.PurchaseDate) = ?
                        order by bi.PurchaseDate desc
                    ";
            $param = [];
            $param[] = $shopId;
            $param[] = $billItem->PurchaseDate;
            $rsBill = $this->doQuery($sql, $param);
            foreach($rsBill as $bill):
                $billByShopArr[$billItem->PurchaseDate][$bill->billID] = ['billID'=>$bill->billID,
                                                            'PurchaseDate'=>$bill->PurchaseDate,
                                                            'setDate'=>$bill->setDate,
                                                            'totalPrice'=>$bill->totalPrice,
                                                            'detailBill'=>[]
                                                            ];
                $sql = "
                    SELECT c.*, d.districtName
                    FROM bills b, customers c, districts d
                    WHERE b.customerID = c.customerID AND c.districtID = d.districtID
                        AND b.billID = ?
                    LIMIT 0,1
                    ";
                $param = [];
                $param[] = $bill->billID;
                $rsCustomer = $this->doQuery($sql, $param);
                foreach($rsCustomer as $item):
                    $billByShopArr[$billItem->PurchaseDate][$bill->billID]['customerName'] = $item->customerName;
                    $billByShopArr[$billItem->PurchaseDate][$bill->billID]['customerAddress'] = $item->address . ',' . $item->districtName;
                    $billByShopArr[$billItem->PurchaseDate][$bill->billID]['customerPhone'] = $item->phone;
                endforeach;
                
                $sql = "
                        SELECT db.*, p.productName, p.promotionPrice, p.image, u.unitName
                        FROM detailsbills db, products p, units u
                        WHERE db.productID = p.productID 
                                AND p.unitID = u.unitID 
                                AND db.billID = ? AND p.userid = ?
                    ";
                $param = [];
                $param[] = $bill->billID;
                $param[] = $shopId;
                $rsDetails = $this->doQuery($sql, $param);
                foreach($rsDetails as $detail):
                    $billByShopArr[$billItem->PurchaseDate][$bill->billID]['detailBill'][] = ['productName'=>$detail->productName,
                                                                                            'promotionPrice'=>$detail->promotionPrice,
                                                                                            'image'=>$detail->image,
                                                                                            'unitName'=>$detail->unitName,
                                                                                            'detailID'=>$detail->detailID,
                                                                                            'price'=>$detail->price,
                                                                                            'amount'=>$detail->amount,
                                                                                            'discount'=>$detail->discount,
                                                                                            'thanhtien'=>$detail->thanhtien,
                                                                                            'phishipshop'=>$detail->phishipshop,
                                                                                            'phishipkh'=>$detail->phishipkh,
                                                                                            'nguoitraship'=>$detail->nguoitraship,
                                                                                            'shop_acceptance'=>$detail->shop_acceptance
                                                                                            ];
                endforeach;
            endforeach;
        endforeach;
        return $billByShopArr;
    }
    public function changeDetailProductQuantiy($detailID, $quantiy){
        $sql = "UPDATE detailsBills SET amount = ?, thanhtien=amount*price WHERE detailID=?";
        $param = [];
        $param[] = $quantiy;
        $param[] = $detailID;
        $this->doQuery($sql, $param);
    }
    public function getDetailById($detailID)
    {
        $sql = "SELECT * FROM detailsbills WHERE detailID=?";
        $param = [];
        $param[] = $detailID;
        $rs = $this->doQuery($sql, $param);
        return $rs;
    }
}
?> 