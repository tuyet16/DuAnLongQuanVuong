<?php
	ob_start();
?>

    <table class="table table-bordered table-striped">
      <tr style="background-color:darkblue;color:#FFF">
        <td>&nbsp; STT</td>
        <td>&nbsp; Tên Khách hàng</td>
        <td>&nbsp; Loại ship </td>
        <td>&nbsp; Tinh trạng</td>
        <td>&nbsp; Đơn giá </td>
        <td>&nbsp; Thời gian đặt hàng</td>
        <td>&nbsp; Chi Tiết</td>
      </tr>
      <div id="accordion">
      <?php //foreach($DSdonhang as $date=>$billIDs) {
            $tong =0;
            $thongke = array();
        ?>    
      <tr>
        <td colspan="7" style="color: red;">
        
        <h4><?php $dt=date_create($date); 
                    echo date_format($dt,'d-m-Y'); ?></h4></td>
      </tr>
        <?php foreach($DSdonhang as $billID=>$db) { 
            ?>
          <tr>
            <td>&nbsp;1</td>
            <td>&nbsp;<?php echo $db[1][0]; ?></td>
            <td>&nbsp;<?php echo $db[0][2]; ?></td>
            <td>&nbsp;Chưa ship</td>
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
                       <label>Số điện thoại : <?php echo $db[1][2]; ?></label>
                    </div>  
                    <div class="row">
                        <label>Địa Chỉ : <?php echo $db[1][1].', '. $db[1][3]; ?></label>
                    </div>
                    
                    <div class="row">
                    <form method="post" action="?action=shopedit&ngay=<?php echo $date; ?>"> 
                    <input type="hidden" name="billID" value="<?php echo $billID; ?>"/>
                        <table class="table table-bordered table-striped text-center">
                            <tr style="background-color:green; color: white; ">
                                <td>STT</td>
                                <td>Tên sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Đơn vị</td>
                                <td>Giá</td>
                                <td>Giảm giá</td>
                                <td>Thành tiền</td>
                            </tr>
                            <?php foreach($db[2] as $detail_item){ 
                                if($detail_item != null){?>
                            <tr>
                                <td>1</td>
                                <td><?php echo $detail_item[4]; 
                                    if(isset($thongke[$detail_item[4]]))
                                    {
                                        $thongke[$detail_item[4]] += $detail_item[2]; 
                                        $thongke[$detail_item[4]].=' '.$detail_item[5];
                                    }
                                    else
                                    {
                                        $thongke[$detail_item[4]] = $detail_item[2];
                                        $thongke[$detail_item[4]].=' '.$detail_item[5];
                                    }
                                    ?></td>
                                <td><input type="text" name="<?php echo $detail_item[0]; ?>" value="<?php echo $detail_item[2];  ?>" /></td>
                                <td><?php echo $detail_item[5]; ?></td>
                                <td><?php echo number_format($detail_item[6]); ?></td>
                                <td>
                                    <select name="giamgia<?php echo $detail_item[0]; ?>">
                                    <?php for($i =0; $i<=20;$i+=5){ 
                                            if($i == $detail_item[7])
                                            {
                                            ?>
                                            <option value="<?php echo $i ?>" selected="selected"><?php echo $i; ?>%</option>
                                              <?php
                                            }else
                                            {
                                               echo '<option value="'.$i.'">'. $i.'%</option>'; 
                                            }
                                        ?>                                        
                                    <?php } } ?>
                                    </select>
                                </td>
                                <input type="hidden" name="gia<?php echo $detail_item[0]; ?>" value="<?php echo $detail_item[6]; ?>" />
                                <td><?php echo number_format($detail_item[3]); ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                        <div class="text-right">
                            <button type="submit" name="submit" class="btn btn-success">Cập nhật</button>
                            <a href="" class="btn btn-success">Gửi đơn hàng</a>
                        </div>
                         </form>
                    </div>
                    
                    </div>    
                  </div>
                </div>
              </div>
            </td>
        </tr>
        <?php } ?> 
        <?php // } ?>
       <tr style="margin-top: 20px;">
            <td colspan="4" style="color: red; text-align: center;font-weight: bolder;font-size: 130%;">Tổng tiền</td>
            <td style="color: blue;background-color: #FDE1FD;"><b><?php echo number_format($tong); ?></b></td>
            <td colspan="2"></td>
        </tr>
        
        <!-- bảng thống kê số lượng -->
        
        <tr>
            <td colspan="7" style="color: red; font-weight: bolder; font-size: 120%;text-align: center;">THỐNG KÊ SỐ LƯỢNG</td></tr>
        <tr style="background-color: green ; color: white;">
            <td>STT</td>
            <td colspan="3">Tên sản phẩm</td>
            <td colspan="2">Tổng số lượng</td>
        </tr>
        <?php foreach($thongke as $tk=>$sl){ ?>
        <tr>
            <td>1</td>
            <td colspan="3"><?php echo $tk; ?></td>
            <td colspan="2"><?php echo $sl; ?></td>
        </tr>
        <?php } ?>
               
   </div>
        

</table>
<ul class="pagination">    
    <?php $i=0;
         foreach($DSdonhang1 as $date1=>$dt){
            if($date1==$date)
            {   ?>
        <li class="page-item active"><a class="page-link" href="?action=donhang&ngay=<?php echo $date1; ?>"><?php echo ++$i; ?></a></li>
    <?php        
    }
    else
    {?>
        <li class="page-item"><a class="page-link" href="?action=donhang&ngay=<?php echo $date1; ?>"><?php echo ++$i; ?></a></li>
    <?php 
    }
    } ?>
</ul>

  
  
<?php
	return ob_get_clean();
?>