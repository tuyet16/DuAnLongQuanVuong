<?php
	ob_start();
?> 
<h4 style="color: red;"><b>* Lưu ý:</h4> </b>
<h4 style="margin-left: 10%;">Thời Gian nhận hàng cho quý khách hàng: Từ 8 giờ đến 21 giờ mỗi ngày</h4>
<h4><b style="margin-left: 17%;">(Từ 16 giờ đến 21 giờ phụ thu thêm 5.000đ/đơn tháng)</b></h4>
<h4 style="margin-left: 20%;">Thời gian giao nhanh từ 16h - 21h là 120 phút </h4>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#menu1"> <b>Bảng giá dịch vụ</b></a></li>
    <li><a data-toggle="tab" href="#menu2"><b>Phí ứng trước</b></a></li>
    <li><a data-toggle="tab" href="#menu3"><b>Phụ thu phí ship</b></a></li>
</ul>
 <div class="tab-content"> 
     <div id="menu1" class="tab-pane fade in active">   
        <div class="row" style="margin:2%">
        	<?php
<<<<<<< HEAD
            if(isset($_SESSION['role'])){
=======
>>>>>>> d70eff797468b314366b279a18e7c68909909ceb
				if($_SESSION['role']=='0')
        		{	echo '<p  style="text-align:right">
					</p>';
				}
<<<<<<< HEAD
            }
=======
				//if($_SESSION['role']=='0')
//        		{	echo '<p  style="text-align:right">
//					<a href="">
//					<button type="button" class="btn btn-success">Thêm mới</button></a></p>';
//				}
//			

				/*if(isset($_SESSION['role'])){
					if($_SESSION['role']=='0')
					{	echo '<p  style="text-align:right">
						<a href="">
						<button type="button" class="btn btn-success">Thêm mới</button></a></p>';
					}
				}	*/	
>>>>>>> d70eff797468b314366b279a18e7c68909909ceb
			?>
                <table class="table table-bordered table-striped">
                  <tr style="background-color:darkblue;color:#FFF">
                        <td>&nbsp; Quận/Huyện</td>
                        <td>&nbsp; Mã khu vực</td>
                        <td>&nbsp; Số KM vượt quá</td>
                        <td>&nbsp; Tiền giao thường</td>
                        <td>&nbsp; Tiền giao nhanh</td>
                  </tr>
                 <?php 
						foreach($dsSV as $areas=>$districts){
							$strDistrict=NULL;
							echo "<tr><td>";
								$strDistrict = implode(',',$districts[0]);
								echo $strDistrict;
							echo "</td>
								<td>&nbsp;".$areas."</td>
								<td>&nbsp;".$districts[1][0]." km</td>
								<td>&nbsp;".$districts[1][1]." VNĐ</td>
								<td>&nbsp;".$districts[1][2]." VNĐ</td>
							  </tr>";
                  }?>
                </table>	
          </div>
      </div>
        <div id="menu2" class="tab-pane fade">
             <div class="row"  style="margin:2%">
				<?php
				if(isset($_SESSION['role']))
        		{	if($_SESSION['role']=='0')
						echo '<p  style="text-align:right"><a href="../Controllers/advance_controller.php?action=add_advance">
								<button type="button" class="btn btn-success">Thêm mới</button></a></p>';
				}
			
				?>
             <div class="row">
                <table class="table table-bordered table-striped" style="width:98%">
                  <tr style="background-color:darkblue;color:#FFF">
                        <td>&nbsp; Số tiền</td>
                        <td>&nbsp; Phí tiền ứng</td>
                  </tr>
                  <?php 
				  	foreach($dsAdvance as $row){
						echo  "<tr>
								<td>&nbsp;".$row->money."</td>
								<td>&nbsp;".$row->advanceName."</td>
							</tr>";
					}
				  ?>
                </table>
            </div>
            </div>
        </div> 
         <div id="menu3" class="tab-pane fade">
             <div class="row" style="margin:2%">
            <?php
				if(isset($_SESSION['role']))
        		{	if($_SESSION['role']=='0')	
						echo '<p  style="text-align:right"><a href="../Controllers/surcharge_controller.php?action=add_surcharge">
						<button type="button" class="btn btn-success">Thêm mới</button></a></p>';
				}
			
			?>
                <table class="table table-bordered table-striped">
                	<tr style="background-color:darkblue;color:#FFF">
                        <td>&nbsp; Loại phí</td>
                        <td>&nbsp; Nội dung</td>
                  </tr>
                  <?php	foreach($dsSurcharges as $row){
				  		echo  "<tr>
								<td>&nbsp;".$row->surchargeName."</td>
								<td>&nbsp;".$row->content."</td>
							</tr>";
				  }
				  ?>
        </div>
 </div>
<?php
	return ob_get_clean();
?>