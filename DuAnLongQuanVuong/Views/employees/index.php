<?php
	ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#formAddEmployee").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
					manv: {
						required: "Vui lòng không để trống",
						minlength: " (Độ dài từ 3 ký tự trở lên)",
						maxLength:"Mã nhân viên chỉ có 15 ký tự"
					},
					tennv:{
						required: "Vui lòng không để trống",
						minlength: " (Độ dài từ 6 ký tự trở lên)",
						maxLength: "(Độ dài nhỏ hơn 50 ký tự)"
					},
					diachi:{
						required: "Vui lòng không để trống",
						minlength: " (Độ dài từ 10 ký tự trở lên)",
						maxLength: "(Độ dài nhỏ hơn 255 ký tự)"	
					},
					sdt:{
						required: "Vui lòng không để trống",
						phoneUK:"Chỉ được nhập 10 đến 11 số"
						
					}
				},
		rules:{
			sdt: {
			  required:true,
			  phoneUK:true,
			}
  		}	
	});
});
</script>
<fieldset>
    <legend style="80%;color: darkblue;"><b>Thêm nhân viên</b></legend>
        <form id="formAddEmployee" method="post" action="?action=add_employee" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-2">Mã nhân viên</div> 
                <div class="col-md-5"><input type="text" id="manv" name="manv" class="form-control" width="60%" 
                	required minLength='3' maxlength="15"/>
                    <label for="manv_error" class="form-error"></label>
                </div>
            </div>
             <div class="row" style="margin-top:2px">
                <div class="col-md-2">Tên nhân viên</div> 
                <div class="col-md-5"> <input type="text" id="tennv" name="tennv" class="form-control" width="60%" required minLength='6' maxlength="50"/>
                <label for="tennv_error" class="form-error"></label></div>
            </div>
             <div class="row" style="margin-top:2px">
                <div class="col-md-2">Địa chỉ</div> 
                <div class="col-md-5"> <textarea rows="4" cols="50" name="diachi" id="diachi" class="form-control" width="60%" required minLength='10' maxlength="255" ></textarea>
                <label for="diachi_error" class="form-error"></label></div>
            </div>
            <div class="row" style="margin-top:2px">
                <div class="col-md-2">Số điện thoại</div> 
                <div class="col-md-5"> <input id="sdt" name="sdt" type="text" class="form-control" width="60%" required />
                <label for="sdt_error" class="form-error"></label></div>
            </div>
            <div class="row" style="margin-top:2px">
                <div class="col-md-2">Hình ảnh</div> 
                <div class="col-md-5"> <input id="hinhanh" name="hinhanh" type="file" class="form-control" width="60%" />
                <div class="col-md-4"> <button type="submit" name="submit" class="btn" style="background-color:darkblue;color:#FFF"> Lưu </button> </div>
            </div>		
        </form>
</fieldset>
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
                    <td><img src="../Views/img/'.$row->hinhanh.'" width="30%"/></td>
					<td><a href="../Controllers/employees_controller.php?action=edit_employee&id='.$row->idEm.'"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; 
						<a href="../Controllers/employees_controller.php?action=delete_employee&id='.$row->idEm.'"><span class="glyphicon glyphicon-remove"></span></a></td>
				  </tr>';
			}
		  ?>
        </table>
</fieldset>
<?php
	return ob_get_clean();
?>