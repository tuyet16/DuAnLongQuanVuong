<?php
	ob_start();
?>
<script src="../js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#dt").keyup(function(){
           // alert($("#gh").val());
           var request= $.ajax({           
                url:"../Controllers/shoppingcart_controller.php?action=timkiem",
                method:'POST',
                data:{sdt: this.value,ghthuong: $("#gh").val()},
                dataType:'html'
            });
            request.done(function(a){
                //alert(a);
                tim = JSON.parse(a);               
                $('#hoten').val(tim['ten']);
                $('#dc').val(tim['diachi']);
                $('#quan').val(tim['quan']);
                $('#ps').text(tim['phiship']);
            });            
        });
    });
    
</script>

<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#signup").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
					dt:{
						required: "Vui lòng không để trống",
                        phoneUK:"Chỉ được nhập 10 đến 11 số"
					},
					hoten:{
						required: "Vui lòng không để trống",
					},
					dc:{
						required: "Vui lòng không để trống"
					}
				},
	});
});
</script>
<div class="container" style="margin-bottom: 50px;">
  <form method="post" action="?action=dathang">
  
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
         <legend style="color: RED;">THÔNG TIN NGƯỜI NHẬN</legend> 
            <div class="row">
                <label class="control-label">Điện thoại di động</label>
                <input type="text" name="dienthoai" id="dt" class="form-control" required="" />
            </div>
            <div class="row">
                <label class="control-label">Họ tên người nhận</label>
                <input type="text" name="hoten" id="hoten" class="form-control"  required="" />
            </div>
            <div class="row">
                <label class="control-label">Quận/Huyện</label>                
                <select name="quan" id="quan" class="form-control" >
                <?php foreach($DSdistrict as $row){ ?>
                    <option value="<?php echo $row->districtID; ?>"><?php echo $row->districtName; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="row">
                <label class="control-label">Địa chỉ</label>
                <input type="text" name="diachi" id="dc" class="form-control"  required="" />
            </div>
             <div class="row">
                <label class="control-label">Phương thức giao hàng</label>
                <select name="giaohang" id="gh" class="form-control">
                    <option value="0">Giao thường</option>
                    <option value="1">Giao nhanh</option>
                </select>
            </div>
            <div class="row">
                <label class="control-label">Phí Giao Hàng</label><br />
                <div class="col-md-3"><input type="radio" name="nguoitraship" value="0" checked="checked" /> Chủ Trả Phí</div>
               <div class="col-md-3"><input type="radio" name="nguoitraship" value="1"/> Khách Trả Phí</div>
               
            </div>
            <div class="row">
                <label class="control-label">Tổng Phí Ship</label>
                <div id="ps" style="color: red; font-weight: bold;"></div>
            </div>
        </div>
        <div class="col-md-2"></div>
        </div>
        
        <div class="row text-center" style="padding: 10px;">
            <input type="submit" class="btn btn-danger" value="ĐẶT HÀNG"/>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="border: 1px solid black;">
                <legend style="color:red;">THÔNG TIN ĐƠN HÀNG</legend>
    
                 <table class="table table-hover">
            <tr>
                <td>Sản Phẩm</td>
                <td>Số lượng</td>
                <td>Giá Thành</td>
                <td>Thành Tiền</td>
                <td>Phí Ship</td>
                <td></td>
            </tr>
            <?php foreach($rsCart as $row){ ?>            
            <tr>
                <td>
                    <div class="row">
                        <div class="col-md-3"><?php echo '<img src="../Views/img/'.$row['hinhanh'].'" width="60%"/>'; ?></div>
                        <div class="col-md-9"><?php echo $row['name']; ?></div>
                    </div>                
                </td>
                <td><label><?php echo $row['soluong']; ?></label></td>
                <td><?php echo number_format($row['gia']); ?></td>
                <td><?php echo number_format($row['thanhtien']); ?></td>
                <td><?php echo number_format($row['thanhtien']); ?></td>
                
            </tr>
            <?php }?>
            <tr>
                <td colspan="3" class="text-right" style="color: red; font-weight: bold;">Tổng tiền</td>
                <td style="color: blue; font-weight: bold;"><?php echo number_format($tongtien);?></td>
            </tr>   
                
                
        </table>
            <div class="col-md-2"></div>
        </div>
    </form>
</div>

<?php
	return ob_get_clean();
?>