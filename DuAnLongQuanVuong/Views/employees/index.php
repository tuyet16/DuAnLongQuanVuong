<?php
	ob_start();
?>
    	<fieldset>
        	<legend style="80%;color: #21B124;"><b>Thêm nhân viên</b></legend>
                <form method="post" action="">
                    <div class="row">
                    	<div class="col-md-2">Mã nhân viên</div> 
                       	<div class="col-md-5"> <input type="text" class="form-control" width="60%"/></div>
                    </div>
                     <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Tên nhân viên</div> 
                       	<div class="col-md-5"> <input type="text" class="form-control" width="60%"/></div>
                    </div>
                     <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Địa chỉ</div> 
                       	<div class="col-md-5"> <input type="text" class="form-control" width="60%"/></div>
                    </div>
                    <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Số điện thoại</div> 
                       	<div class="col-md-5"> <input type="text" class="form-control" width="60%"/></div>
                    </div>
                    <div class="row" style="margin-top:3px;margin-left:52%"> 
                    	<button type="submit" class="btn" style="background-color:darkblue;color:#FFF"> Lưu </button> 
                   </div>
                </form>
        </fieldset>
        <fieldset>
        	<legend>Danh sách nhân viên</legend>
                <table class="table table-bordered table-striped">
                  <tr style="background-color: darkblue;color:#FFF">
                    <td>&nbsp;STT</td>
                    <td>&nbsp; Mã NV</td>
                    <td>&nbsp; Tên NV</td>
                    <td>&nbsp; Địa chỉ</td>
                    <td>&nbsp; Số điện thoại</td>
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
<?php
	return ob_get_clean();
?>