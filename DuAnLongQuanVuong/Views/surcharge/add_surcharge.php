<?php
	ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#formAddSurcharge").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			txtname: {
				required: " (Không được để trống)"
			},
			surcharge:{
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
    <legend style="80%">Phí ship phụ thu</legend>
            <form id="formAddSurcharge" method="post" action="?action=add_surcharge">
                <div class="row">
                    <div class="col-md-2">Loại phí</div> 
                    <div class="col-md-4"> 
                    	<input type="text" id="txtname" name="txtname" class="form-control" width="80%" required/>
                     	<label for="txtname_error" class="form-error"></label>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-2">Nội dung</div> 
                    <div class="col-md-4"> 
                    	<input type="text" id="surcharge" name="surcharge" class="form-control" width="80%" required/>
                     	<label for="surcharge_error" class="form-error"></label>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn" style="background-color:darkblue;color:#FFF"> Lưu</button>
                    </div>
                </div>
            </form>
</fieldset>
<fieldset style="margin-top:2%">
    <legend>Danh sách phí ship phụ thu</legend>
        <table class="table table-bordered table-striped" width="80%">
        <tr style="background-color:darkblue;color:#FFF">
            <td>STT</td>
            <td>&nbsp; Loại phí</td>
            <td>&nbsp; Nội dung</td>
            <td>Thao tác</td>
      </tr>
		 <?php  
            $i=1;
             foreach($dsSurcharge as $row){    
                 echo'<tr>
                    <td>&nbsp; '.$i++.'</td>
                    <td>&nbsp; '.$row->surchargeName.'</td>
                    <td>&nbsp; '.$row->content.'</td>
                    <td><a href="../Controllers/surcharge_controller.php?action=edit_surcharge&id='.$row->surchargeID.'"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Sửa"></span></a> 
                        &nbsp; <a href="../Controllers/surcharge_controller.php?action=delete_surcharge&id='.$row->surchargeID.'"><span class="glyphicon glyphicon-remove" title="Xóa"></span></a></td>
                  </tr>';
             }
        ?>
        </table>
</fieldset>
<?php
	return ob_get_clean();
?>