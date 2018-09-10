<?php
	ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#formAddCustomer").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error ); 
		},
		errorElement: "span",
		messages: {
					tenkh:{
						required: " (Không được để trống)",
						minlength: " (Độ dài từ 6 ký tự trở lên)",
						maxLength: "(Độ dài nhỏ hơn 50 ký tự)"
					},
					diachi:{
						required: " (Không được để trống)",
						minlength: " (Độ dài từ 10 ký tự trở lên)",
						maxLength: "(Độ dài nhỏ hơn 255 ký tự)"	
					},
					sdt:{
						required:"(Không được để trống)",
						minLength:"(Điện thoại phải có ít nhất 10 số)",
				  		maxLength: "(Điện thoại chỉ có 10-11 số",
						number:"(Không được nhập chữ)"
						
					}
				},
		rules:{
			sdt: {
			  required:true,
			  number:true,
			}
  		}	
	});
});
</script>
<fieldset>
    <legend style="80%;color: darkblue;"><b>Thông tin khách hàng</b></legend>
        <form id="formAddCustomer" method="post" action="?action=edit_customer">
        <input type="hidden" name="customerID" value="<?php echo $CustomerID[0]->customerID; ?>" />
            <div class="row">
                <div class="col-md-2">Tên Khách Hàng</div> 
                <div class="col-md-5"><input type="text" id="tenkh" name="tenkh" value="<?php echo $CustomerID[0]->customerName; ?>" class="form-control" width="60%" 
                	required minLength='6' maxlength="50"/>
                    <label for="tenkh_error" class="form-error"></label>
                </div>
            </div>
             <div class="row" style="margin-top:2px">
                <div class="col-md-2">Địa chỉ</div> 
                <div class="col-md-5">Quận 
                    <select id="maquan" name="maquan" class="form-control">
                        <?php foreach($dsDistrict as $row){
                            if($row->districtID == $CustomerID[0]->districtID){?>
        						<option value="<?php echo $row->districtID; ?>" selected="selected"><?php echo $row->districtName; ?></option>
                        <?php }
                        else
                        {?>
                            <option value="<?php echo $row->districtID; ?>"><?php echo $row->districtName; ?></option>
                        <?php }}?>
   				   </select>
                </div>
            </div>
             <div class="row" style="margin-top:4px">
             	<div class="col-md-2"></div> 
                <div class="col-md-5">Địa Chỉ
                    <textarea rows="4" cols="50" name="diachi" id="diachi" class="form-control"  required minLength='10' maxlength="255" >
                        <?php echo $CustomerID[0]->address; ?>
                    </textarea>
                <label for="diachi_error" class="form-error"></label></div>
                <div class="col-md-2"><h7><i>(<font color="#FF0000">*</font>) Lưu ý: Chỉ giao ở khu vực TPHCM</i></h7></div>
            </div>
            <div class="row" style="margin-top:2px">
                <div class="col-md-2">Số điện thoại</div> 
                <div class="col-md-5"> 
                    <input id="sdt" name="sdt" type="text" class="form-control" value="<?php echo $CustomerID[0]->phone; ?>" width="60%" required minLength='10' maxlength="11"/>
                <label for="sdt_error" class="form-error"></label></div>
                <div class="col-md-4"> <input type="submit" name="submit" class="btn btn-primary" value="Lưu"/> </div>
            </div>	
        </form>
</fieldset>


<?php
	return ob_get_clean();
?>