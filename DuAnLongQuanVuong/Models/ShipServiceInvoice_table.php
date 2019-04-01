<?php
class ShipServiceInvoice extends Database{
    public function __construct(){
        parent::__construct();
    }
    
    public function AddShipServiceInVoice($tenshop, $diachishop, $dienthoaishop, $shopdistrict, 
                                        $tennguoinhan, $district, $diachinguoinhan, 
                                        $dienthoainguoinhan, $tienhang, $tienship, $start_date, $customer_require){
        $param = [];
        $sql = "INSERT INTO customers(customerName, address, phone, districtID) VALUES(?, ?, ?, ?)";
        $param[] = $tenshop;
        $param[] = $diachishop;
        $param[] = $dienthoaishop;
        $param[] = $shopdistrict;
        $this->doQuery($sql, $param);
        $con = $this->getconnect();
        $shop_id = $con->lastInsertId('customerID');
        
        $param = [];
        $sql = "INSERT INTO customers(customerName, address, phone, districtID) VALUES(?, ?, ?, ?)";
        $param[] = $tennguoinhan;
        $param[] = $diachinguoinhan;
        $param[] = $dienthoainguoinhan;
        $param[] = $district;
        $this->doQuery($sql, $param);
        $con = $this->getconnect();
        $customer_id = $con->lastInsertId('customerID');
        
        
        $sql = "INSERT INTO ship_services_invoices(customer_shop, customer_client, customer_require, total, ship_fee, start_date) 
                VALUES(?, ?, ?, ?, ?, ?)";
        $param = [];
        $param[] = $shop_id;
        $param[] = $customer_id;
        $param[] = $customer_require;
        $param[] = $tienhang;
        $param[] = $tienship;
        $param[] = $start_date;
        $this->doQuery($sql, $param);
    }
    
    public function listShipInvoices($shipId=null)
    {
        if($shipId == null){
            $sql = "SELECT k.*, c1.customerName AS customer_client, c1.address AS customer_address, 
                            c1.phone as clientphone, d1.districtName AS clientDistrictName
                FROM
                (SELECT t.id, c.customerName AS customer_shop, c.address AS shopaddress, c.phone AS shopphone,  t.total, 
                        t.ship_fee, t.surcharge, t.surcharge_reason, t.shipper_id, t.start_date, t.delivery_date, 
                        t.customer_client, t.customer_require, d.districtName AS shopDistrict
                FROM 
                (SELECT *																											 
                FROM ship_services_invoices) AS t, customers c, districts d
                WHERE t.customer_shop = c.customerID AND c.districtID = d.districtID) AS k, customers c1, districts d1
                WHERE k.customer_client = c1.customerID AND c1.districtID = d1.districtID 
                ORDER BY k.id DESC";
            $rs = $this->doQuery($sql);
        }
        else{
            $sql = "SELECT k.*, c1.customerName AS customer_client, c1.address AS customer_address, c1.phone as clientphone,
                            e.employeeName , e.phone AS employeePhone, d1.districtName AS clientDistrictName
                FROM
                (SELECT t.id, c.customerName AS customer_shop, c.address AS shopaddress, c.phone AS shopphone,  
                        t.total, t.ship_fee, t.surcharge, t.surcharge_reason, t.shipper_id, t.start_date, 
                        t.delivery_date, t.customer_client, t.customer_require, d.districtName AS shopDistrict
                FROM 
                (SELECT *																											 
                FROM ship_services_invoices) AS t, customers c, districts d
                WHERE t.customer_shop = c.customerID AND c.districtID = d.districtID) AS k, 
                            customers c1, employees e, districts d1
                WHERE k.customer_client = c1.customerID AND k.id = ? 
                        AND k.shipper_id = e.idEm AND c1.districtID = d1.districtID
                ORDER BY k.id DESC";
            $param = [];
            $param[] = $shipId;
            $rs = $this->doQuery($sql, $param);
        }
        return $rs;
    }
    public function updateShipInvoices($tienhang, $surcharge, $surcharge_reason, $employee, $delivery_date, $id)
    {
        $sql = "UPDATE ship_services_invoices 
                    SET total=?, surcharge=?, surcharge_reason=?, shipper_id = ?, delivery_date=? WHERE id=?";
        $param = [];
        $param[] = $tienhang;
        $param[] = $surcharge;
        $param[] = $surcharge_reason;
        $param[] = $employee;
        $param[] = $delivery_date;
        $param[] = $id;
        $this->doQuery($sql, $param);
    } 
}

?>