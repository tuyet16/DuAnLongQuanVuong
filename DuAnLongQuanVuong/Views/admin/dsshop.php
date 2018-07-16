<?php
	ob_start();
?>
    	<fieldset>
        	<legend>Danh sách sản phẩm của shop</legend>
                <table class="table table-bordered table-striped">
                  <tr style="background-color:darkblue;color:#FFF">
                    <td>&nbsp; STT</td>
                    <td>&nbsp; Họ và Tên</td>
                    <td>&nbsp; Email</td>
                    <td>&nbsp; Địa chỉ</td>
                    <td>&nbsp; Điện Thoại </td>
                    <td>Tên Shop</td>
                    <td>&nbsp; Thao tác</td>
                  </tr>
                  
                  <?php
		  	   $i=1;
				foreach($dsUsers as $row){
					echo '<tr>
					<td>&nbsp;'.$i++.'</td>
					<td>&nbsp;'.ucfirst($row->fullname).'</td>
					<td>&nbsp;'.$row->email.'</td>
					<td>&nbsp;'.$row->address.'</td>
					<td>&nbsp;'.$row->phone.'</td>
                    <td>&nbsp;'.$row->shopName.'</td>
					<td><a href="../Controllers/admin_controller.php?action=suashop&id='.$row->userid.'"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; 
						<a href="../Controllers/admin_controller.php?action=delete_user&id='.$row->userid.'"><span class="glyphicon glyphicon-remove"></span></a></td>
				  </tr>';
			}
		  ?>
                </table>
        </fieldset>
<?php
	return ob_get_clean();
?>