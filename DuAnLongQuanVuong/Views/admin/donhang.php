<?php
	ob_start();
    
?>
    <form method="post" action="?action=donhang">
        <div class="col-md-12 text-center">
            <p>
            Chọn ngày xem:                 
            <input type="text" name="chonngay" id="datepicker"/>
            <input type="submit" name="submit" value="Xem" />
            </p>
        </div>
    </form>
    <?php 
    if($DSdonhang == null)
    {
        echo '<div class="text-center" style="font-size:140%;padding-top:10%;">Chưa có đơn hàng nào</div>';
    }
    else
    { //print_r($DSdonhang);
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
        <td colspan="7" style="color: red;"><h4><?php if(isset($date)){ $dt=date_create($date); echo $ngay = date_format($dt,'d-m-y'); } ?>
        <input type="hidden" name="ngay" value="<?php if(isset($date)) echo $date; ?>" />     
      </form>
      
      </tr>
            <?php $i=1; if($DSdonhang != null && $date != ""){ 
              foreach($DSdonhang as $billID=>$db){ 
                //print_r($db);
               // if($db != $us['thongtinshop']){ ?>                     
                    
          <tr style="background-color: #000; color: #FFF;">
            <td>&nbsp;<?php echo $i++; ?></td>
            <td>&nbsp;<?php  echo $db['thongtinkh'][0];?></td>
            <td>&nbsp;<?php if($db['thongtinbill'][2]==0) 
                            {
                                echo 'Giao Thường';
                            }
                            else
                            {echo 'Giao Nhanh';}?></td>
            <td>&nbsp;<?php echo $db['thongtinbill'][3]; $tong += $db['thongtinbill'][3];?></td>
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
                    <div class="col-md-10" style="color: red; font-weight: bold;">
                    <?php if($db['thongtinbill'][7]==1)
                        {
                            echo 'Người Thanh Toán Phí Ship: Khách Hàng ';
                        }
                        ?>
                    </div>
                </div>
                    <?php if(isset($_POST['nhanvien'])){
                        $select = $_POST['nhanvien'];
                    } ?>
                     <?php foreach($DSdonhang as $user){ //print_r($user); ?> 
                        
                         <div><?php echo $user['tenshop'][0][0] ?></div>  
                
                    <div class="row">
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
                             foreach($db[1] as $key=>$detail_item){ 
                                if($key== 'detail')
                                {
                                if($detail_item != null){?>
                            <tr>
                                <td><?php echo $a++; ?></td>
                                <td><?php echo $detail_item[0][4]; 
                                    if(isset($thongke[$detail_item[0][4]]))
                                    {
                                        $thongke[$detail_item[0][4]] += $detail_item[0][2]; 
                                        //$thongke[$detail_item[4]].=' '.$detail_item[5];
                                    }
                                    else
                                    {
                                        $thongke[$detail_item[0][4]] = $detail_item[0][2];
                                        //$thongke[$detail_item[4]].=' '.$detail_item[5];
                                    }
                                    ?></td>
                                <td><?php echo $detail_item[0][2];  ?></td>
                                <td><?php echo $detail_item[0][5]; ?></td>
                                <td><?php echo number_format($detail_item[0][6]); ?></td>
                                <td>
                                    <?php echo $detail_item[0][7]; ?>%
                                                                           
                                    <?php  } ?>
                                   
                                </td>
                                <td style=" color: red; font-weight:bold">
                                    <input type="text" name="phuthu<?php echo $detail_item[0][0]; ?>" value="<?php echo $detail_item[0][8]; ?>" />
                                </td>
                                 <input type="hidden" name="detailID" value="<?php echo $detail_item[0][0]; ?>"/>
                                <input type="hidden" name="gia<?php echo $detail_item[0][0]; ?>" value="<?php echo $detail_item[0][6]; ?>" />
                                <td><?php echo number_format($detail_item[0][3]); ?></td>
                            </tr>
                           <?php }}}?> 
                        </table>
                        <?php 
                        $shipper = '';
                        ?>                        
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <div class="row">
                                Chọn nhân viên:                             
                                    <select name="nhanvien">
                                    <?php foreach($db[1] as $key=>$employee){ 
                                        
                                        if($key=='nhanvien')
                                        {
                                        foreach($employee as $nv)
                                        if($db['thongtinbill'][6] == $nv[0]){
                                            $shipper = $nv[2];  
                                        ?>
                                        <option value="<?php echo $nv[0]; ?>" selected/><?php echo $nv[2]; ?></option>
                                    <?php }
                                        else{
                                     ?>
                                     <option value="<?php echo $nv[0]; ?>"><?php echo $nv[2]; ?></option>
                                     <?php
                                        }
                                     }}
                                     ?>
                                    </select>                            
                                </div>
                            </div>
                            <div class="col-md-5 text-right">
                                <?php
                                if(empty($shipper)== true){
                                ?>
                                Chưa có shipper nào được phân công
                                <?php
                                }
                                else{ 
                                ?>
                                Shipper đã được phân công :<b style="font-size: 120%; font-weight: bold;color: red;"><?php echo $shipper;?></b>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-md-4 text-right">
                            <?php //if($db[0][4] !=2){ ?>
                                <button type="submit" name="submit" class="btn btn-success">Cập nhật</button>
                            <?php //}
                            //else echo ''; 
                            if($db['thongtinbill'][6]==0)
                            {
                                echo 'Vui lòng chọn người giao hàng';
                            }
                            else
                            {?>
                                <a href="?action=inhoadon&billID=<?php echo $billID; ?>" class="btn btn-danger">In Hóa Đơn</a>
                                <?php } ?>
                            </div>
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