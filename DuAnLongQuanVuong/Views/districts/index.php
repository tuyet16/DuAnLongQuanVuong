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
			maquan: {
				required: " (Không được để trống)",
                },
            tenquan: {
				required: " (Không được để trống)"
		   }
            }
	});
});
</script>

    	<fieldset>
        	<legend style="80%">Thêm Quận</legend>
                <form method="post" action="" id="quan">
                    <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Mã Quận </div> 
                       	<div class="col-md-3"> 
                           <input type="text" name="maquan" id="maquan" class="form-control" width="80%" required/></div>
                        <label for="maquan_error" class="form-error"></label>
                    </div>
                     <div class="row"  style="margin-top:2px">
                    	<div class="col-md-2">Tên Quận </div> 
                       	<div class="col-md-3"> <input type="text" name="tenquan" id="tenquan" class="form-control" width="80%" required/></div> 
                        <label for="tenquan_error" class="form-error"></label>
                    </div>
                     <div class="row"  style="margin-top:4px;margin-left:17%">
                        	<button type="submit" class="btn" style="background-color:darkblue;color:#FFF"/> Lưu
                    </div>
                </form>
        </fieldset>
        <fieldset>
        	<legend>Danh sách Quận</legend>
                <table class="table table-bordered table-striped" width="80%">
                  <tr style="background-color:darkblue;color:#FFF">
                    <td>&nbsp;STT</td>
                    <td>&nbsp; Mã Quận</td>
                     <td>&nbsp; Tên Quận</td>
                    <td>&nbsp; Thao tác</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><a href="#"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; <a href="#"><span class="glyphicon glyphicon-remove"></span></a></td>
                  </tr>
                </table>
        </fieldset>
<?php
	return ob_get_clean();
?>