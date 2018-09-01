<?php
	ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#formAddUnit").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			ten: {
				required: " (Không được để trống)"
			},
			unit_name: {
				required: " (Không được để trống)"
			}
		}
	});

	$(".cancel").click(function() {
		validator.resetForm();
	});
});
</script>
<fieldset>
    <legend style="80%">Đơn Vị Tính</legend>
            <form id="formAddUnit" method="post" action="?action=add_unit">
                <div class="row">
                    <div class="col-md-2">Tên Đơn Vị </div> 
                    <div class="col-md-4"> 
                    	<input type="text" id="ten" name="ten" class="form-control" width="80%" required/>
                     	<label for="ten_error" class="form-error"></label>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-2"></div> 
                    <div class="col-md-4"> 
                    	<input type="submit" name="submit" class="btn btn-primary" value="Lưu"/>
                    </div> 
</fieldset>
<fieldset style="margin-top:2%">
    <legend>Đơn Vị Tính</legend>
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
                     <a href="../Controllers/units_controller.php?action=delete_unit&id='.$row->unitID.'"><span class="glyphicon glyphicon-remove" title="Xóa"></span></a></td><tr>';
                }
    ?>
<?php
	return ob_get_clean();
?>