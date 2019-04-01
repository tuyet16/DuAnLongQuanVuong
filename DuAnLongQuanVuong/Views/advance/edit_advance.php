<?php
	ob_start();
?><?php
	ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#formEditAdvance").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			money: {
				required: " (Không được để trống)"
			},
			advance:{
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
    <legend style="80%">Phí ứng trước của chủ hàng</legend>
            <form id="formEditAdvance" method="post" action="?action=edit_advance">
            	<input type="hidden" name="adID" value="<?php echo $AdByID[0]->advanceID; ?>"/>
                <div class="row">
                    <div class="col-md-2">Số tiền </div> 
                    <div class="col-md-4"> 
                    	<input type="text" id="money" name="money" value="<?php echo $AdByID[0]->money ?>" class="form-control" width="80%" required/>
                     	<label for="money_error" class="form-error"></label>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-2">Phí ứng tiền</div> 
                    <div class="col-md-4"> 
                    	<input type="number" id="advance" name="advance" value="<?php echo $AdByID[0]->advanceName ?>" class="form-control" width="80%" required/>
                     	<label for="advance_error" class="form-error"></label>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn" style="background-color:darkblue;color:#FFF"> Lưu</button>
                    </div>
                </div>
            </form>
</fieldset>
<fieldset style="margin-top:2%">
    <legend>Danh sách phí ứng trước</legend>
        <table class="table table-bordered table-striped" width="80%">
          <tr style="background-color:darkblue;color:#FFF">
            <td>&nbsp;STT</td>
            <td>&nbsp; Số tiền</td>
             <td>&nbsp; Phí ứng tiền</td>
            <td>&nbsp; Thao tác</td>
          </tr>
     <?php  
	 	$i=1;
         foreach($dsAdvance as $row){    
             echo'<tr>
			 	<td>&nbsp; '.$i++.'</td>
                <td>&nbsp; '.$row->money.'</td>
                <td>&nbsp; '.$row->advanceName.' VNĐ</td>
                <td><a href="../Controllers/advance_controller.php?action=edit_advance&id='.$row->advanceID.'"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Sửa"></span></a> 
                    &nbsp; <a href="../Controllers/advance_controller.php?action=delete_advance&id='.$row->advanceID.'"><span class="glyphicon glyphicon-remove" title="Xóa"></span></a></td>
              </tr>';
         }
    ?>
        </table>
</fieldset>
<?php
	return ob_get_clean();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#formAddAdvance").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			money: {
				required: " (Không được để trống)"
			},
			advance:{
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
    <legend style="80%">Phí ứng trước của chủ hàng</legend>
            <form id="formAddAdvance" method="post" action="?action=edit_advance">
                <div class="row">
                    <div class="col-md-2">Số tiền </div> 
                    <div class="col-md-4"> 
                    	<input type="number" id="money" name="money" class="form-control" width="80%" value="<?php echo ""; ?>" required/>
                     	<label for="money_error" class="form-error"></label>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-2">Phí ứng tiền</div> 
                    <div class="col-md-4"> 
                    	<input type="number" id="advance" name="advance" class="form-control" width="80%" required/>
                     	<label for="advance_error" class="form-error"></label>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn" style="background-color:darkblue;color:#FFF"/> Lưu
                    </div>
                </div>
            </form>
</fieldset>
<fieldset style="margin-top:2%">
    <legend>Danh sách phí ứng trước</legend>
        <table class="table table-bordered table-striped" width="80%">
          <tr style="background-color:darkblue;color:#FFF">
            <td>&nbsp;STT</td>
            <td>&nbsp; Số tiền</td>
             <td>&nbsp; Phí ứng tiền</td>
            <td>&nbsp; Thao tác</td>
          </tr>
     <?php  
	 	$i=1;
         foreach($dsAdvances as $row){    
             echo'<tr>
			 	<td>&nbsp; '.$i++.'</td>
                <td>&nbsp; '.$row->money.'</td>
                <td>&nbsp; '.$row->advanceName.'</td>
                <td><a href="../Controllers/advance_controller.php?action=edit_advance&id='.$row->advanceID.'"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Sửa loại sản phẩm"></span></a> 
                    &nbsp; <a href="../Controllers/advance_controller.php?action=delete_advance&id='.$row->advanceID.'"><span class="glyphicon glyphicon-remove" title="Xóa loại sản phẩm"></span></a></td>
              </tr>';
         }
    ?>
        </table>
</fieldset>
<?php
	return ob_get_clean();
?>