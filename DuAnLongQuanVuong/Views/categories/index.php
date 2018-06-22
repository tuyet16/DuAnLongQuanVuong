<?php
	ob_start();
?>
    	<fieldset>
        	<legend style="80%">Thêm mới loại sản phẩm</legend>
                <form method="post" action="">
                    <div class="row">
                    	<div class="col-md-2">Tên loại sản phẩm: </div> 
                       	<div class="col-md-4"> <input type="text" class="form-control" width="80%"/></div>
                        <div class="col-md-6">
                        	<button type="submit" class="btn" style="background-color:darkblue;color:#FFF"/> Lưu
                        </div>
                    </div>
                </form>
        </fieldset>
        <fieldset>
        	<legend>Danh sách loại sản phẩm</legend>
                <table class="table table-bordered table-striped" width="80%">
                  <tr style="background-color:darkblue;color:#FFF">
                    <td>&nbsp;STT</td>
                    <td>&nbsp; Tên loại sản phẩm</td>
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