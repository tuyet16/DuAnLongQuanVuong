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
    
    if(count($DSdonhang) <= 0)
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
        <td>&nbsp; Tinh trạng</td>
        <td>&nbsp; Đơn giá </td>
        <td>&nbsp; Thời gian đặt hàng</td>
        <td>&nbsp; Chi Tiết</td>
      </tr>
      <div id="accordion">
      <?php //foreach($DSdonhang as $date=>$billIDs) {
            $tong =0;
            $tongphiship = 0;
            $thongke = array();
        ?>    
      <tr>
        <td colspan="7" style="color: red;">
        
        <h4><?php $dt=date_create($date); 
                    echo date_format($dt,'d-m-Y'); ?></h4></td>
      </tr>
        <?php $j=1; foreach($DSdonhang[$date] as $billID=>$db){ 
                
            ?>
          <tr>
            <td>&nbsp;<?php echo $j++;?></td>
            <td>&nbsp;<?php echo $db[1][0]; ?></td>
            <td>&nbsp;<?php if($db[0][2]==0)
                        {
                            echo 'Giao Thường';
                        }else echo 'Giao Nhanh' ?></td>
            <td>
                <?php 
                    
                    if($db[0][4] == 0){
                        echo 'Hủy';
                    }
                    else if($db[0][4] == 1){
                        echo 'Chưa Giao';
                    }
                    else{
                        echo 'Đã Giao';
                    }
                ?>
            </td>
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
         <?php
            if(isset($_GET['id'])){
                if($_GET['id'] == $billID){
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
            <div id="collapse<?php echo $billID; ?>" class="collapse" data-parent="#accordion">
         <?php
         }
         ?>
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
                            <td>Tên Sản Phẩm</td>
                            <td>Số Lượng</td>
                            <td>Đơn Vị</td>
                            <td>Giá</td>
                            <td>Giảm Giá</td>
                            <td>Thành Tiền</td>
                            <td>Tình Trạng</td>
                            <td>Hủy SP</td>
                        </tr>
                        
                        <?php  $a=1; 
                        $detail_id_arr = array();
                        $check_product_acceptance = false;    
                        foreach($db[2] as $detail_item){
                            if($detail_item != null){
                                if($detail_item[7] > 0){
                                    $check_product_acceptance = true;
                                }
                                ?>
                        <tr>
                            <td><?php echo $a++; ?></td>
                            <td><?php echo $detail_item[3]; 
                                if(isset($thongke[$detail_item[3]]))
                                {
                                    $thongke[$detail_item[3]] += $detail_item[1]; 
                                    //$thongke[$detail_item[4]].=' '.$detail_item[5];
                                }
                                else
                                {
                                    $thongke[$detail_item[3]] = $detail_item[1];
                                    //$thongke[$detail_item[4]].=' '.$detail_item[5];
                                }
                                ?></td>
                            <td>
                            <?php if($check_product_acceptance == false){?>
                                <input type="text" name="<?php echo $detail_item[0]; ?>" value="<?php echo $detail_item[1];  ?>" 
                                                     style="width: 50px;" />
                            <?php } else
                                    echo $detail_item[1];
                              ?>
                            </td>
                            <td><?php echo $detail_item[4]; ?></td>
                            <td><?php echo number_format($detail_item[2]); ?></td>
                            <td>
                            <?php if($check_product_acceptance == false){?>
                                <select name="giamgia<?php echo $detail_item[0]; ?>">
                                <?php for($i=0; $i<=20;$i+=5){ 
                                    if($i == $detail_item[6])
                                    {
                                    ?>
                                    <option value="<?php echo $i ?>" selected="selected"><?php echo $i; ?>%</option>
                                      <?php
                                    }else
                                    {
                                       echo '<option value="'.$i.'">'. $i.'%</option>'; 
                                    }
                                    ?>                                        
                                <?php } } else
                                    echo $detail_item[6];
                                    }
                                 ?>
                                </select>
                            </td>
                            <input type="hidden" name="gia<?php echo $detail_item[0]; ?>" value="<?php echo $detail_item[5]; ?>" />
                            <td><?php echo number_format($detail_item[5]); ?></td>
                            <td><?php if($db[0][4]==2){
                                        echo 'Đã Giao';
                                    }
                                    else
                                    {
                                        if($db[0][4]==1)
                                        {
                                            echo 'Chưa Giao';
                                        }
                                        else
                                        {
                                            echo 'Bị Hủy';
                                        }
                                    } ?></td>
                            <td>
                                <a href="?action=xoasanpham&detailID=<?php echo $detail_item[0]?>&date=<?php echo $date;?>">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                        <?php 
                            $detail_id_arr[] = $detail_item[0];
                           // print_r($db[0][7]);
                        } ?>
                    </table>
                    
                    <div class="col-md-12"><label class="control-label">Phí Giao Hàng:
                                                        <?php 
                                                            $phi = 0;
                                                            if($detail_item[8] == 0){
                                                                echo $detail_item[9];
                                                                $phi = $detail_item[9];
                                                                $tongphiship += $phi;
                                                                echo '<input type="hidden" name="phishipshop" value="' . $phi . '"/>';
                                                                echo '<input type="hidden" name="phishipkh" value="0"/>';
                                                            }
                                                            else{
                                                                echo $detail_item[10];
                                                                $phi = $detail_item[10];
                                                                echo '<input type="hidden" name="phishipkh" value="' . $phi . '"/>';
                                                                echo '<input type="hidden" name="phishipshop" value="0"/>';
                                                            }        
                                                        ?></label><br /></div>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <input type="radio" name="nguoitraship" value="0" <?php if($detail_item[8]==0)
                                                                                {
                                                                                    echo 'checked="checked"' ;                                                                              
                                                                                    
                                                                               }else
                                                                               {
                                                                                echo "";
                                                                               }
                                                                                     ?>   /> Chủ Trả Phí
                        </div>
                        <div class="col-md-3">
                            <input type="radio" name="nguoitraship" value="1" <?php if($detail_item[8]==1)
                                                                                {
                                                                                    echo 'checked="checked"' ;                                                                              
                                                                                    
                                                                               }else
                                                                               {
                                                                                echo "";
                                                                               }?> /> Khách Trả Phí
                        </div>
                    </div>
                    <div class="text-right">
                        <?php if($check_product_acceptance == false){?>
                        <button type="submit" name="submit" class="btn btn-success">Cập nhật</button>
                        
                        <a href="users_controller.php?action=guidonhang&detail_id=<?php echo implode('_',$detail_id_arr);?>" 
                        class="btn btn-success">Gửi đơn hàng</a>
                        <?php
                        }
                        else{
                        ?>
                        <div class="text-right">
                                    <input type="button" class="btn btn-danger" value="Đã gửi hàng" />
                                  </div>
                        
                    <?php } 
                    ?>
                    </div>
                     </form>
                </div>
                
                </div>    
              </div>
            </div>
          </div>
        </td>
    </tr>
        <?php }  ?> 
       <tr style="margin-top: 20px;">
            <td colspan="4" style="color: red; text-align: center;font-weight: bolder;font-size: 130%;">Tổng tiền</td>
            <td colspan="3" style="color: blue;background-color: #FDE1FD;"><b><?php echo number_format($tong); ?></b></td>
            
        </tr>
        <tr>
            <td colspan="4" style="text-align: center;font-weight: bolder;font-size: 130%;">Tổng phí ship</td>
            <td colspan="3" style="font-weight: bold;"><?php echo number_format($tongphiship);?></td>
        </tr>
        <!-- bảng thống kê số lượng -->
        
        <tr>
            <td colspan="7" style="color: red; font-weight: bolder; font-size: 120%;text-align: center;">THỐNG KÊ SỐ LƯỢNG</td></tr>
        <tr style="background-color: green ; color: white;">
            <td>STT</td>
            <td colspan="3">Tên sản phẩm</td>
            <td colspan="3">Tổng số lượng</td>
        </tr>
        <?php $i=1; foreach($thongke as $tk=>$sl){ ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td colspan="3"><?php echo $tk; ?></td>
            <td colspan="3"><?php echo $sl; ?></td>
        </tr>
        <?php } ?>
               
   </div>
        

</table>
<!-- <ul class="pagination">    
    <?php //$i=0;
//         foreach($DSdonhang1 as $date1=>$dt1){
//            if($date1==$date)
//            {   ?>
        <li class="page-item active"><a class="page-link" href="?action=donhang&ngay=<?php // echo $date1; ?>">
                                        <?php //$dtam = date_create($date1); echo date_format($dtam,'d-m-y'); ?></a></li>
    <?php        
   // }
   // else
   // {?>
        <li class="page-item"><a class="page-link" href="?action=donhang&ngay=<?php // echo $date1; ?>">
                            <?php // $dtam = date_create($date1); echo date_format($dtam,'d-m-y'); ?></a></li>
    <?php 
   // }} ?>
</ul> -->

  
  
<?php
}
	return ob_get_clean();
?>