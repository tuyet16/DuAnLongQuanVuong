<?php ob_start(); ?>
    <fieldset>
    	<legend style="color: darkblue;">Doanh thu trong ngày</legend>  
        <div class="row">
            <form method="post" action="?action=doanhthunam">
                <div class="col-md-12">
                    Chọn ngày xem:                 
                    <input type="text" name="chonnam" class="date-year"/>
                    <input type="submit" name="submit" value="Xem" />
                </div>
            </form>
        </div>
        <div class="text-center" style="font-weight: bold;font-size: 17px; color: red;">THỐNG KÊ DOANH THU NĂM <?php  echo $date;?></div>     
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="border: 1px solid silver">
                <div class="card bg-primary">
                  <div class="card-header text-center" style="padding: 10px;font-weight: bold;">THỐNG KÊ HÓA ĐƠN ĐÃ GIAO</div>
                  </div>
                  <div class="card-body" style="padding-left: 30px;">
                    <?php print_r($doanhthu); if(isset($doanhthu)){ 
                        ?>
                      <div class="row">
                          <div class="col-md-12"  style="font-weight: bold;font-size: 17px; color: #0080FF;">
                            Doanh thu công ty : <?php echo number_format($doanhthu['doanhthunamgiao']); ?>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12"  style="font-weight: bold;font-size: 17px; color: navy;">
                           Tổng Phí Ship : <?php echo number_format($doanhthu['shipnamgiao']); ?>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12" style="font-weight: bold;font-size: 17px; color: #06710F;">
                            Lợi nhuận công ty (20% Phí Ship) : <?php echo number_format($doanhthu['shipnamgiao']-$doanhthu['luongnamgiao']);  ?>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12"  style="font-weight: bold;font-size: 17px; color: #FF0080;">      
                            Lương nhân viên (80% Phí Ship) : <?php echo number_format($doanhthu['luongnamgiao']); ?>
                          </div>
                      </div>                  
                  </div> 
                </div>
            </div>
        </div>
        <div class="row" style="padding-top: 30px;">
            <div class="col-md-6">
                <div class="card" style="border: 1px solid silver">
                  <div class="card bg-danger">
                    <div class="card-header">THỐNG KÊ HÓA ĐƠN CHƯA GIAO</div>
                  </div>
                  <div class="card-body">
                       <div class="row">
                          <div class="col-md-12"  style="font-weight: bold;font-size: 17px; color: blue;">      
                            Tổng Phí Hàng Chưa Giao : <?php echo number_format($doanhthu['doanhthunamchuagiao']); ?>
                          </div>
                      </div> 
                  </div> 
                </div>
            </div>
        </div>
         <hr />
      <div class="row">
        <div class="col-md-12" style="color: darkblue;font-size: 18px;">HÓA ĐƠN ĐÃ GIAO</div>
      </div>
      <table class="table table-bordered table-striped">
           <tr style="background-color:green; color: white; ">
                <td>STT</td>
                <td>Ngày Thống Kê</td>
                <td>Tông số hóa đơn</td>
                <td>Tổng Doanh thu</td>
                <td>Tổng Phí Ship</td>
                <td>Tổng tiền lương NV</td>
                <td>Lợi nhuận công ty</td>
            </tr>
                  <?php $i=1;foreach($doanhthu as $dagiao=>$dg){;
                if(isset($doanhthu[$dagiao]['tonghdthang'])){
                    ?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $dagiao.'-'.$date; ?></td>
                <td><?php echo number_format($dg['tonghdthang']); ?></td>
                <td><?php echo number_format($dg['doanhthuthang']); ?></td>
                <td><?php echo number_format($dg['phishipthang']); ?></td>
                <td><?php echo number_format($dg['luongnvthang']); ?></td>
                <td><?php echo number_format($dg['phishipthang']- $dg['luongnvthang']); ?></td>
            </tr>
            <?php }}?>
           
      </table>
      <div class="row">
        <div class="col-md-12" style="color: darkblue;font-size: 18px;">HÓA ĐƠN CHƯA GIAO</div>
      </div>
      <table class="table table-bordered table-striped">
           <tr style="background-color:green; color: white; ">
                <td>STT</td>
                <td>Ngày Thống Kê</td>
                <td>Tông số hóa đơn</td>
                <td>Tổng Doanh thu</td>
                <td>Tổng Phí Ship</td>
                <td>Tổng tiền lương NV</td>
                <td>Lợi nhuận công ty</td>  
            </tr>
                  <?php $i=1;foreach($doanhthu as $chuagiao=>$cg){
                if(isset($doanhthu[$chuagiao]['hdchuagiao'])){
                    ?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $chuagiao.'-'.$date; ?></td>
                <td><?php echo number_format($cg['hdchuagiao']); ?></td>
                <td><?php echo number_format($cg['dtchuagiao']); ?></td>
                <td><?php echo number_format($cg['pschuagiao']); ?></td>
                <td><?php echo number_format($cg['lchuagiao']); ?></td>
                <td><?php echo number_format($cg['pschuagiao']- $cg['lchuagiao']); ?></td>
            </tr>
            <?php }}} else{ echo 'Không có dữ liệu';}?>
           
      </table>
  </fieldset>
<?php
	return ob_get_clean();
?>
    