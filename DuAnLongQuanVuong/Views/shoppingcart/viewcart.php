<?php ob_start();?>

<div class="most-view-product" style="margin: 20px;">
    <div class="row text-center" style="margin: 60px 0 20px 0;">
        <div class="col-xs-12">
            <h1>GIỎ HÀNG : <span class="label label-default" id="tongcong"><?php echo number_format($tongtien);?> đ</span></h1>
        </div>
    </div>
    <form method="post" id="cart" action="?action=updatecart" class="form-horizontal">
    <div class="row">
        <div class="panel-group">
        <?php $index = 0;
        foreach($rsCart as $item): ?>
        <div class="col-xs-12 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center" style="background-color: #FE840E; color: #fff;"><h3>#<?php echo ++$index;?></h3></div>
                <div class="panel-body">
                    <img src="../Views/img/<?php echo $item['hinhanh'];?>" width="100%" height="250px" />
                    <h5><?php echo $item['name'];?></h5>
                    
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="gia">Giá : </label>
                            <div class="col-sm-7">
                                <label class="form-control-static"><?php echo number_format($item['gia']);?> đ</label>
                            </div>
                        </div>
                    <div class="form-group">
                            <label class="control-label col-sm-5" for="gia">Số Lượng : </label>
                            <div class="col-sm-7">
                                <input  type="text" class="form-control" 
                                        name="<?php echo $item['masp'];?>" 
                                        value="<?php echo number_format($item['soluong']);?>" required=""/>
                                <label for="<?php echo $item['masp'];?>_error" class="form-error"></label>
                            </div>
                        </div>
                    <div class="form-group">
                            <label class="control-label col-sm-5" for="gia">Thành Tiền : </label>
                            <div class="col-sm-7">
                                <label id="total<?php echo $item['masp'];?>"
                                        class="form-control-static" 
                                        style="color: #00f;">
                                    <?php echo number_format($item['thanhtien']);?> đ
                                </label>
                            </div>
                        </div>
                </div>
                <div class="panel-footer text-center" >
                    <a href="?action=deletecart&id=<?php echo $item['masp'];?>" style="color:  #fff;" 
                        class="btn btn-danger">Xóa</a>
                    <a href="?action=muahang" style="color:  #fff;" 
                        class="btn btn-primary">Đặt Hàng</a>
                </div>
            </div>  
        </div>
        <?php endforeach;?>
        </div>
    </div>
    </form>
</div>
<script src="../js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        textArr = $('#cart input[type=text]');
        textArr.each(function(index){
            $(this).on("change paste keyup", function(){
                name = '#total' + $(this).attr('name');
                reg = /^\d{1,2}$/;
                url = $('.btn btn-primary').attr('href');
                if(!reg.test($(this).val())){
                    $('label[for=' + $(this).attr('name') + '_error]').text("Chỉ nhận giá trị từ 1 đến 50");
                    $(name).text("0");
                    $('.btn btn-primary').attr('disabled', 'disabled');
                    $('.btn btn-primary').off('click');
                    $('.btn btn-primary').attr('href', '#');
                } 
                else{
                    $('label[for=' + $(this).attr('name') + '_error]').text("");
                    changeQuantity = $.ajax({
                        url: "../Controllers/shoppingcart_controller.php?action=changequantity",
                        method: 'POST',
                        data:{productID: $(this).attr('name'), quantity: $(this).val()},
                        dataType: 'html'
                    });
                    changeQuantity.done(function(rs){
                        newPrice = JSON.parse(rs);
                        $(name).text(newPrice['total']);
                        $('#tongcong').text(newPrice['tongcong']);               
                    });
                }    
            })
        });
    });
</script>
<script>
$().ready(function() {
    
	// validate the form when it is submitted
	var validator = $("#cart").validate({
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
<?php return ob_get_clean(); ?>