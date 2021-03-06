<?php
	ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#formAddAreas").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			areas_name: {
				required: "Vui lòng không để trống",
				min:" Vui lòng nhập giá trị bằng 1 hoặc lớn hơn 1",
				//max:"Số lớn nhất 20"
			},
			sokm:{
				required: "Vui lòng không để trống",
				min:" Vui lòng nhập giá trị bằng 1 hoặc lớn hơn 1",
				//max:"Số lớn nhất 999"
			},
			often:{
				required: "Vui lòng không để trống",
				min:" Số tiền phải lớn hơn hoặc bằng 1000",
				range:"Số tiền nhập từ 1000 và nhỏ hơn 1 tỷ",
				//max:"Số lớn nhất 999"
			},
			fast:{
				required: "Vui lòng không để trống",
				min:" Số tiền phải lớn hơn hoặc bằng 1000",
				range:" Số tiền nhập từ 1000 và nhỏ hơn 1 tỷ",
				//max:"Số lớn nhất 999"
			}
		},
		rules:{
			areas_name: {
				required:true
			},
			sokm: {
			 min:1
			},
			often: {
			  min:1,
			 range:[1000,1000000000]
			},
			fast: {
			  min:1,
			  range:[1000,1000000000]
			}
  		}	
	});

	$(".cancel").click(function() {
		validator.resetForm();
	});
});
</script>
<fieldset>
    <legend style="80%">Sửa khu vực</legend>
        <form id="formEditAreas" method="post" action="?action=edit_areas">
        <input type="hidden" name="id_areas" value="<?php echo $AreasByID[0]->areasID ?>"/>
            <div class="row">
                <div class="col-md-2 text-right">Mã khu vực: </div> 
                <div class="col-md-4"> 
                    <input type="text" id="areas_name" name="areas_name" value="<?php echo $AreasByID[0]->areasName ?>" class="form-control" width="80%" required/>
                    <label for="areas_name_error" class="form-error"></label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-right">Số Km vượt quá: </div> 
                <div class="col-md-4"> 
                    <input type="text" id="sokm" name="sokm" value="<?php echo $AreasByID[0]->km ?>" class="form-control" width="80%" required/>
                    <label for="sokm_error" class="form-error"></label>
                </div>
            </div>
             <div class="row">
                <div class="col-md-2 text-right">Giá giao thường </div> 
                <div class="col-md-4"> 
                    <input type="text" id="often" name="often" value="<?php echo $AreasByID[0]->often ?>" class="form-control" width="80%"  required />
                    <label for="often_error" class="form-error"></label>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-2 text-right">Giá giao nhanh </div> 
                <div class="col-md-4"> 
                    <input type="text" id="fast" name="fast" class="form-control" value="<?php echo $AreasByID[0]->fast?>" width="80%" required/>
                    <label for="fast_error" class="form-error"></label>
                </div>
                <div class="col-md-4"> 
                   <button type="submit" class="btn" style="background-color:darkblue;color:#FFF">Lưu</button>
                </div>
            </div>
        </form>
</fieldset>
<fieldset style="margin-top:2%">
    <legend style="width:97%"><div class="col-md-4">DANH SÁCH KHU VỰC</div>
    		<div class="col-md-8 text-right"><a href="../Controllers/areas_controller.php"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></div></legend>
        <div class="row" style="margin:2%">
        <table class="table table-bordered table-striped" width="80%">
          <tr style="background-color:darkblue;color:#FFF">
            <td>&nbsp;STT</td>
            <td>&nbsp;	Mã khu vực</td>
            <td>&nbsp; Số Km vượt quá</td>
            <td>&nbsp; Giá giao thường</td>
            <td>&nbsp; Giá giao nhanh</td>
            <td>&nbsp; Thao tác</td>
          </tr>
     <?php
	 	$i=1;  
         foreach($dsAreas as $row){    
             echo'<tr>
                <td>&nbsp; '.$i++.'</td>
                <td>&nbsp; '.$row->areasName.'</td>
				 <td>&nbsp; '.$row->km.'Km</td>
				 <td>&nbsp; '.$row->often.' VNĐ</td>
				 <td>&nbsp; '.$row->fast.' VNĐ</td>
                <td><a href="../Controllers/areas_controller.php?action=edit_areas&id='.$row->areasID.'"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Sửa"></span></a> 
                    &nbsp; <a href="../Controllers/areas_controller.php?action=delete_areas&id='.$row->areasID.'"><span class="glyphicon glyphicon-remove" title="Xóa"></span></a></td>
              </tr>';
         }
    ?>
        </table>
        </div>
</fieldset>
<?php
	return ob_get_clean();
?>