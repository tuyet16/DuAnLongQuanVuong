<?php
	ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#formEditCate").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			category_name: {
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
<legend style="80%">Sửa loại sản phẩm</legend>
<?php
        foreach($CateByID as $row){
?>
         <form id="formEditCate" method="post" action="?action=<?php echo $_GET['action'];?>">
            <input type="hidden" name="category_id" value="<?php echo $row->categoryID?>" />
            <div class="row">
                <div class="col-md-2">Tên loại sản phẩm: </div> 
                <div class="col-md-4"> 
                	<input type="text" id="category_name" name="category_name" class="form-control" width="80%" value="<?php echo $row->categoryName?>" required minlength="3"/>
                    <label for="category_name_error" class="form-error"></label>
               	</div>
                <div class="col-md-6">
                    <button type="submit" class="btn" style="background-color:darkblue;color:#FFF"/> Lưu
                </div>
            </div>
        </form>
<?php
		}
?>
</fieldset>
<fieldset style="margin-top:2%">
    <legend><div class="col-md-4">Danh sách loại sản phẩm</div>
    		<div class="col-md-8 text-right">
            	<a href="../Controllers/categories_controller.php?action=index"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm mới</a>
            </div>
  </legend>
        <table class="table table-bordered table-striped" width="80%">
          <tr style="background-color:darkblue;color:#FFF">
            <td>&nbsp;STT</td>
            <td>&nbsp; Tên loại sản phẩm</td>
            <td>&nbsp; Thao tác</td>
          </tr>
     <?php  
         foreach($dsCategories as $row){    
             echo'<tr>
                <td>&nbsp; '.$row->categoryID.'</td>
                <td>&nbsp; '.$row->categoryName.'</td>
                <td><a href="../Controllers/categories_controller.php?action=edit_category&id='.$row->categoryID.'"><span class="glyphicon glyphicon-pencil"></span></a> 
                    &nbsp;<a href="../Controllers/categories_controller.php?action=delete_category&id='.$row->categoryID.'"><span class="glyphicon glyphicon-remove"></span></a></td>
              </tr>';
         }
    ?>
        </table>
</fieldset>

<?php
	return ob_get_clean();
?>