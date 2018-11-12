<?php
	ob_start();
    
?>
    <form method="post" action="?action=xemdhshop">
        <div class="col-md-12 text-center">
            <p>
            Chọn ngày xem:                 
            <input type="text" name="chonngay" id="datepicker"/>
            <input type="submit" name="submit" value="Xem" />
            </p>
        </div>
    </form>
    <?php 
    if($dsdonhangshop == null)
    {
        echo '<div class="text-center" style="font-size:140%;padding-top:10%;">Chưa có đơn hàng nào</div>';
    }
    else
    {
        foreach($dsdonhangshop as $user=>$us){ ?>
        <div class="row">
          <div class="col-md-12" style="color: blue; font-weight: bold; text-align: center;">
            <h2>Tên Shop: <?php echo $us['thongtinshop'][0]; ?></h2> 
          </div>
        </div>                 
                
    <table class="table table-bordered table-striped">
      <tr style="background-color:darkblue;color:#FFF">
        <td>&nbsp; STT</td>
        <td>&nbsp; Tên Khách hàng</td>
        <td>&nbsp; Loại ship </td>
        <td>&nbsp; Đơn giá </td>
        <td>&nbsp; Thời gian đặt hàng</td>
      </tr>
      <div id="accordion">
      <?php $tong =0;
            $thongke = array(); ?>
      <tr>
      <form method="post" action="?action=inhoadon">
        <td colspan="7" style="color: red;"><h4><?php if(isset($date)){ $dt=date_create($date); echo $ngay = date_format($dt,'d-m-y'); } ?>
        <input type="hidden" name="ngay" value="<?php if(isset($date)) echo $date; ?>" />     
      </form>
      
      </tr>
            <?php $i=1; if($dsdonhangshop != null && $date != ""){ 
              foreach($us as $billID=>$db){ 
                if($db != $us['thongtinshop']){ ?>                     
                    
          <tr style="background-color:#222537; color: white;">
            <td>&nbsp;<?php echo $i++; ?></td>
            <td>&nbsp;<?php  echo $db[2][0];?></td>
            <td>&nbsp;<?php if($db[0][2]==0) 
                            {
                                echo 'Giao Thường';
                            }
                            else
                            {echo 'Giao Nhanh';}?></td>
            <td>&nbsp;<?php echo number_format($db[0][3]); number_format($tong += $db[0][3]);?></td>
            <td>&nbsp;<?php echo date_format($dt,'d-m-Y'); ?></td>
          </div>
    </td>            
</tr>
      <?php }}
      }
       ?>  
</table>

<?php
}}
	return ob_get_clean();
?>