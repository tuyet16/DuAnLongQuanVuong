<?php
	ob_start();
?>
    	<fieldset>
        	<legend style="80%">Thêm Quận</legend>
                <form method="post" action="">
                    <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Mã Quận </div> 
                       	<div class="col-md-3"> <input type="text" class="form-control" width="80%"/></div>
                    </div>
                     <div class="row"  style="margin-top:2px">
                    	<div class="col-md-2">Tên Quận </div> 
                       	<div class="col-md-3"> <input type="text" class="form-control" width="80%"/></div> 
                    </div>
                     <div class="row"  style="margin-top:4px;margin-left:17%">
                        	<button type="submit" class="btn" style="background-color:darkblue;color:#FFF"/> Lưu
                    </div>
                </form>
        </fieldset>
        <fieldset>
        	<legend>Danh sách Quận</legend>
                <table class="table table-bordered table-striped" width="80%">
                  <tr style="background-color:darkblue;color:#FFF">
                    <td>&nbsp;STT</td>
                    <td>&nbsp; Mã Quận</td>
                     <td>&nbsp; Tên Quận</td>
                    <td>&nbsp; Thao tác</td>
                  </tr>
                  <tr>
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