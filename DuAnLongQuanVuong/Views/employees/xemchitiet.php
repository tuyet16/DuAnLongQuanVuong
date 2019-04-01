<?php
	ob_start();
?>
<style>
	.tble{
	border:3px #339999 solid;
	border-radius:5px;
	width:100%	
}
.cltable{
	padding-left:1%;	
}
</style>
<div class="row tble col-xs-12">
		<h2 style="text-align:center;color:#069"><b>Thông tin nhân viên</b></h2>
        <div class="col-md-3 col-xs-12">
        	<h3 class="text-center"> Ảnh đại diện</h3>
        	<img src="../Views/img/thumb/thumb_<?php echo $EmployeeByID[0]->hinhanh?>" width="100%" height="150px" style="border-radius:5px" />
        </div>
        <div class="col-md-9 col-xs-12 cl2" style="border-left:3px #339999 solid;margin-top:7%">
            	<table class="col-xs-12">
                	<tr>
                		<td><h4><i>Mã nhân viên </i></h4> </td>
                        <td class="cltable form-control"> <h4> <?php echo $EmployeeByID[0]->employeeID ?></h4></td>
                    </tr>
                    <tr>
                        <td ><h4><i>Họ và tên </i></h4> </td>
                        <td class="cltable form-control"><h4> <?php echo ucfirst($EmployeeByID[0]->employeeName)?></h4></td>
                    </tr>
                    <tr>
                        <td><h4><i>Địa chỉ </i></h4> </td>
                        <td class="cltable form-control"><h4><?php echo $EmployeeByID[0]->address ?></h4></td>
                     </tr>
                     <tr>
                         <td><h4><i>Số điện thoại </i></h4> </td>
                         <td class="cltable form-control"> <h4> <?php echo $EmployeeByID[0]->phone ?></h4></td>
                    </tr>
                </table>
        </div>
          
</div>
<div class="row col-xs-12">
<fieldset style="margin-top:2%">
    <legend>Danh sách nhân viên</legend>
        <table class="table table-bordered table-striped">
          <tr style="background-color: darkblue;color:#FFF">
            <td>&nbsp;STT</td>
            <td>&nbsp; Mã NV</td>
            <td>&nbsp; Tên NV</td>
            <td>&nbsp; Địa chỉ</td>
            <td>&nbsp; Số điện thoại</td>
            <td>&nbsp; Hình ảnh</td>
            <td>&nbsp; Thao tác</td>
          </tr>
         
          <?php
		  	$i=1;
				foreach($dsEmployees as $row){
					echo '<tr>
					<td>&nbsp;'.$i++.'</td>
					<td>&nbsp;'.$row->employeeID.'</td>
					<td>&nbsp;'.ucfirst($row->employeeName).'</td>
					<td>&nbsp;'.$row->address.'</td>
					<td>&nbsp;'.$row->phone.'</td>
                    <td style="width:35%"><img src="../Views/img/'.$row->hinhanh.'" width="30%"/></td>
					<td>
						<a href="../Controllers/employees_controller.php?action=xemchitiet&id='.$row->idEm.'"><span class="glyphicon glyphicon-list-alt" data-toggle="tooltip" title="Xem chi tiết"></span></a> &nbsp;
						<a href="../Controllers/employees_controller.php?action=edit_employee&id='.$row->idEm.'"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Sửa"></span></a> &nbsp; 
						<a href="../Controllers/employees_controller.php?action=delete_employee&id='.$row->idEm.'"><span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Xóa"></span></a></td>
				  </tr>';
			}
		  ?>
        </table>
</fieldset>
</div>
<?php
	return ob_get_clean();
?>