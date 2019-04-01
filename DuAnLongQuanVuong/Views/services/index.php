<?php
	ob_start();
?> 
<h4 style="color: red;"><b>* Lưu ý:</b></h4> 
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <h4 style="margin-left: 10%;text-align: center;">
            <?php  
                 foreach($dsquydinh as $row){    
                          echo $row->tentieude;
                        }
            ?>
        </h4>
        
    </div>
    <div class="col-md-2">
    
    </div>
</div>


<ul class="nav nav-tabs" style="padding-top: 30px;">
    <li class="active"><a data-toggle="tab" href="#menu1"> <b>Bảng giá dịch vụ</b></a></li>
    <li><a data-toggle="tab" href="#menu2"><b>Phí ứng trước</b></a></li>
    <li><a data-toggle="tab" href="#menu3"><b>Phụ thu phí ship</b></a></li>
</ul>
 <div class="tab-content" > 
     <div id="menu1" class="tab-pane fade in active">   
        <div class="row" style="margin:2%">
        	<?php
            if(isset($_SESSION['role'])){
				if($_SESSION['role']=='0')
        		{	echo '<p  style="text-align:right">
					</p>';
				}
            }
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