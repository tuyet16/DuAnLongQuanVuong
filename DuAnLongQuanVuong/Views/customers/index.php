<?php
	ob_start();
?>
<fieldset style="margin-top:2%">
    <legend> <font style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif, sans-serif;color:#006">Danh sách khách hàng</font>
    		<p class="text-center"><a href="../Controllers/customers_controller.php?action=add_customer">Thêm Mới</a></p></legend>
        <table class="table table-bordered table-striped">
          <tr style="background-color: darkblue;color:#FFF">
            <td>&nbsp;STT</td>
            <td>&nbsp; Tên khách hàng</td>
            <td>&nbsp; Địa chỉ</td>
            <td>&nbsp; Số điện thoại </td>
            <td>&nbsp; Thao tác</td>
          </tr>         
          <?php
		  	$i=1;
				foreach($dsCustomers as $row){
					echo '<tr>
					<td>&nbsp;'.$i++.'</td>
					<td>&nbsp;'.ucfirst($row->customerName).'</td>
					<td>&nbsp;'.strip_tags($row->address).','.$row->districtName.'</td>
					<td>&nbsp;'.$row->phone.'</td>
					<td><a href="../Controllers/customers_controller.php?action=edit_customer&id='.$row->customerID.'"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; 
						<a href="../Controllers/customers_controller.php?action=delete_customer&id='.$row->customerID.'"><span class="glyphicon glyphicon-remove"></span></a></td>
				  </tr>';
			}
		  ?>
        </table>
</fieldset>
<?php
	return ob_get_clean();
?>