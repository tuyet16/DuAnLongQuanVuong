<?php
ob_start();
?>
<div class="container-fluid" style="margin-top:  60px;">
    <div class="row">
        <h1 class="text-center">HÓA ĐƠN DỊCH VỤ GIAO HÀNG</h1>
        
    </div>
    <?php 
        foreach($rsShipInvoices as $invoices):
    ?>
        <div class="row" style="margin: 30px 0; border: thin solid lightgray;"> 
            <h3 class="text-center">Ngày <?php echo $invoices->start_date;?></h3>   
            <div class="col-xs-12" style="padding: 10px;">
               <h3> <span class="label label-primary">THÔNG TIN SHOP</span></h3>
               <p>Chủ shop : <?php echo $invoices->customer_shop;?></p>
               <p>Địa chỉ :<?php echo $invoices->shopaddress . ',' . $invoices->shopDistrict; ?></p>
               <p>Điện thoại : <?php echo $invoices->shopphone;?></p>
               <h3><span class="label label-danger"> THÔNG TIN NGƯỜI NHẬN</span></h3>
               <p>Tên người nhận : <?php echo $invoices->customer_client;?></p>
               <p>Địa chỉ người nhận : <?php echo $invoices->customer_address . ',' . $invoices->clientDistrictName;?></p>
               <p>Điện thoại người nhận: <?php echo $invoices->clientphone;?></p>
               <p>Yêu cầu riêng: <?php echo $invoices->customer_require;?></p>
               <form name="ship_invoices" action="?action=capnhathdnhanship" method="post">
               <p>Tiền hàng: 
                    <span style="color: #f00; font-weight: bold;">
                        <?php echo number_format($invoices->total);?>
                        <input type="text" name="tienhang" value="<?php echo $invoices->total;?>" />
                    </span>
               </p>
               <p>Phí ship: <span style="color: #00f; font-weight: bold;"><?php echo number_format($invoices->ship_fee);?></span></p>
               <p>Phụ thu: 
               
               <input type="hidden" name="ship_id" value="<?php echo $invoices->id;?>" />
               <input type="text" class="form-control" name="surcharge" 
                        value="<?php 
                                echo $invoices->surcharge;
                        ?>" /></p>
               <p>Diễn giải: <input type="text" class="form-control" name="surcharge_reason" 
                            value="<?php 
                                echo $invoices->surcharge_reason;
                            ?>" /></p>
               <p>Nhân viên giao 
                    <select name="employee" class="form-control">
                    <?php foreach($rsEmployee as $employee): 
                            if($invoices->shipper_id == $employee->idEm):
                    ?>
                        <option value="<?php echo $employee->idEm;?>" selected><?php echo $employee->employeeName;?></option>
                    <?php
                        else:
                    ?>
                        <option value="<?php echo $employee->idEm;?>" ><?php echo $employee->employeeName;?></option>
                    <?php 
                        endif;
                    endforeach; ?>
                    </select>
               </p>
               <p>
                    <button type="submit" class="btn btn-primary"  name="submit">Cập Nhật</button> 
                    <a href="?action=in_hd_nhan_ship&shipID=<?php echo $invoices->id;?>" class="btn btn-danger">In Hóa Đơn</a>
                    </form>
               </p>
            </div>
        </div>     
    <?php
        endforeach;
    ?>
    </div>
</div>
    
<?php 
    return ob_get_clean();
?>