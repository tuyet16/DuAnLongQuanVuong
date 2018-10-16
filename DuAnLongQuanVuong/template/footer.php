<?php ob_start();?>
<style>
.btn-cart {
	background-image:url(../Views/img/cart3.png);
    background-repeat: no-repeat;
	margin-right:10px;
    border: medium none;
    bottom: 30px;
    cursor: pointer;
    display: inline-block;
    height: 50px;
    outline: medium none;
    padding: 0;
    position: fixed;
    right: 20px;
    width: 50px;
    z-index: 9999;
	border-radius:50%;
}
</style>
<a href="../Controllers/shoppingcart_controller.php?action=viewcart">
	<div class="btn-cart">

            <?php if(isset($_SESSION['cart']))
            {
                echo '                            
                     <span class="badge" style="font-size:120%">
                        '.$_SESSION['sosl'].'';
            } ?>                   
	</div>
</a>
<div class="footer"  style="background-color: #AAD5FF;padding-top: 20px;">
<div class="row">
    <div class="col-md-2">
    <ul class="ul"><h5><b>HỖ TRỢ KHÁCH HÀNG</b></h5>
        <li>Hỗ Trợ Khách hàng</li>
        <li>Chính sách bảo mật</li>
        <li>Chấp nhận thanh toán</li>
        <li>Kết nối với chúng tôi</li>
    </ul>
    </div>
    <div class="col-md-2">
        <ul class="ul"><h5><b>BẢO HÀNH</b></h5>
            <li>Vận chuyển</li>
            <li>Hướng dẫn</li>
            <li>Bảo hành</li>
            <li>Đổi trả</li>
        </ul>
    </div>
    <div class="col-md-3" >
    <ul><h5><b>PHƯƠNG THỨC THANH TOÁN</b></h5>
        <i class="fa fa-facebook-official" style="color:#0000FB;"></i>
        <i class="fa fa-twitter-square" style="color:#0000FB;"></i>
        <i class="fa fa-instagram" style="color:red;"></i>
        <i class="fa fa-youtube" style="color:red;"></i>
        <h5>Email:vuonglq@gmail.com</h5>
        <h1>
            <i class="fa fa-cc-visa" style="margin-left: 5px;background-color: blue;color: white;"></i>
            <i class="fa fa-cc-mastercard" style="margin-left: 5px;background-color: blue; color: aquamarine;"></i>
            <i class="fa fa-cc-paypal" style="margin-left: 5px;background-color: purple; color: black;"></i>
        <h1>
        <h1> 
            <i class="fa fa-cc-stripe" style="margin-left: 5px;background-color: red; color: white;"></i>
            <i class="fa fa-cc-amex" style="margin-left: 5px;background-color: black; color: yellow;"></i >
        <h1>
    </ul>
    </div>
    
    <div class="col-md-5 text-center">
        <div class="row text-center">
            <h4 style="color: #0000FB;">CÔNG TY TNHH DV & SHIPER LONG QUÂN VƯƠNG</h4>
        </div>
        <div class="row text-center">
            <h6>Đ/c: 109 Trần Tuấn Khải,Phường 5,Quận 5 TP.HCM</h6>
            
        </div>
        <div class="row text-center">
            <h6>Tell:06596259-39234005-0937802 </h6>
        </div>
    </div>    
</div>

</div>

<?php return ob_get_clean(); ?>