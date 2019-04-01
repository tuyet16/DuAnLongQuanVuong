<?php 
    ob_start();
?>
<script>
$().ready(function() {
    $("#district").on("change", function(){
        var phiship=$.ajax({
           url: '../Controllers/shoppingcart_controller.php?action=timphiship',
           method:'POST',
           data: {maquan:$(this).val()},
        });
        phiship.done(function(rs){
           phi = JSON.parse(rs);
           $('#shipfee').text(phi['phiship']).css('color','blue');
           phiship1 = phi['phiship'].replace(/,/g,'');
           $('#tienship').val(phiship1);
        });
    });
	// validate the form when it is submitted
	var validator = $("#formNhanShip").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error ).css('color','red');
		},
		errorElement: "span",
		messages: {
					tenshop:{
						required: "Vui lòng không để trống"
					},
					diachishop:{
						required: "Vui lòng không để trống"
					},
					dienthoaishop:{
						required: "Vui lòng không để trống",
                        phoneUK:"Chỉ được nhập 10 đến 11 số"
					},
                    tennguoinhan:{
						required: "Vui lòng không để trống"
					},
                    diachinguoinhan:{
						required: "Vui lòng không để trống"
					},
                    dienthoainguoinhan:{
						required: "Vui lòng không để trống"
					},
                    tienhang:{
						required: "Vui lòng không để trống"
					},
				},
		rules:{
			tenshop:{
				required: true
			},	
            diachishop:{
                required: true
            },
			dienthoaishop:{
				required:true,
				phoneUK:true
			},
            tennguoinhan:{
				required: true
			},
            diachinguoinhan:{
				required: true
			},
            dienthoainguoinhan:{
				phoneUK: true
			},
            tienhang:{
				required: true
			}
  		}	
	});
});
</script>
<form class="form-horizontal" id="formNhanShip" method="post" action="?action=nhanhoadonship">
<div class="container-fluid" style="margin-top: 60px;">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h1 class="product-information">HÓA ĐƠN GIAO HÀNG</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h1 class="shop-title">Thông tin Shop</h1>
            
              <div class="form-group">
                <label class="control-label col-sm-2" for="tenshop">Tên shop:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="tenshop" 
                                    name="tenshop"
                                    placeholder="Nhập tên shop" required />
                  <label class="control-label" for="tenshop_error"></label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="shopdistrict">Quận:</label>
                <div class="col-sm-10">
                    <select name="shopdistrict" id="shopdistrict">
                    <?php foreach($rsDistrict as $row):?>
                        <option value="<?php echo $row->districtID;?>"><?php echo $row->districtName;?></option>
                    <?php endforeach;?>
                    </select> 
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="diachishop">Địa chỉ:</label>
                <div class="col-sm-10"> 
                  <input type="text" class="form-control" id="diachishop"
                                    name="diachishop" 
                                    placeholder="Nhập địa chỉ của shop" required />
                  <label class="control-label" for="diachishop_error"></label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="dienthoaishop">Điện thoại:</label>
                <div class="col-sm-5"> 
                  <input type="text" class="form-control"
                                    name="dienthoaishop" 
                                    id="dienthoaishop" placeholder="Nhập điện thoại của shop" required />
                  <label class="control-label" for="dienthoaishop_error"></label>
                </div>
              </div>
              
            
        </div>
    
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h1 class="client-title">Thông tin người nhận</h1>
        
        <div class="form-group">
                <label class="control-label col-sm-2" for="tennguoinhan">Họ tên người nhận:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control"
                                    name="tennguoinhan" 
                                    id="tennguoinhan" placeholder="Nhập họ tên người nhận" required />
                  <label class="control-label" for="tennguoinhan_error"></label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="district">Quận:</label>
                <div class="col-sm-10">
                    <select name="district" id="district">
                    <?php foreach($rsDistrict as $row):?>
                        <option value="<?php echo $row->districtID;?>"><?php echo $row->districtName;?></option>
                    <?php endforeach;?>
                    </select> 
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="diachinguoinhan">Địa chỉ:</label>
                <div class="col-sm-10"> 
                  <input type="text" class="form-control" id="diachinguoinhan"
                                    name="diachinguoinhan" 
                                    placeholder="Nhập địa chỉ của người nhận" required/>
                  <label class="control-label" for="diachinguoinhan_error"></label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="dienthoainguoinhan">Điện thoại:</label>
                <div class="col-sm-5"> 
                  <input type="text" class="form-control"
                                     name="dienthoainguoinhan"
                                    id="dienthoainguoinhan" 
                                    placeholder="Nhập điện thoại của người nhận" required />
                  <label class="control-label" for="dienthoainguoinhan_error"></label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="tienhang">Tiền hàng:</label>
                <div class="col-sm-5"> 
                  <input type="text" class="form-control" id="tienhang"
                                        name="tienhang" 
                                        placeholder="Nhập tiền hàng khách trả theo hóa đơn" required />
                  <label class="control-label" for="tienhang_error"></label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="tienhang">Yêu cầu riêng:</label>
                <div class="col-sm-5"> 
                  <input type="text" class="form-control" id="customer_require"
                                        name="customer_require" 
                                        placeholder="Nhập yêu cầu riêng của hàng khách (VD: giao hàng lúc mấy giờ)"/>
                  <label class="control-label" for="customer_require_error"></label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="phiship">Phí ship:</label>
                <div class="col-sm-5"> 
                  <input type="hidden" name="tienship" id="tienship" value="0" />
                  <p id="shipfee"></p>
                </div>
              </div>
              <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" name="submit" class="btn btn-primary">Gởi đơn hàng</button>
                </div>
              </div>
        </div>
    </div>
    
    
</div>
</form> 
<?php
    return ob_get_clean();
?>