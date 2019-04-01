<?php ob_start(); ?>

<div class="container-fluid" style="margin-top: 60px;">
    <?php 
    foreach($rsBillByDate as $date=>$billItemArr):?>
    <div class="row">
        <h3>ĐƠN HÀNG NGÀY <span class="product-information"><?php echo  $date;?></span></h3>
        <table class="table table-bordered">
            <thead>
                <tr class="undelivery">
                    <th>#</th>
                    <th>Mã Hóa Đơn</th>
                    <th>Ngày Đặt Hàng</th>
                    <th>Ngày Giao Hàng</th>
                    <th>Tổng Trị Giá</th>
                    <th>Chi Tiết</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
        <?php $index = 0;
            foreach($billItemArr as $billItem):?>
                <tr>
                    <td><?php echo $index++;?></td>
                    <td><?php echo $billItem['billID'];?></td>
                    <td><?php echo $billItem['PurchaseDate'];?></td>
                    <td><?php
                            if($billItem['setDate'] != '0000-00-00 00:00:00'){ 
                                echo $billItem['setDate'];
                            }
                            else{
                                echo 'Chưa giao';
                            }
                    ?></td>
                    <td><?php echo number_format($billItem['totalPrice']);?></td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myBill<?php echo $billItem['billID'];?>">Chi Tiết</button></td>
                    <td><a href="?action=xoahoadon&billID=<?php echo $billItem['billID'];?>" class="btn btn-primary">Xóa</a></td>
                </tr>
        <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php endforeach;?>
</div>
<?php 
    foreach($rsBillByDate as $date=>$billItemArr):
        foreach($billItemArr as $billItem):
?>
            <!-- The Modal -->
            <div class="modal fade" id="myBill<?php echo $billItem['billID'];?>">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
            
                  <!-- Modal Header -->
                  <div class="modal-header"  style="background-color: #FE840E;color: #fff;">
                    <h2 class="modal-title">Chi Tiết Hóa Đơn</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
            
                  <!-- Modal body -->
                  <div class="modal-body">
                  <form class="form-horizontal" id="invoices" name="invoices" action="?action=shopupdateinvoice">
                    <div  class="form-group">
                        <label class="control-label col-xs-3" for="customerName">Tên khách hàng :</label>
                        <div class="col-xs-9">
                            <p class="form-control-static">
                    <?php 
                        echo $billItem['customerName']; ?>
                            </p>
                        </div>
                    </div>
                    <div  class="form-group">
                        <label class="control-label col-xs-3" for="customerAddress">Địa chỉ :</label>
                        <div class="col-xs-9">
                            <p class="form-control-static">
                    <?php
                        echo $billItem['customerAddress'];
                    ?>
                            </p>
                        </div>
                    </div>
                    <div  class="form-group">
                        <label class="control-label col-xs-3" for="customerAddress">Địa chỉ :</label>
                        <div class="col-xs-9">
                            <p class="form-control-static">
                    <?php
                        echo $billItem['customerPhone'];
                    ?>
                            </p>
                        </div>
                    </div>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr class="undelivery">
                                <th>#</th>
                                <th>Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Giảm Giá</th>
                                <th>Thành Tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $index = 0;
                        $tong = 0;
                        $phiship = 0;
                        $detailShip = 0;
                        foreach($billItem['detailBill'] as $detailItem):
                            $tong += $detailItem['thanhtien'];
                        ?>
                            <tr>
                                <td><?php echo ++$index; ?></td>
                                <td><img src="../Views/img/<?php echo $detailItem['image'];?>" width="60px" />
                                    <?php echo $detailItem['productName']; ?></td>
                                <td><div id="price<?php echo $detailItem['detailID'];?>"><?php echo number_format($detailItem['price']); ?></div></td>
                                <td>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input  type="text" class="form-control"
                                                    name="<?php echo $detailItem['detailID'];?>" 
                                                    value="<?php echo $detailItem['amount']; ?>" required=""/>
                                            <label for="<?php echo $detailItem['detailID'];?>_error" class="form-error"></label>
                                        </div>
                                    </div>
                                    
                                </td>
                                <td>
                                    <select name="discount" id="discount">
                                    <?php for($i = 0 ;$i < 20; $i+=5){
                                            if($i == $detailItem['discount']){ ?>
                                        <option value="<?php echo $i; ?>" selected="selected"> <?php echo $i; ?>%</option> 
                                        
                                    <?php }else{
                                    ?>   
                                         <option value="<?php echo $i; ?>"> <?php echo $i; ?>%</option>
                                    <?php    
                                        }
                                    } ?>
                                    </select>
                                </td>
                                <td><div id="total<?php echo $detailItem['detailID'];?>">
                                        <?php echo number_format($detailItem['thanhtien']); ?>
                                    </div>
                                </td>
                                <td>Xóa</td>
                            </tr>
                        <?php
                            if($phiship == 0){
                                if($detailItem['nguoitraship']==0){
                                    $phiship = $detailItem['phishipshop'];
                                    $detailShip = $detailItem['detailID'];
                                
                                }
                                else{
                                    $phiship = $detailItem['phishipkh'];
                                    $detailShip = $detailItem['detailID'];
                                }
                            }
                        endforeach;
                        ?>
                            <tr>
                                <td colspan="5" class="text-right">Tổng Cộng</td>
                                <td colspan="2" style="font-weight: bold; color: #00f;">
                                    <div id="tongcong">
                                    <?php echo number_format($tong);?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div  class="form-group">
                        <label class="control-label col-xs-3" for="customerAddress">Phí ship :</label>
                        <div class="col-xs-9">
                            <p class="form-control-static" id="phiship<?php ?>">
                    <?php
                                echo $phiship;
                    ?>
                            </p>
                            <label class="radio-inline"><input type="radio" name="optPhiship" checked />Shop trả</label>
                            <label class="radio-inline"><input type="radio" name="optPhiship"/>Khách trả</label>
                        </div>
                    </div>
                    
                  
                  </div>
            
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="submit">Cập Nhật Đơn Hàng</button>
                    <button type="button" class="btn btn-primary">Chấp Nhận Đơn Hàng</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                    </button>
                  </div>
                </form>
                </div>
              </div>
            </div>
<?php
        endforeach;
    endforeach;
?>
<script src="../Views/js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        
        textArr = $('#invoices input[type=text]');
        textArr.each(function(index){
            name = '#total' + $(this).attr('name');
            price = '#price' + $(this).attr('name');
            $(this).on("change paste keyup", function(){
                
                reg = /^\d{1,2}$/;
                url = $('.btn btn-primary').attr('href');
                if(!reg.test($(this).val())){
                    $('label[for=' + $(this).attr('name') + '_error]').text("Chỉ nhận giá trị từ 1 đến 50");
                    $(name).text("0");
                    $('.btn btn-primary').attr('disabled', 'disabled');
                    $('.btn btn-primary').off('click');
                    $('.btn btn-primary').attr('href', '#');
                } 
                else{
                    $('label[for=' + $(this).attr('name') + '_error]').text("");
                    //alert($(price).text() + '---' + $(this).val());
                    
                    origin_price = $(price).text();
                    origin_price = origin_price.split(',').join('');
                    thanhtien = origin_price * $(this).val(); 
                    //origin_price = int.parse(.split(',').join(''));
                    //thanhtien = origin_price * $(this).val();
                    //alert(origin_price);
                    $(name).text(thanhtien);
                    changeQuantity = $.ajax({
                        url: "../Controllers/shop_controller.php?action=shopchangequantity",
                        method: 'POST',
                        data:{detailID: $(this).attr('name'), quantity: $(this).val()},
                        dataType: 'html'
                    });
                }
            });
        });
        selectArr = $('select');
        selectArr.each(function(){
            $(this).on('change', function(){
               alert($(this).val()); 
            }); 
        });
        
    });
</script>

<?php return ob_get_clean(); ?>