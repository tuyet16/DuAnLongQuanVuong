<?php ob_start(); ?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#formChangePass").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			passOld: {
				required: " Không được để trống",
				//minlength: " Mật khẩu phải dài hơn 6 kí tự"
			},
			passNew: {
				required: " Không được để trống",
				minlength: " Mật khẩu phải dài hơn 8 kí tự"
			},
			passNewAgain: {
				required: " Không được để trống",
				minlength: " Mật khẩu phải dài hơn 8 kí tự",
				equalTo : 'Không khớp với mật khẩu mới'
			}
		},
		rules:{
			passOld: {
				required:true,
				//minlength: " Mật khẩu phải dài hơn 6 kí tự"
			},
			passNew: {
				required: true,
				minlength:8
			},
			passNewAgain: {
				required:true,
				minlength:8,
				equalTo : '[name="passNew"]'
			}
			
		}
	});

	$(".cancel").click(function() {
		validator.resetForm();
	});
});
</script>
<div class="row">
	<fieldset>
    	<legend><h2>Tạo mật khẩu mới</h2></legend>
        	<div style="padding-left:2%">
            	<form id="formChangePass" method="post" action="users_controller.php?action=changepass">
                	<input type="hidden" name="iduser" value="<?php echo $_SESSION['userid']; ?>"/>
                    <label class="form-error"><?php if(isset($_SESSION['error'])) 
														echo $_SESSION['error'];
													unset($_SESSION['error']); ?></label><br />
            		Mật khẩu hiện tại
                	<input type="password" id="passOld" name="passOld" class="form-control" style="width:45%;" required />
                    <label for="passOld_error" class="form-error" style="margin-bottom:2%"></label><br/>
                    Mật khẩu mới
                	<input type="password" id="passNew" name="passNew" class="form-control" style="width:45%;" required minlength="8"/>
                    <label for="passNew_error" class="form-error" style="margin-bottom:2%"></label><br/>
                    Nhập lại mật khẩu mới
                	<input type="password" id="passNewAgain" name="passNewAgain" class="form-control" style="width:45%;" required minlength="8"/>
                    <label for="passNewAgain_error" class="form-error"></label><br/>
             
             		<button type="submit" class="btn" style="background-color:darkblue;color:#FFF; margin-top:2%"> Cập nhật</button>
             	</form>
        	</div>
    </fieldset>
</div>
<?php return ob_get_clean(); ?>