<?php
	ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#formEditWard").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			ward_name: {
				required: " (Không được để trống)",
				minlength: " (Độ dài từ 3 ký tự trở lên)"
			}
		}
	});

	$(".cancel").click(function() {
		validator.resetForm();
	});
});
</script>
<fieldset>
    <legend style="80%">Sửa Phường</legend>
            <form id="formEditWard" method="post" action="?action=edit_ward">
            	<input type="hidden" name="id_ward" value="<?php echo $WardByID[0]->wardID;?>"/>
                <div class="row">
                    <div class="col-md-2">Tên phường: </div> 
                    <div class="col-md-4"> 
                    	<input type="text" id="ward_name" name="ward_name" class="form-control"
                        value="<?php echo $WardByID[0]->wardName;?>" width="80%" required minlength="3"/>
                     	<label for="ward_name_error" class="form-error"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">Quận: </div> 
                    <div class="col-md-4"> 
                    	<select name="quan" id="quan" class="form-control">
                        	<?php
								$select = $WardByID[0]->districtID; 
								//echo "<option>".$select."</option>";
								 foreach($dsDistricts as $row){
									 if($row->districtID == $select)
										echo "<option name='optquan' value='".$row->districtID."' selected>".$row->districtName."</option>"; 
									else
										echo "<option name='optquan' value='".$row->districtID."'>".$row->districtName."</option>"; 
								}?>  
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn" style="background-color:darkblue;color:#FFF"/> Lưu
                    </div>
                </div>
            </form>
</fieldset>
<fieldset style="margin-top:2%">
    <legend>DANH SÁCH PHƯỜNG THEO QUẬN</legend>
    	<div class="row" style="margin-left:2%">
        	<div class="col-md-1"> Quận </div>
            <div class="col-md-3">
        	<select name="quan" id="quan" class="form-control">
            	<?php foreach($dsDistricts as $row){ 
						echo "<option value='".$row->districtID."'>".$row->districtName."</option>"; 
				}?> 
            </select>
            </div>
        </div>
        <div class="row" style="margin:2%">
        <table class="table table-bordered table-striped" width="80%">
          <tr style="background-color:darkblue;color:#FFF">
            <td>&nbsp;STT</td>
            <td>&nbsp; Tên Phường</td>
            <td>&nbsp; Thao tác</td>
          </tr>
     <?php
	 	$i=1;  
         foreach($dsWards as $row){    
             echo'<tr>
                <td>&nbsp; '.$i++.'</td>
                <td>&nbsp; '.$row->wardName.'</td>
                <td><a href="../Controllers/wards_controller.php?action=edit_ward&id='.$row->wardID.'"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Sửa"></span></a> 
                    &nbsp; <a href="../Controllers/wards_controller.php?action=delete_ward&id='.$row->wardID.'"><span class="glyphicon glyphicon-remove" title="Xóa"></span></a></td>
              </tr>';
         }
    ?>
        </table>
        </div>
</fieldset>
<?php
	return ob_get_clean();
?>