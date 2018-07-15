<?php
	ob_start();
?> 
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#menu1"> <b>Bảng giá dịch vụ</b></a></li>
    <li><a data-toggle="tab" href="#menu2"><b>Phí ứng trước</b></a></li>
    <li><a data-toggle="tab" href="#menu3"><b>Phụ thu phí ship</b></a></li>
  </ul>
 <div class="tab-content"> 
     <div id="menu1" class="tab-pane fade in active">   
        <div class="row" style="margin:2%">
                <table class="table table-bordered table-striped">
                  <tr style="background-color:#66C;color:#FFF">
                        <td>&nbsp; Quận/Huyện</td>
                        <td>&nbsp; Mã khu vực</td>
                        <td>&nbsp; Số KM vượt quá</td>
                        <td>&nbsp; Tiền giao thường</td>
                        <td>&nbsp; Tiền giao nhanh</td>
                  </tr>
                  <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                </table>	
          </div>
      </div>
        <div id="menu2" class="tab-pane fade">
             <div class="row" style="margin-top:3%">
                <table class="table table-bordered table-striped" style="width:98%">
                  <tr style="background-color:#66C;color:#FFF">
                        <td>&nbsp; Số tiền</td>
                        <td>&nbsp; Phí tiền ứng</td>
                        <td>&nbsp; Thao tác</td>
                  </tr>
                  <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><a href="#"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; <a href="#"><span class="glyphicon glyphicon-remove"></span></a></td>
                  </tr>
                </table>
            </div>
        </div> 
         <div id="menu3" class="tab-pane fade">
             <div class="row" style="margin-top:3%">    
                <table class="table table-bordered table-striped" style="width:98%">
                  <tr style="background-color:#66C;color:#FFF">
                        <td>&nbsp; Khối lượng hàng không vượt qá</td>
                        <td>&nbsp; 10kg(Trên 10kg, phụ thu 1k/kg)</td>
                        <td>&nbsp; Thao tác</td>
                  </tr>
                  <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><a href="#"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; <a href="#"><span class="glyphicon glyphicon-remove"></span></a></td>
                  </tr>
                </table>
            </div>
        </div>
 </div>
<?php
	return ob_get_clean();
?>