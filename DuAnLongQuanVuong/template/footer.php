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
.btn-top {
	background-image:url(../Views/img/top.jpg);
    background-repeat: no-repeat;
	margin-right:10px;
    border: medium none;
    bottom: 90px;
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
<a href="#">
    <div class="btn-top"></div>
</a>
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
<div class="row footer"  style="background-color: #FE840E; color: #fff; padding-top: 20px;">
<div class="container-fluid" style="background-color: #FE840E;">
<div class="row">
    <div class="col-xs-6 col-sm-4 col-md-2">
    <ul class="ul"><h5><b class="footer-section-title">HỖ TRỢ KHÁCH HÀNG</b></h5>
        <li>Hỗ Trợ Khách hàng</li>
        <li>Chính sách bảo mật</li>
        <li>Chấp nhận thanh toán</li>
        <li>Kết nối với chúng tôi</li>
    </ul>
    </div>
    <div class="col-xs-6 col-md-2 col-sm-3">
        <ul class="ul"><h5><b class="footer-section-title">BẢO HÀNH</b></h5>
            <li>Vận chuyển</li>
            <li>Hướng dẫn</li>
            <li>Bảo hành</li>
            <li>Đổi trả</li>
        </ul>
    </div>
    <div class="col-xs-12 col-md-3 col-sm-5" >
    <ul><h5><b class="footer-section-title">PHƯƠNG THỨC THANH TOÁN</b></h5>
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
    
    <div class="col-xs-12 col-md-5 text-center">
        <div class="row">
            <div class="col-xs-12">
                <h5  class="footer-section-title">CÔNG TY TNHH DV & SHIPPER LONG QUÂN VƯƠNG</h5>
                <h5>Địa chỉ: 109 Trần Tuấn Khải,Phường 5,Quận 5 TP.HCM</h5>
                <h5>Điện thoại : 06596259 - 39234005 - 0937802 </h5>
            </div>
        </div>
    </div>    
</div>
<div class="row text-center">
    <div class="col-xs-12">
        <p>Website hiện đang trong quá trình thử nghiệm</p>
        <p>&copy; 2018 Bản quyền thuộc về công ty TNHH DV & SHIPPER Long Quân Vương. Phát triển bởi <a href="http://tmaisaigon.vn" target="_blank">tmaisaigon.vn</a></p>
    </div>
</div>
</div>
</div>
<?php return ob_get_clean(); ?>