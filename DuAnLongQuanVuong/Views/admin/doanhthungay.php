<?php ob_start(); ?>
    <fieldset>
    	<legend style="color: darkblue;">Doanh thu trong ngày</legend>  
        <div class="row">
            <form method="post" action="?action=doanhthungay">
                <div class="col-md-12">
                    Chọn ngày xem:                 
                    <input type="text" name="chonngay" id="datepicker"/>
                    <input type="submit" name="submit" value="Xem" />
                </div>
            </form>
        </div>       
      <div class="text-center" style="font-weight: bold;font-size: 17px; color: red;">THỐNG KÊ DOANH THU
                                    <?php //$dt=date_create($date); echo date_format($dt,'d-m-Y');?></div>
      <?php if($doanhthu == null){
                echo ' <h1 class="text-center">Chưa có dữ liệu ngày này</h1>';
            }
            else{
        ?>
        <h2 style="color: blue;">Tổng Doanh Thu Trong Ngày</h2>
      <div class="row">
          <div class="col-md-12"  style="font-weight: bold;font-size: 17px; color: #0080FF;">
            Doanh thu công ty : <?php echo number_format($doanhthu[1]['tongdoanhthu']); ?>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12"  style="font-weight: bold;font-size: 17px; color: navy;">
           Tổng Phí Ship : <?php echo number_format($doanhthu[1]['tongship']); ?>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12" style="font-weight: bold;font-size: 17px; color: #06710F;">
            Lợi nhuận công ty (20% Phí Ship) : <?php $ln= $doanhthu[1]['tongship']-$doanhthu[1]['tongluong']; echo number_format($ln); ?>
          </div>
      </div>
      
      <div class="row">
          <div class="col-md-12"  style="font-weight: bold;font-size: 17px; color: #FF0080;">      
            Lương nhân viên (80% Phí Ship) : <?php echo number_format($doanhthu[1]['tongluong']); ?>
          </div>
      </div><hr />
     
      <?php foreach($doanhthu as $us){ print_r($us); echo '<br/>'; 
            ?>
            <div> Tên Shop: <?php echo $us['thongtinshop'][0]; ?></div>
             <!--Doanh thu của từng shop -->
            <?php 
            $tongdoanhthushop=0;
            $tongshipshop=0;
            ?>
             
            <!--Hoa đơn đã giao của từng shop-->
         <div class="row">
            <div class="col-md-12" style="color: darkblue;font-size: 18px;">Hóa Đơn Đã Giao</div>
          </div>
         
      
      <table class="table table-bordered table-striped">
           <tr style="background-color:green; color: white; ">
                <td>STT</td>
                <td>Mã hóa đơn</td>
                <td>Tên Khách hàng</td>
                <td>Thành tiền</td>
                <td>Nhân Viên giao</td>
                <td>Phí Ship</td>
                <td>Phí Phụ thu</td>
            </tr>
            
            <?php $i=1; $flag=0; foreach($us['thongtinshop'] as $k=>$dthu){
                if($k >0){
                    
                if(is_array($dthu)== true ){
                   if($dthu[0][4]==2) {
                    ?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $dthu[0][0]; ?></td>
                <td><?php echo $dthu[0][1]; ?></td>
                <td><?php echo $dthu[0]['tongtientungshop']; ?></td>
                <td><?php echo $dthu[0][3]; ?></td>
                <td><?php echo $dthu[0][5]; ?></td>
                <td><?php echo $dthu[0]['tongphuthu']; ?></td>
            </tr>
            <?php }
                else
                {
                    if($flag==0)
                    {
                        $flag=$dthu[0][4];
                    }
                }
            } }}?>
      </table>
      <?php  if($flag !=0){ ?>
      <div class="row">
        <div class="col-md-12" style="color: darkblue;font-size: 18px;">Hóa Đơn Chưa Giao</div>
      </div>
      <table class="table table-bordered table-striped">
           <tr style="background-color:green; color: white; ">
                <td>STT</td>
                <td>Mã hóa đơn</td>
                <td>Tên Khách hàng</td>
                <td>Thành tiền</td>
                <td>Nhân Viên giao</td>
                <td>Phí Ship</td>
            </tr>
            
            <?php $i=1; foreach($us['thongtinshop'] as $k=>$dthu){ 
                if($k >0)
                {
                if(is_array($dthu)== true ){
                   if($dthu[0][4]!=2) {?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $dthu[0][0]; ?></td>
                <td><?php echo $dthu[0][1]; ?></td>
                <td><?php echo $dthu[0][2]; ?></td>
                <td><?php echo $dthu[0][3]; ?></td>
                <td><?php echo $dthu[0][5]; ?></td>
            </tr>
            <?php }} 
            }}?>
      </table>
      <?php } }
      } 
      ?>
  </fieldset>
<?php
	return ob_get_clean();
?>
    