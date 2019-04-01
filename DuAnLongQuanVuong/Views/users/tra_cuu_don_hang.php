<?php ob_start(); 
if($rsUserBills != null){
?>
<div class="container-fluid" style="margin: 60px 0;">
    <h3 class="well well-sm" style="color: #f00; text-align:center;">THÔNG TIN KHÁCH HÀNG</h3>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-xs-3 col-sm-6" for="name" 
                            style="text-align: right;">Họ tên :</label>
                    <div class="col-xs-9 col-sm-6">
                        <?php echo $rsUserBills['info']['name']; ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-xs-3 col-sm-6" for="address" 
                            style="text-align: right;">Địa chỉ :
                    </label>
                    <div class="col-xs-9 col-sm-6">
                        <?php echo $rsUserBills['info']['diachi']; ?>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label col-xs-3 col-sm-6" for="phone" 
                            style="text-align: right;">Điện thoại :
                    </label>
                    <div class="col-xs-9 col-sm-6">
                        <?php echo $rsUserBills['info']['phone']; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-xs-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="undelivery">
                                <th>#</th>
                                <th>Ngày Đặt Hàng</th>
                                <th>Ngày Giao Hàng</th>
                                <th>Tổng Tiền</th>
                                <th>Phí Ship</th>
                                <th>Xem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                foreach($rsUserBills['bills'] as $billItem):
                                    $i++;
                                    if($billItem['SetDate'] == '0000-00-00 00:00:00'):
                            ?>
                                 <tr class="danger">
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $billItem['PurchaseDate'];?></td>
                                    <td><?php echo 'Chưa giao';?></td>
                                    <td><?php echo number_format($billItem['totalPrice']);?></td>
                                    <td><?php echo number_format($billItem['phiship']);?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#detailBill<?php echo $billItem['billID']?>">
                                            Chi tiết
                                        </button>
                                    </td>
                                 </tr>
                                 <?php
                                 else:
                                 ?>   
                                 <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $billItem['PurchaseDate'];?></td>
                                    <td><?php echo $billItem['SetDate'];?></td>
                                    <td><?php echo number_format($billItem['totalPrice']);?></td>
                                    <td><?php echo number_format($billItem['phiship']);?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#detailBill<?php echo $billItem['billID']?>">
                                            Chi tiết
                                        </button>
                                    </td>
                                    </td>
                                 </tr>
                            <?php endif;?>
                            
                            <?php
                            endforeach; ?>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>
</div>
<?php foreach($rsUserBills['bills'] as $billItem):?>
<div id="detailBill<?php echo $billItem['billID']; ?>" class="modal fade" aria-hidden="true" role="dialog">
                              <div class="modal-dialog modal-lg" role="document" >
                            
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color: #FE840E; color: #fff;">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">CHI TIẾT ĐƠN HÀNG</h4>
                                    <h4>Ngày
                                    <?php
                                            $d = date_create($billItem['PurchaseDate']); 
                                                    echo date_format($d, 'd/m/Y h:m:s');?>
                                    </h4>
                                  </div>
                                  <div class="modal-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Sản Phẩm</th>
                                                <th>Giá Tiền</th>
                                                <th>Số Lượng</th>
                                                <th>Giảm Giá</th>
                                                <th>Thành Tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $index = 0;
                                                $tong = 0; 
                                                if(isset($billItem['detail'])):
                                                    foreach($billItem['detail'] as $detaiItem): 
                                                        $index++;
                                            ?>
                                                        <tr>
                                                            <td><?php echo $index;?></td>
                                                            <td><?php echo $detaiItem['productName'];?></td>
                                                            <td><?php echo number_format($detaiItem['price']);?></td>
                                                            <td><?php echo $detaiItem['amount'];?></td>
                                                            <td><?php echo $detaiItem['discount'];?>%</td>
                                                            <td><?php echo number_format($detaiItem['thanhtien']);?></td>
                                                        </tr>
                                                        
                                            <?php
                                                        $tong += $detaiItem['thanhtien'];
                                                    endforeach;
                                            ?>
                                                    <tr>
                                                        <td colspan="5" class="text-right">Tổng Cộng :</td>
                                                        <td style="color: red; font-weight: bold;"><?php echo number_format($tong);?> </td>
                                                    </tr>
                                            <?php
                                                endif;
                                            ?>
                                        </tbody>
                                    </table>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                                  </div>
                                </div>
                            
                              </div>
                            </div>
<?php endforeach; 
}
else{
?>
    <div class="row" style="margin: 60px;">
        <div class="col-xs-12" style="height: 200px;">
            <h1 class="text-center">KHÔNG TÌM THẤY</h1>
        </div>
    </div>
<?php
}
?>
<?php return ob_get_clean(); ?>