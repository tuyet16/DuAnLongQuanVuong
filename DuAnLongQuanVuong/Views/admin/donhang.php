<?php
	ob_start();
    
?>
    <form method="post" action="?action=donhang">
        <div class="col-md-12">
            Chọn ngày xem:                 
            <input type="text" name="chonngay" id="datepicker"/>
            <input type="submit" name="submit" value="Xem" />
        </div>
    </form>
    <?php 
    if($DSdonhang == null)
    {
        echo '<div class="text-center" style="font-size:140%;padding-top:10%;">Chưa có đơn hàng nào</div>';
    }
    else
    {
    ?>
    <table class="table table-bordered table-striped">
      <tr style="background-color:darkblue;color:#FFF">
        <td>&nbsp; STT</td>
        <td>&nbsp; Tên Khách hàng</td>
        <td>&nbsp; Loại ship </td>
        <td>&nbsp; Đơn giá </td>
        <td>&nbsp; Thời gian đặt hàng</td>
        <td>&nbsp; Chi Tiết</td>
      </tr>
      <div id="accordion">
      <?php $tong =0;
            $thongke = array(); ?>
      <tr>
      <form method="post" action="?action=inhoadon">
        <td colspan="7" style="color: red;"><h4><?php $dt=date_create($date); echo $ngay = date_format($dt,'d-m-y');  ?>
        <input type="hidden" name="ngay" value="<?php echo $date; ?>" />     
      </form>
      </tr>
            <?php $i=1; foreach($DSdonhang[$date] as $billID=>$db){ ?>
          <tr>
            <td>&nbsp;<?php echo $i++; ?></td>
            <td>&nbsp;<?php  echo $db[1][0];?></td>
            <td>&nbsp;<?php if($db[0][2]==0) 
                                {
                                    echo 'Giao Thường';
                                }
                                else
                                {echo 'Giao Nhanh';}?></td>
            <td>&nbsp;<?php echo number_format($db[0][3]); $tong += $db[0][3];?></td>
            <td>&nbsp;<?php echo date_format($dt,'d-m-Y'); ?></td>
            <td>             
                <a class="collapsed card-link" data-toggle="collapse" href="#collapse<?php echo $billID; ?>">
                    Xem
                </a>
            </td>            
        </tr>
        
        <tr>
            <td colspan="7">
             <div class="card">
                <div id="collapse<?php echo $billID; ?>" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    <div class="container-fluid">
                    <div class="row">
                       
                       <label>Số điện thoại: <?php echo $db[1][2]; ?></label>
                     </div>
                     <div class="row"> 
                      <label>Địa chỉ:  <?php echo $db[1][1].', '. $db[1][3]; ?></label>
                    </div>
                    <?php if(isset($_POST['nhanvien'])){
                        $select = $_POST['nhanvien'];
                    } ?>
                    <div class="row">
                         <form method="post" action="?action=editnhanvien">
                        <table class="table table-bordered table-striped text-center">
                         <input type="hidden" name="billID" value="<?php echo $billID; ?>"/>
                            <tr style="background-color:green; color: white; ">
                                <td>STT</td>
                                <td>Tên sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Đơn vị</td>
                                <td>Giá</td>
                                <td>Giảm giá</td>
                                <td>Thành tiền</td>
                            </tr>
                            <?php $a=1; foreach($db[2] as $detail_item){ 
                                if($detail_item != null){?>
                            <tr>
                                <td><?php echo $a++; ?></td>
                                <td><?php echo $detail_item[4]; 
                                    if(isset($thongke[$detail_item[4]]))
                                    {
                                        $thongke[$detail_item[4]] += $detail_item[2]; 
                                        //$thongke[$detail_item[4]].=' '.$detail_item[5];
                                    }
                                    else
                                    {
                                        $thongke[$detail_item[4]] = $detail_item[2];
                                        //$thongke[$detail_item[4]].=' '.$detail_item[5];
                                    }
                                    ?></td>
                                <td><?php echo $detail_item[2];  ?></td>
                                <td><?php echo $detail_item[5]; ?></td>
                                <td><?php echo number_format($detail_item[6]); ?></td>
                                <td>
                                    <?php echo $detail_item[7]; ?>%
                                                                           
                                    <?php  } ?>
                                   
                                </td>
                                <input type="hidden" name="gia<?php echo $detail_item[0]; ?>" value="<?php echo $detail_item[6]; ?>" />
                                <td><?php echo number_format($detail_item[3]); ?></td>
                            </tr>
                           <?php }?> 
                        </table>
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <div class="row">
                                Chọn nhân viên:                             
                                    <select name="nhanvien">    
                                    <?php  foreach($db[3] as $employee){ 
                                            if($select!= $employee[0]){?>
                                        <option value="<?php echo $employee[0]; ?>"><?php echo $employee[2]; ?></option>
                                    <?php } else
                                        {?>
                                            <option value="<?php echo $employee[0]; ?>" selected><?php echo $employee[2]; ?></option>
                                    <?php
                                    }} ?>
                                    </select>                            
                                </div>
                            </div>
                            <div class="col-md-3 text-right">
                                <button type="submit" name="submit" class="btn btn-success">Cập nhật</button>
                                <a href="?action=inhoadon&billID=<?php echo $billID; ?>" class="btn btn-danger">In Hóa Đơn</a>
                            </div>
                        </div>
                    </div>
                    </form>
                    </div>    
                  </div>
                </div>
              </div>
            </td>
        </tr>
      <?php } ?>  
   </div>
        

</table>

<?php
}
	return ob_get_clean();
?>