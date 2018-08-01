<?php
	ob_start();
?>

    <table class="table table-bordered table-striped">
      <tr style="background-color:darkblue;color:#FFF">
        <td>&nbsp; STT</td>
        <td>&nbsp; Tên nhân viên</td>
        <td>&nbsp; Số điện thoại</td>
        <td>Tổng ship</td>
        <td>&nbsp; Chi Tiết</td>
      </tr>
      <div id="accordion">  
      <tr>
        <td colspan="7" style="color: red;"><h4><?php $dt=date_create($date); echo date_format($dt,'d-m-y');  ?></h4></td>
      </tr>  
      <?php $i=1;foreach($DSdonhang[$date] as $billID=>$db){ ?>    
      <tr>         
            <td>&nbsp;<?php echo $i++; ?></td>
            <td>&nbsp;<?php echo $db[0][7]; ?></td>
            <td>&nbsp;<?php echo $db[0][8]; ?></td> 
            <td>300.000</td>          
            <td>             
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseOne">
                    Xem
                </a>
            </td>        
        </tr>
        <tr>
            <td colspan="7">
             <div class="card">
                <div id="collapseOne" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    <div class="container-fluid">
                    
                    <form method="post" action="?action=tinhtrang">
                    <input type="hidden" name="billID" value="<?php echo $billID; ?>" />
                    <div class="row">
                        <legend>Danh Sách Đơn Hàng</legend>
                        <table class="table table-bordered table-striped text-center">
                            <tr style="background-color:green; color: white; ">
                                <td>STT</td>
                                <td>Khách hàng</td>
                                <td>Địa Chỉ</td>
                                <td>Thành Tiền</td>
                                <td>Phí ship</td>
                            </tr>
                            <?php $a=1; ?>
                            <tr>
                                <td><?php echo $a++; ?></td>
                                <td><?php echo $db[0][9]; ?></td>
                                <td><?php echo $db[0][10]; ?></td>
                                <td><?php echo number_format($db[0][3]); ?></td>
                                <td>30.000</td>
                            </tr>
                            
                        </table>
                        <div class="row" style="padding-bottom: 10px;">
                            <div class="col-md-1">Ghi chú: </div>
                            <div class="col-md-11">
                                <input type="text" name="ghichu" value="<?php echo $db[0][6];  ?>" class="form-control"/>
                            </div>
                        </div>
                        <input type="radio" value="2" name="rd" <?php if($db[0][4]==2)
                                                                {echo 'checked="checked"';}
                                                                else
                                                                {
                                                                    echo '';
                                                                } ?>/> Đã giao
                        <input type="radio" value="1" name="rd" <?php if($db[0][4]==1)
                                                                {echo 'checked="checked"';}
                                                                else
                                                                {
                                                                    echo '';
                                                                } ?>/> Chưa giao
                        <input type="radio" value="0" name="rd" <?php if($db[0][4]==0)
                                                                {echo 'checked="checked"';}
                                                                else
                                                                {
                                                                    echo '';
                                                                } ?>/> Hủy đơn hàng
                        <input type="submit" name="submit" class="btn btn-success" value="Cập Nhật" />
                    </div>
                    </div>    
                    </form>
                  
                  </div>
                </div>
              </div>
            </td>
        </tr>
        <?php } ?>
<?php
	return ob_get_clean();
?>  