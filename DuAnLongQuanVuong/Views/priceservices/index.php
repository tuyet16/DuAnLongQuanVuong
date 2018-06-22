<?php
	ob_start();
?>
<fieldset>
	<legend>       
  		<div class="row">
            <div class="col-md-6" >
            	<h4><b><i>Bảng giá dịch vụ </i></b></h4>
            </div>
            <div class="col-md-6 text-right" style="padding-top:1%;">
            	<a href="#"><span class="glyphicon glyphicon-plus-sign" style="font-size:24px;color:#66C;background-color:#FFF"></span></a>
            </div>
        </div>
    </legend>
    <table class="table table-bordered table-striped">
      <tr style="background-color:#66C;color:#FFF">
            <td>&nbsp; Quận/Huyện</td>
            <td>&nbsp; Mã khu vực</td>
            <td>&nbsp; Số KM vượt quá</td>
            <td>&nbsp; Tiền giao thường</td>
            <td>&nbsp; Tiền giao nhanh</td>
            <td>&nbsp; Thao tác</td>
      </tr>
      <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><a href="#"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; <a href="#"><span class="glyphicon glyphicon-remove"></span></a></td>
      </tr>
    </table>
</fieldset>

<fieldset>
	<legend>       
  		<div class="row">
            <div class="col-md-6" >
            	<h4><b><i>Phí ứng trước</i></b></h4>
            </div>
            <div class="col-md-6 text-right" style="padding-top:1%;">
            	<a href="#"><span class="glyphicon glyphicon-plus-sign" style="font-size:24px;color:#66C;background-color:#FFF"></span></a>
            </div>
        </div>
    </legend>
    <table class="table table-bordered table-striped">
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
</fieldset>

<fieldset>
	<legend>       
  		<div class="row">
            <div class="col-md-6" >
            	<h4><b><i>Phụ thu phí ship</i></b></h4>
            </div>
            <div class="col-md-6 text-right" style="padding-top:1%;">
            	<a href="#"><span class="glyphicon glyphicon-plus-sign" style="font-size:24px;color:#66C;background-color:#FFF"></span></a>
            </div>
        </div>
    </legend>
    <table class="table table-bordered table-striped">
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
</fieldset>
<?php
	return ob_get_clean();
?>