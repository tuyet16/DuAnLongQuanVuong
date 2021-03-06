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
        	<legend style="80%">Sửa Quận</legend>
                <form method="post" action="?action=edit" id="quan">
                <input type="hidden" name="id_dis" value="<?php echo $district[0]->districtID; ?>" />
                     <div class="row"  style="margin-top:2px">                     
                    	<div class="col-md-2">Tên Quận </div> 
                       	<div class="col-md-3"> 
                           <input type="text" name="tenquan" id="tenquan" value="<?php if(isset($_GET['id'])) echo $district[0]->districtName; ?>" class="form-control" width="80%" required/>
                       		  <label for="tenquan_error" class="form-error" style="color: red;"></label>
                        </div> 
                    </div>
                    <div class="row"  style="margin-top:2px">
                    	<div class="col-md-2">Khu vực </div> 
                       	<div class="col-md-3"> 
                        <select name="slKV" id="slKV" class="form-control" >
                        	<?php
								$select = $district[0]->areasID; 
								//echo "<option>".$select."</option>";
								 foreach($dsAreas as $row){
									 if($row->areasID == $select)
										echo "<option name='optquan' value='".$row->areasID."' selected>".$row->areasName."</option>"; 
									else
										echo "<option name='optquan' value='".$row->areasID."'>".$row->areasName."</option>"; 
								}?> 
                        </select>
                        </div>
                         <div class="col-md-1">
                        	<button type="submit" class="btn" style="background-color:darkblue;color:#FFF"> Lưu</button>
                    	</div>
                    </div>
                </form>
        </fieldset>
        <fieldset>
        	<legend>Danh sách Quận</legend>
                <table class="table table-bordered table-striped" width="80%">
                  <tr style="background-color:darkblue;color:#FFF">
                    <td>&nbsp;STT</td>
                    <td>&nbsp; Tên Quận</td>
                    <td>&nbsp; Khu vực</td>
                    <td>&nbsp; Thao tác</td>
                  </tr>
                  <?php $i=1; foreach($DSdistrict as $row){  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo ucfirst($row->districtName); ?></td>
                    <td><?php echo $row->areasID; ?></td>
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