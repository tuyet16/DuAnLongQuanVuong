<?php ob_start(); ?>
    <fieldset>
    	<legend style="color: darkblue;">Doanh thu trong ngày</legend>
            <table class="table table-bordered table-striped">
              <tr style="background-color:darkblue;color:#FFF">
                <td>&nbsp; STT</td>
                <td>&nbsp; Tổng đơn hàng</td>
                <td>&nbsp; Tổng Doanh thu</td>
                
              </tr>
              <tr>
                <td>&nbsp;1</td>
                <td>&nbsp;50</td>
                <td>&nbsp;9.789.000</td>
                
              </tr>
            </table>
    </fieldset>
    <fieldset>
    	<legend style="color: green;">Lương nhân viên</legend>
            <table class="table table-bordered table-striped">
              <tr style="background-color:green;color:#FFF">
                <td>&nbsp; STT</td>
                <td>&nbsp; Tổng đơn hàng</td>
                <td>&nbsp; Tổng lương nhân viên</td>                
              </tr>
              <tr>
                <td>&nbsp;1</td>
                <td>&nbsp;50</td>
                <td>&nbsp;9.789.000</td>
              </tr>
            </table>
    </fieldset>
    <fieldset>
    	<legend style="color: red;">Hóa đơn còn tồn</legend>
            <table class="table table-bordered table-striped">
              <tr style="background-color:red;color:#FFF">
                <td>&nbsp; STT</td>
                <td>&nbsp; Tổng đơn hàng</td>
                <td>&nbsp; Tổng thu</td>                
              </tr>
              <tr>
                <td>&nbsp;1</td>
                <td>&nbsp;50</td>
                <td>&nbsp;9.789.000</td>
              </tr>
            </table>
    </fieldset>
<?php
	return ob_get_clean();
?>