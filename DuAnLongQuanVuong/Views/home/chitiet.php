<?php ob_start(); 
?>
<script>
    $(document).ready(function(){
        $('.pgwSlideshow').pgwSlideshow();
    });
</script>
<div class="row">
    <div class="col-md-4">
        <img src="../Views/img/<?php echo $rs_chi_tiet_san_pham[0]->image; ?>" width="100%" alt=""/>
        <!--
        <div class="row">
            <ul class="pgwSlideshow">
                <li><img src="../Views/images/q1.jpg" alt="" data-description=""/></li>
                <li><img src="../Views/images/q1.jpg" /></li>
               <li><img src="../Views/images/q1.jpg" alt="" data-large-src="london.jpg"/></li>
                <li><img src="../Views/images/q1.jpg" alt=""/></li>
                <li><img src="../Views/images/q1.jpg" alt=""/></li>               
            </ul>
        </div>
        -->
    </div>
    <form method="post">
    <div class="col-md-7">
        <h4 style="color: red;">CHI TIẾT SẢN PHẨM</h4>
        <h5>Tình trạng: còn hàng</h5>
        <h5 style="color: red;"><?php echo number_format($rs_chi_tiet_san_pham[0]->price);?> vnđ</h5>
        <h5 style="color: blue;">THÔNG TIN SẢN PHẨM</h5>
        <h5>
        <?php echo $rs_chi_tiet_san_pham[0]->description;?>
        </h5>
        <!--
		<ul class="size">
			<h3>Length</h3>
			<li><a href="#">32</a></li>
			<li><a href="#">34</a></li>
		</ul>
        <h5>SỐ LƯỢNG :
        <input type="number" name="soluong" min="1" max="20"/> <h6 style="font-family: sans-serif;">Tối đa 20 sản phẩm</h6>
        -->
        <h5><a href="shoppingcart_controller.php?action=add&id=<?php echo $rs_chi_tiet_san_pham[0]->productID;?>" class="btn btn-danger">Mua sản phẩm</a></h5>
        
    </div>
    </form>
</div>
<!--
<div class="row well well-sm" style="margin-top:20px;">SẢN PHẨM LIÊN QUAN</div>
 <div class="row" style="padding-top: 10px;">        
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;">
                <div class="card-header">
                   <a href="../Controllers/home_controller.php?action=chitiet" style="color: white;"><img src="../Views/images/q1.jpg" width="100%"/></a> 
                </div>
                <div class="card-body" style="padding: 20px;text-align: center;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Mua hàng</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Mua hàng</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Mua hàng</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Mua hàng</button>
                </div>
            </div>
        </div>        
    </div>
    <div class="row" style="padding-top: 10px;">        
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;">
                <div class="card-header">
                   <a href="../Controllers/home_controller.php?action=chitiet" style="color: white;"><img src="../Views/images/q1.jpg" width="100%"/></a> 
                </div>
                <div class="card-body" style="padding: 20px;text-align: center;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Mua hàng</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Mua hàng</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Mua hàng</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Mua hàng</button>
                </div>
            </div>
        </div>
        
    </div>
-->
<?php return ob_get_clean(); ?>