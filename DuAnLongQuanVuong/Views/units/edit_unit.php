<?php
	ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
<<<<<<< HEAD
	var validator = $("#formAddUnit").validate({
=======
	var validator = $("#formEditUnit").validate({
>>>>>>> ffdaddfe9c46bbf0240bb60b008339356d3de549
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
<<<<<<< HEAD
			ten: {
				required: " (Không được để trống)"
			},
=======
			unit_name: {
				required: " (Không được để trống)"
			}
>>>>>>> ffdaddfe9c46bbf0240bb60b008339356d3de549
		}
	});

	$(".cancel").click(function() {
		validator.resetForm();
	});
});
</script>
<fieldset>
<<<<<<< HEAD
    <legend style="80%">Phí ứng trước của chủ hàng</legend>
            <form id="formAddUnit" method="post" action="?action=edit_unit">
            <input type="hidden" name="id" value="<?php echo $rsUnit[0]->unitID; ?>" />
                <div class="row">
                    <div class="col-md-2">Tên Đơn Vị </div> 
                    <div class="col-md-4"> 
                    	<input type="text" id="ten" name="ten" value="<?php echo $rsUnit[0]->unitName; ?>" class="form-control" width="80%" required/>
                     	<label for="ten_error" class="form-error"></label>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-2"></div> 
                    <div class="col-md-4"> 
                    	<input type="submit" name="submit" class="btn btn-primary" value="Lưu"/>
                    </div> 
=======
    <legend style="80%">Sửa đơn vị tính</legend>
            <form id="formEditUnit" method="post" action="?action=edit_unit">
            <input type="hidden" name="unitID" value="<?php echo $UnitByID[0]->unitID; ?>" />
                <div class="row">
                    <div class="col-md-2">Đơn vị tính </div> 
                    <div class="col-md-4"> 
                    	<input type="text" id="unit_name" name="unit_name" class="form-control" width="80%" 
                        	value="<?php echo $UnitByID[0]->unitName; ?>"  required />
                     	<label for="unit_name_error" class="form-error"></label>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn" style="background-color:darkblue;color:#FFF"/> Lưu
                    </div>
>>>>>>> ffdaddfe9c46bbf0240bb60b008339356d3de549
                </div>
            </form>
</fieldset>
<fieldset style="margin-top:2%">
<<<<<<< HEAD
    <legend>Danh sách phí ứng trước</legend>
        <table class="table table-bordered table-striped" width="80%">
          <tr style="background-color:darkblue;color:#FFF">
            <td>&nbsp;STT</td>
            <td>&nbsp; Tên Đơn Vị</td>
            <td>&nbsp; </td>
            
          </tr>
     <?php  
	 	$i=1;
         foreach($dsUnit as $row){    
             echo'<tr>
			 	<td>&nbsp; '.$i++.'</td>
                <td>&nbsp; '.$row->unitName.'</td>
                <td><a href="../Controllers/units_controller.php?action=edit_unit&id='.$row->unitID.'"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Sửa"></span></a> 
                     <a href="../Controllers/units_controller.php?action=delete_unit&id='.$row->unitID.'"><span class="glyphicon glyphicon-remove" title="Xóa"></span></a></td>
=======
    <legend>Các loại đơn vị tính</legend>
        <table class="table table-bordered table-striped" width="80%">
          <tr style="background-color:darkblue;color:#FFF">
            <td>&nbsp;STT</td>
            <td>&nbsp; Đơn vị tính</td>
            <td>&nbsp; Thao tác</td>
          </tr>
     <?php  
         foreach($dsUnit as $row){    
             echo'<tr>
                <td>&nbsp; '.$row->unitID.'</td>
                <td>&nbsp; '.$row->unitName.'</td>
                <td><a href="../Controllers/units_controller.php?action=edit_unit&id='.$row->unitID.'">
					<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Sửa"></span></a> 
                    &nbsp; <a href="../Controllers/units_controller.php?action=delete_unit&id='.$row->unitID.'">
					<span class="glyphicon glyphicon-remove" title="Xóa"></span></a>
				</td>
>>>>>>> ffdaddfe9c46bbf0240bb60b008339356d3de549
              </tr>';
         }
    ?>
        </table>
</fieldset>
<?php
	return ob_get_clean();
?>