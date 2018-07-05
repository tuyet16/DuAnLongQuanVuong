<?php
	ob_start();
?>
 <script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#quan").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
            tenquan: {
				required: " (Không được để trống)"
		   }
            }
	});
});
</script>

    	<fieldset>
        	<legend style="80%">Thêm Quận</legend>
                <form method="post" action="?action=edit" id="quan">
                <input type="hidden" name="id" value="<?php echo $district[0]->districtID; ?>" />
                     <div class="row"  style="margin-top:2px">                     
                    	<div class="col-md-2">Tên Quận </div> 
                       	<div class="col-md-3"> 
                           <input type="text" name="tenquan" id="tenquan" value="<?php echo $district[0]->districtName; ?>" class="form-control" width="80%" required/>
                        </div> 
                        <label for="tenquan_error" class="form-error" style="color: red;"></label>
                    </div>
                    <textarea class="form-control"><?php echo $district[0]->districtName; ?></textarea>
                     <div class="row"  style="margin-top:4px;margin-left:17%">
                        	<button type="submit" name="submit" class="btn" style="background-color:darkblue;color:#FFF"/> Lưu
                    </div>
                </form>
        </fieldset>
        <fieldset>
        	<legend>Danh sách Quận</legend>
                <table class="table table-bordered table-striped" width="80%">
                  <tr style="background-color:darkblue;color:#FFF">
                    <td>&nbsp;STT</td>
                     <td>&nbsp; Tên Quận</td>
                    <td>&nbsp; Thao tác</td>
                  </tr>
                  <?php $i=1; foreach($DSdistrict as $row){  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo ucfirst($row->districtName); ?></td>
                    <td><a href="../Controllers/districts_controller.php?action=edit&id=<?php echo $row->districtID; ?>">
                        <span class="glyphicon glyphicon-pencil"></span></a> &nbsp; 
                        <a href="../Controllers/districts_controller.php?action=delete&id=<?php echo $row->districtID; ?>">
                        <span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
        </fieldset>
<?php
	return ob_get_clean();
?>