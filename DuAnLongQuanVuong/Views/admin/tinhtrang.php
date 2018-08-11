<?php
	ob_start();
?>

    <table class="table table-bordered table-striped">
      <tr style="background-color:darkblue;color:#FFF">
        <td>&nbsp; STT</td>
        <td>&nbsp; Tên nhân viên</td>
        <td>&nbsp; Số điện thoại</td>
        <td>&nbsp; Chi Tiết</td>
      </tr>
      <div id="accordion">  
      <tr>
        <td colspan="7" style="color: red;"><h4><?php $dt=date_create($date); echo date_format($dt,'d-m-y');  ?></h4></td>
      </tr>  
        
      <?php 
      $i=1; foreach($DSdonhang[$date] as $nv){  
                $tongtienhang =0;
               $tongship =0;
               $luongnv =0 ?>        
      <tr>         
            <td>&nbsp;<?php echo $i++; ?></td>
            <td style="color: blue;font-weight: bold;">&nbsp;<?php echo $nv[0][0]; ?></td>
            <td>&nbsp;<?php echo $nv[0][1]; ?></td>           
            <td>             
                <a class="collapsed card-link" data-toggle="collapse" href="#collapse<?php echo $nv[0][2]; ?>">
                    Xem
                </a>
            </td>        
        </tr>
        <tr>
            <td colspan="7">
             <div class="card">
                <div id="collapse<?php echo $nv[0][2]; ?>" class="collapse<?php if(isset($_GET['idnv'])) {
                                                                        if($nv[0][2]==$_GET['idnv'])
                                                                        {
                                                                            echo ' show';
                                                                        }
                                                                         else
                                                                        {echo '';}
                                                                        }
                                                                       
                                                                      ?>" data-parent="#accordion">
                  <div class="card-body">
                    <div class="container-fluid">                  
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
                         <?php $a=1;                       
                         foreach($nv[1] as $hd){
                             ?>
                          <form method="post" action="?action=tinhtrang&idnv=<?php echo $nv[0][2]; ?>">
                            <input type="hidden" name="billID" value="<?php echo $hd[8]; ?>" />
                            <tr>
                                <td><?php echo $a++; ?></td>
                                <td><?php echo $hd[1]; ?></td>
                                <td><?php echo $hd[0].','.$hd[6]; ?></td>
                                <td><?php echo number_format($hd[3]); ?></td>
                                <td><input type="text" name="phiship" value="<?php echo $hd[9]; ?>" /></td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <div class="row" style="padding-bottom: 10px;">
                                        <div class="col-md-1">Ghi chú: </div>
                                        <div class="col-md-11">
                                            <input type="text" name="ghichu" value="<?php echo $hd[5];  ?>" class="form-control"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <tr>
                        <td colspan="5">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="radio" value="2" name="rd" <?php if($hd[4]==2)
                                                                {echo 'checked="checked"';
                                                                    $luongnv += $hd[10];
                                                                    $tongtienhang += $hd[3];
                                                                    $tongship += $hd[9];
                                                                }
                                                                else
                                                                {
                                                                    echo '';
                                                                } ?>/> Đã giao
                                <input type="radio" value="1" name="rd" <?php if($hd[4]==1)
                                                                        {echo 'checked="checked"';}
                                                                        else
                                                                        {
                                                                            echo '';
                                                                        } ?>/> Chưa giao
                                <input type="radio" value="0" name="rd" <?php if($hd[4]==0)
                                                                    {echo 'checked="checked"';}
                                                                    else
                                                                    {
                                                                        echo '';
                                                                    } ?>/> Hủy đơn hàng
                            </div>  
                                                      
                            <div class="col-md-7">
                               <input type="submit" name="submit" class="btn btn-success" value="Cập Nhật" />
                            </div>  
                         </div> 
                         </td>
                         </tr>
                          </form>
                         <?php } ?>                           
                         <tr class="text-left">        
                            <td colspan="5">
                                <p>Tổng Thu Hộ: <label style="color: red;"> <?php echo number_format($tongtienhang); ?></label></p>
                                <p>Tổng Tiền Ship: <label style="color: green;"><?php echo number_format($tongship); ?></label></p>
                                <p>Tiền ship trả nhân viên: <label style="color: blue;"><?php echo number_format($luongnv); ?></label></p>                                
                            </td>
                        </tr>
                        
                       </table>                    
                    </div>
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
	return ob_get_clean();
?>  