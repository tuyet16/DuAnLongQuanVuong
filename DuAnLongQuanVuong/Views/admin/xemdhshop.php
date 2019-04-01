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
    { //print_r($DSdonhang);
       ?>
    <table class="table table-bordered table-striped">
      <tr style="background-color:darkblue;color:#FFF">
        <td>&nbsp; STT</td>
        <td>Mã HD</td>
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
        <td colspan="7" style="color: red;"><h4><?php if(isset($date)){ $dt=date_create($date); echo $ngay = date_format($dt,'d-m-y'); } ?>
        <input type="hidden" name="ngay" value="<?php if(isset($date)) echo $date; ?>" />     
      </form>
      
      </tr>
            <?php $i=1; if($dsdonhangshop != null && $date != ""){ 
              foreach($dsdonhangshop as $billID=>$db){ 
  
                //print_r($db['thongtinbill'][3]);
               // if($db != $us['thongtinshop']){ ?>                     
                    
          <tr style="background-color: #000; color: #FFF;">
            <td>&nbsp;<?php echo $i++; ?></td>
            <td>&nbsp;<?php echo 'HD'.$db['thongtinbill'][9]; ?></td>
            <td>&nbsp;<?php  echo $db['thongtinkh'][0];?></td>
            <td>&nbsp;<?php if($db['thongtinbill'][2]==0) 
                            {
                                echo 'Giao Thường';
                            }
                            else
                            {echo 'Giao Nhanh';}?></td>
            <td>&nbsp;<?php echo $db['thongtinbill'][3];  $tong += $db['thongtinbill'][3];?></td>
            <td>&nbsp;<?php echo date_format($dt,'d-m-Y'); ?></td>
            <td>             
                <a class="collapsed card-link" data-toggle="collapse" style="color: #fff;" 
                            href="#collapse<?php echo $billID; ?>">
                    Xem
                </a>
            </td>            
        </tr>               
        <tr>
            <td colspan="7">
             <div class="card">
             <?php
             if(isset($_GET['BillID'])){
                if($_GET['BillID']==$billID){
             ?>
                <div id="collapse<?php echo $billID; ?>" class="collapse in" data-parent="#accordion">
             <?php
                }
                else{
             ?>
                    <div id="collapse<?php echo $billID; ?>" class="collapse" data-parent="#accordion">
             <?php 
                }
             }
             else{
             ?>
             <div id="collapse<?php echo $billID; ?>" class="collapse in" data-parent="#accordion">
             <?php
             }
             ?>
              <div class="card-body">
                <div class="container-fluid">               
                <div class="row">     
                                                   
                   <label>Số điện thoại: <?php echo $db['thongtinkh'][2]; ?></label>
                 </div>
                 <div class="row"> 
                  <label>Địa chỉ:  <?php echo $db['thongtinkh'][1].', '. $db['thongtinkh'][3]; ?></label>
                </div>
                 <div class="row"> 
                  <label>Phí Ship:  <?php echo $db['thongtinbill'][8]; ?></label>
                </div>
                
                    <?php if(isset($_POST['nhanvien'])){
                        $select = $_POST['nhanvien'];
                    } ?>
                    <div class="row">
                     <?php
                      foreach($db as $us=>$user){ 
                       // print_r($user);
                      if(is_numeric($us))
                      {    
                        ?>
                        <div class="row">
                            <div class="col-md-2">Tên Shop:</div>
                            <div class="col-md-6" style="color: blue;font-weight: bold;"> <?php  echo $db[$us]['tenshop'][0] ;?></div> 
                            <div class="col-md-4">
                                <?php  
                                $j= false;
                                    foreach($user as $key=>$detail){
                                        foreach($detail as $detail_item)
                                        { 
                                            if($key == 'detail')
                                            {                                           
                                             if($detail_item[10]==0)
                                             {
                                                    if($i==false)
                                                    {
                                                       echo '<b style="color:red">Shop chưa gửi đơn hàng</b>'; 
                                                       $i= true;
                                                    }                                                
                                                }
                                                else
                                                {
                                                    echo "";
                                                }
                                            }
                                          }
                                        }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Số Điên Thoại:</div>
                            <div class="col-md-10" style="color: blue; font-weight: bold;"> <?php  echo $db[$us]['tenshop'][1] ;?></div> 
                        </div>
                        <form method="post" action="?action=editnhanvien">
                        <table class="table table-bordered table-striped text-center">
                         <input type="hidden" name="billID" value="<?php echo $billID; ?>"/>                        
                         <input type="hidden" name="ngay" value="<?php echo $date; ?>"/>
                            <tr style="background-color:green; color: white; ">
                                <td>STT</td>
                                <td>Tên sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Đơn vị</td>
                                <td>Giá</td>
                                <td>Giảm giá</td>
                                <td>Phí Phụ Thu</td>                                
                                <td>Thành tiền</td>
                            </tr>                            
                            <?php $a=1;
                            $i= false;
                             foreach($user as $key=>$detail){
                                foreach($detail as $detail_item)
                                {         
                                if($key == 'detail')
                                {
                                    $masp=0;
                                    $maphiship =0; 
                                    if($detail_item != null){
                                        $masp= $detail_item[1];
                                        $maphiship = $detail_item[0];                                     
                                ?>                        
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
                                </td>
                                <td style=" color: red; font-weight:bold">
                                    <input type="text" name="phuthu<?php echo $detail_item[0]; ?>" value="<?php echo $detail_item[8]; ?>" />
                                </td>                             
                              
                                 <input type="hidden" name="detailID" value="<?php echo $detail_item[0]; ?>"/>
                                <input type="hidden" name="gia<?php echo $detail_item[0]; ?>" value="<?php echo $detail_item[0][6]; ?>" />
                                <td><?php echo number_format($detail_item[12]); ?></td>
                            </tr>
                           <?php }}} }?>
                        </table>
                        <?php }}
                        $shipper = '';
                       
                        ?>                        
                        <div class="row">
                        </div>
                      </form>  
                    </div>                    
                  </div>    
              </div>
              
            </div>
          </div>
      </div>
      </div>
    </td>            
</tr>
</div>
      <?php }
      }
       ?>  
</table>

<?php
}
	return ob_get_clean();
?>