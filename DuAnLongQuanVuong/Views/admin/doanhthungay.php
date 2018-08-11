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
     <h4 style="color: red; "><?php $dt=date_create($date); echo date_format($dt,'d-m-Y');?></h4> 
      <div class="text-center" style="font-weight: bold;font-size: 17px; color: red;">THỐNG KÊ DOANH THU</div>
      <?php  if(isset($doanhthu[$date])){ ?>
      <div class="row">
          <div class="col-md-12"  style="font-weight: bold;font-size: 17px; color: #0080FF;">
            Doanh thu công ty : <?php echo number_format($doanhthu[$date]['tongdoanhthu']); ?>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12"  style="font-weight: bold;font-size: 17px; color: navy;">
           Tổng Phí Ship : <?php echo number_format($doanhthu[$date]['tongship']); ?>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12" style="font-weight: bold;font-size: 17px; color: #06710F;">
            Lợi nhuận công ty (20% Phí Ship) : <?php $ln= $doanhthu[$date]['tongship']-$doanhthu[$date]['tongluong']; echo number_format($ln); ?>
          </div>
      </div>
      
      <div class="row">
          <div class="col-md-12"  style="font-weight: bold;font-size: 17px; color: #FF0080;">      
            Lương nhân viên (80% Phí Ship) : <?php echo number_format($doanhthu[$date]['tongluong']); ?>
          </div>
      </div><hr />
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
            </tr>
            
            <?php $i=1; $flag=0; foreach($doanhthu[$date] as $dthu){ 
                if(is_array($dthu)== true ){
                   if($dthu[0][4]==2) {
                    ?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $dthu[0][0]; ?></td>
                <td><?php echo $dthu[0][1]; ?></td>
                <td><?php echo $dthu[0][2]; ?></td>
                <td><?php echo $dthu[0][3]; ?></td>
                <td><?php echo $dthu[0][5]; ?></td>
            </tr>
            <?php }
                else
                {
                    if($flag==0)
                    {
                        $flag=$dthu[0][4];
                    }
                }
            } }?>
      </table>
      <?php if($flag !=0){ ?>
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
            
            <?php $i=1; foreach($doanhthu[$date] as $dthu){ 
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
            <?php }} }?>
      </table>
      <?php } 
      } else
            echo '<h1 class="text-center">Chưa có dữ liệu ngày này</h1>';?>
  </fieldset>
<?php
	return ob_get_clean();
?>
    