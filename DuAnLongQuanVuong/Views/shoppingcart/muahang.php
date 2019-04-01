<?php
	ob_start();
?>
<script src="../js/jquery.min.js"></script>
<script>
    
    
    $(document).ready(function(){
        function calcShipFee()
        {
        var phiship = $.ajax({
                url: "../Controllers/shoppingcart_controller.php?action=timphiship",
                method: 'POST',
                data:{maquan: $('#quan').val()},
                dataType : 'html'
           });
           phiship.done(function(rs){
                phi = JSON.parse(rs);
                $('#ps').text(phi['phiship']);
                tongtien = parseInt($('#tongtien').text().replace(/,/g,''));
                phiship = parseInt(phi['phiship'].replace(/,/g,''));
                tongcong = tongtien + phiship;
                $('#tc').text(tongcong.toLocaleString('en'));                
           }); 
        }
        calcShipFee();
        $("#dt").on('paste keyup',function(){
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
                    $('#tongtien').text(tim['tongtien']);
                    tongtien = parseInt(tim['tongtien'].replace(/,/g,''));
                    phiship = parseInt(tim['phiship'].replace(/,/g,''));
                    tc = phiship + tongtien;
                    $('#tc').text(tc.toLocaleString('en'));
            });            
        });
        $('#quan').change(function(){
           var phiship = $.ajax({
                url: "../Controllers/shoppingcart_controller.php?action=timphiship",
                method: 'POST',
                data:{maquan: this.value},
                dataType : 'html'
           });
           phiship.done(function(rs){
                phi = JSON.parse(rs);
                $('#ps').text(phi['phiship']);
                tongtien = parseInt($('#tongtien').text().split(',').join(''));
                phiship = parseInt(phi['phiship'].split(',').join(''));
                tongcong = tongtien + phiship;
                
                $('#tc').text(tongcong.toLocaleString('en'));                
           }); 
        });
    });
</script>

<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#muahang").validate({
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
					},
                    quan:{
                        required: "Vui lòng chọn quận để giao"
                    }
				},
	});
});
</script>
<div class="container-fluid" style="margin: 80px 0;">
    <div class="row">
        <div class="col-xs-12 col-sm-5 col-md-5" style="padding: 0 50px;">
            <h3 style="color: red;">THÔNG TIN NGƯỜI NHẬN</h3>
            <form method="post" action="?action=dathang" id="muahang" class="form-horizontal">
            <div class="row">
                <label class="control-label">Điện thoại di động</label>
                <input type="text" name="dienthoai" id="dt" class="form-control" required="" />
                <label for="dt_error" class="form-error"></label>
            </div>
            <div class="row">
                <label class="control-label">Họ tên người nhận</label>
                <input type="text" name="hoten" id="hoten" class="form-control"  required="" />
                <label for="hoten_error" class="form-error"></label>
            </div>
            <div class="row">
                <label class="control-label">Quận/Huyện</label>                
                <select name="quan" id="quan" class="form-control">
                <?php foreach($DSdistrict as $row){ ?>
                    <option value="<?php echo $row->districtID; ?>"><?php echo $row->districtName; ?></option>
                <?php } ?>
                </select>
                <label for="quan_error" class="form-error"></label>
            </div>
            <div class="row">
                <label class="control-label">Địa chỉ</label>
                <input type="text" name="diachi" id="dc" class="form-control"  required="" />
                <label for="dc_error" class="form-error"></label>
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
                <div class="col-xs-6 col-md-6"><input type="radio" name="nguoitraship" value="0" checked="checked" /> Chủ Trả Phí</div>
                <div class="col-xs-6 col-md-6"><input type="radio" name="nguoitraship" value="1"/> Khách Trả Phí</div>
            </div>
            <div class="row text-center" style="padding: 10px;">
                <input type="submit" class="btn btn-danger" value="ĐẶT HÀNG" style="background-color: #FE840E;"/>
            </div>
            </form>
        </div>
        
        <div class="col-xs-12 col-sm-7">
            <h3 style="color:red;">THÔNG TIN ĐƠN HÀNG</h3>
    
           <table class="table table-bordered">
                <tr class="undelivery">
                    <th>#</th>
                    <th colspan="2">Sản Phẩm</th>
                    <th>Giá Thành</th>
                    <th>Số lượng</th>
                    <th>Thành Tiền</th>
                </tr>
            <?php $index=0;
             foreach($rsCart as $row){ ?>            
            <tr>
                <td><?php echo ++$index;?></td>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-3"><?php echo '<img src="../Views/img/thumb/x_small_'.$row['hinhanh'].'" width="60%"/>'; ?></div>
                        <div class="col-md-9"><?php echo $row['name']; ?></div>
                    </div>                
                </td>
                <td class="text-center"><?php echo number_format($row['gia']); ?></td>
                <td class="text-center"><label><?php echo $row['soluong']; ?></label></td>
                <td class="text-right"><?php echo number_format($row['thanhtien']); ?></td>
                
            </tr>
            <?php }?>
            <tr>
                <td colspan="5" class="text-right" style="color: red; font-weight: bold;">Tổng tiền</td>
                <td style="color: blue; font-weight: bold;text-align: right;">
                    <div id="tongtien"><?php echo number_format($tongtien);?></div>
                </td>
            </tr>   
            <tr>
                <td colspan="5" class="text-right" style="color: red; font-weight: bold;">Phí Ship</td>
                <td style="color: blue; font-weight: bold;text-align: right;"><div id="ps"></td>
            </tr>
            <tr>
                <td colspan="5" class="text-right" style="color: red; font-weight: bold;">Tổng Cộng</td>
                <td style="color: blue; font-weight: bold;text-align: right;"><div id="tc"></td>
            </tr>
            </table>
        </div>
    </div>
</div>

<?php
	return ob_get_clean();
?>