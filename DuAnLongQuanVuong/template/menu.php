<?php
ob_start(); //Bien luu = chuoi
?>
 <script type="text/javascript">
	window.onload = function () {
		document.getElementById("password1").onchange = validatePassword;
		document.getElementById("password2").onchange = validatePassword;
	}
	function validatePassword(){
	var pass2=document.getElementById("password2").value;
	var pass1=document.getElementById("password1").value;
	if(pass1!=pass2)
		document.getElementById("password2").setCustomValidity("Passwords Don't Match");
	else
		document.getElementById("password2").setCustomValidity('');
	//empty string means no validation error
	}
</script>
<div class="row" style="background-color:#AAD5FF ;">
   
    <div class="col-md-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="../Views/images/cr5.jpg" width="100%" alt="Los Angeles"/>
    </div>

    <div class="item">
      <img src="../Views/images/cr4.jpg" width="100%" alt="Chicago"/>
    </div>

   
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </div>
</div>
    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: darkblue;color: yellow;border: 1px solid darkblue;">
      <div class="container">
        <div class="navbar-header">
           <a class="navbar-brand" href="../Controllers/home_controller.php" style="color: white;">Logo</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="#">Trang Chủ</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sản Phẩm
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Page 1-1</a></li>
              <li><a href="#">Page 1-2</a></li>
              <li><a href="#">Page 1-3</a></li>
            </ul>
          <li>
          <a href="#">Liên hệ</a></li>
          <!-- Dropdown -->
            <li class="nav-item dropdown">
              	<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"> Quản lý <span class="caret"></span></a>
              	<ul class="dropdown-menu">
					  <?php
                        foreach($tables as $table):
                      		?>
                            <li><a class="dropdown-item" href="../Controllers/<?php echo $table->Tables_in_duan .'_controller.php';?>">
                                <?php echo $table->Tables_in_duan;?>
                            </a></li>
                          <?php
                        endforeach;
                      ?>
              </ul>
            </li>
            
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <form class="navbar-form navbar-left">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Tìm Kiếm"/>
              </div>
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </form>
            <li><a href="#" data-toggle="modal" data-target="#mySignup"><span class="glyphicon glyphicon-user"></span>Đăng Ký</a></li>
      <li><a href="#" data-toggle="modal" data-target="#myLogin"><span class="glyphicon glyphicon-log-in"></span> Đăng Nhập</a></li>
        </ul>
        
      </div>
    </nav>
    <!-- Modal -->
   		<!--Login-->
    <div class="modal fade" id="myLogin" role="dialog">
        <div class="modal-dialog" style="width:28%">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;text-align: center;background-color: #314D68;padding: 22px 12px; color:#FFF">
              <button type="button" class="close" data-dismiss="modal">x</button>
              <h4 class="modal-title">Đăng nhập</h4>
            </div>
            <div class="modal-body" style="padding: 30px 35px 35px;">
                <div class="login-form">
                    <form action="" method="post" id="signin">
                        <input type="text" class="email" name="email" placeholder="Email" required="">
                        <input type="password" class="lock" name="password" placeholder="Mật khẩu" required="" value="">
                        <div class="signin-rit">
                            <span class="checkbox1">
                                 <label class="chk"><input type="checkbox" name="checkbox" checked="">Ghi nhớ</label>
                            </span>
                                <a class="close_modal" data-dismiss="modal" href="#" data-toggle="modal" data-target="#myGetpass">Quên mật khẩu?</a>
                            <div class="clear"> </div>
                        </div>
                        <input type="submit" value="Đăng nhập">
                    </form>
                    <p>Bạn chưa có tài khoản?<a href="#" class="close_modal" data-dismiss="modal" data-toggle="modal" data-target="#mySignup">Tạo tài khoản</a></p>
                  <!--<h5 class="or">(or)</h5>
                    <div class="social-icons">
                        <ul>
                            <li><a href="#"class="facebook"><img src="../Views/images/fb.png" title="facebook" alt="facebook" /></a></li>
                            <li><a href="#"class="twitter"><img src="../Views/images/tw.png" width="80%" title="Tiwtter" alt="Tiwtter" /></a></a></li>
                            <li><a href="#"class="googleplus"><img src="../Views/images/gp.png" width="10%" title="Google Plus" alt="Google Plus" /></a></a></li>
                        </ul>
                    </div>-->
                </div>
            </div>
          </div>
          </div>
        </div>
        
        <!--Sign up-->
        <div class="modal fade" id="mySignup" role="dialog">
        <div class="modal-dialog" style="width:28%">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;text-align: center;background-color: #314D68;padding: 22px 12px; color:#FFF">
              <button type="button" class="close" data-dismiss="modal">x</button>
              <h4 class="modal-title">Đăng kí</h4>
            </div>
            <div class="modal-body" style="padding: 30px 35px 35px;">
               	<div class="login-form">
                    <form action="" method="post" id="signup">
                        <ol>
                            <li>
                                <input type="text" id="username" name="username" placeholder="Họ và tên" title="Vui lòng nhập tên của bạn" required="">
                            </li>
                            <li>
                                <input type="email" id="email" name="email" placeholder="mail@example.com" title="Vui lòng nhập email" required="">
                                <p class="validation01">
                                    <span class="invalid">Ví dụ: ryan@example.com</span>
                                </p>
                            </li>
                             <li>
                                <input type="text" id="address" name="address" placeholder=" Địa chỉ" title="Vui lòng nhập email" required="">
                            </li>
                            <li>
                                <input type="tel" id="tel" name="tel" placeholder="Vui lòng nhập số điện thoại" required="">
                                <p class="validation01">
                                    <span class="invalid">Ví dụ: 09612345678</span>
                                </p>
                            </li>
                            <li>
                            	<input type="password" class="lock" name="password" placeholder="Mật khẩu" id="password1" required="">
                            </li>
                            <li>
                       			 <input type="password" class="lock" name="password1" placeholder="Mật khẩu nhập lại" id="password2" required="">
                        	</li>
                        </ol>
                        <div class="signin-rit">
                            <span class="checkbox1">
                                 <label class="chk"><input type="checkbox" name="checkbox" checked="">Tôi đồng ý với<a class="pp" target="_blank" href="#"> Điều khoản bảo mật</a></label>
                            </span>
                            <div class="clear"> </div>
                        </div>
                         <input type="submit" value="Đăng kí">
                    </form>
                    <p>Bạn đã có tài khoản? <a href="#" class="close_modal" data-dismiss="modal" data-toggle="modal" data-target="#myLogin">Đăng nhập ngay</a></p>
                </div>
                </div>
              </div>
            </div>
        </div>
        
      <!--Get Password-->
       <div class="modal fade" id="myGetpass" role="dialog">
        <div class="modal-dialog" style="width:28%">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;text-align: center;background-color: #314D68;padding: 22px 12px; color:#FFF">
              <button type="button" class="close" data-dismiss="modal">x</button>
              <h4 class="modal-title">Lấy lại mật khẩu</h4>
            </div>
            <div class="modal-body" style="padding: 30px 35px 35px;">
                <div class="login-form">
                	<h5 class="text-center"><i>Nhập địa chỉ email của bạn vào bên dưới <br />và chúng tôi sẽ gửi cho bạn một email<br /> kèm theo hướng dẫn.</i></h5>
                    <form action="" method="post" id="getpass">
                        <input type="text" class="email" name="getEmail" placeholder="Email" required="">
                        <input type="submit" value="Gửi">
                    </form>
                  <!--<h5 class="or">(or)</h5>
                    <div class="social-icons">
                        <ul>
                            <li><a href="#"class="facebook"><img src="../Views/images/fb.png" title="facebook" alt="facebook" /></a></li>
                            <li><a href="#"class="twitter"><img src="../Views/images/tw.png" width="80%" title="Tiwtter" alt="Tiwtter" /></a></a></li>
                            <li><a href="#"class="googleplus"><img src="../Views/images/gp.png" width="10%" title="Google Plus" alt="Google Plus" /></a></a></li>
                        </ul>
                    </div>-->
                </div>
            </div>
          </div>
          </div>
        </div>
<?php
return ob_get_clean();
?>
