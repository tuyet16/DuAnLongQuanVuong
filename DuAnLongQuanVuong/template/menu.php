 <?php
ob_start(); //Bien luu = chuoi
?>
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
<<<<<<< HEAD
        <ul class="nav navbar-nav">
          <li class="dropdown">
=======
<<<<<<< HEAD

=======
>>>>>>> 7f5699dc970c62f2edc0fbcd9025088f3bf9ad2b
        
        <ul class="nav navbar-nav">
         <!-- <li><a href="home_controller.php">Trang Chủ</a></li>-->
          <li class="dropdown">
<<<<<<< HEAD
=======
>>>>>>> ffdaddfe9c46bbf0240bb60b008339356d3de549
        <div class="navbar-header">
           <a class="navbar-brand" href="home_controller.php" style="color: white;">Trang Chủ</a>
           
        </div>
>>>>>>> 7f5699dc970c62f2edc0fbcd9025088f3bf9ad2b
        <ul class="nav navbar-nav">
           <!--<li><a href="#">Trang Chủ</a></li>-->
         <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sản Phẩm
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Page 1-1</a></li>
              <li><a href="#">Page 1-2</a></li>
              <li><a href="#">Page 1-3</a></li>
            </ul>
            </li>
          <li><a href="#">Liên hệ</a></li>
          <?php if(isset($_SESSION['role'])){
                    if($_SESSION['role']==0)
                    {
                        echo '<li><a href="../Controllers/admin_controller.php?action=index">Quản Lý</a></li>';
            }
            else
            {
                echo '<li><a href="../Controllers/shop_controller.php?action=index">Quản Lý</a></li>';
            }
            }?>
            
            <form class="navbar-form navbar-left">
              <div class="form-group">
                
                <input type="text" class="form-control" placeholder="Tìm Kiếm"/>
              </div>
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </form>
            <?php if(isset($_SESSION['fullname']))
            {
               echo '<li><a href="#" data-toggle="modal" data-target="#mySignup"><span class="glyphicon glyphicon-user"></span>Đăng Ký</a></li>';
               echo '<li><a>Xin chào '. $_SESSION['fullname'].'</a></li>';
               echo '<li><a href="../Controllers/users_controller.php?action=logout">Đăng Xuất</a></li>';
            } else{?>     
     
            <li><a href="#" data-toggle="modal" data-target="#myLogin">
            <span class="glyphicon glyphicon-log-in"></span> Đăng Nhập</a></li>
        <?php }?>
        
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../Controllers/shoppingcart_controller.php?action=viewcart">
                    <img src='../Views/img/cart3.png' width="25%"/>
                    Giỏ Hàng<?php if(isset($_SESSION['cart']))
                    {
                        echo '                            
                             <span class="badge" style="font-size:120%">
                                '.$_SESSION['sosl'].'';
                    } ?>                   
                    </span>
            </a></li>
        
        </ul>
               
      </div>
    </nav>
    <!-- Modal -->
    <script>
    	/*$().ready(function() {
			var validator = $("#signin").validate({
				errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
					email1: {
						required: "Vui lòng không để trống",
						//email: "Ví dụ: mail@example.com"
					},
					password:{
						required: "Vui lòng không để trống"	,
						//minlength:"Mật khẩu phải có từ 8 kí tự <br> Chứa cả chữ và số",
					},
				},
		rules:{
				email:{
					required: true,
					//email: true
				},	
				password:{
					required:true,
					//minlength:8
				}
  			}	
		});*/
	//});
    </script>
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
                    <form action="../Controllers/users_controller.php?action=dangnhap" method="post" id="signin">
                        <input type="text" class="email" id="email1" name="email1" placeholder="Email" required=""/>
                        <label for="email1_error" class="form-error"></label>
                        <input type="password" id="password" class="lock" name="password" placeholder="Mật khẩu" required="" value=""/>
                        <label for="password_error" class="form-error"></label>
                        <div class="signin-rit">
                            <span class="checkbox1">
                                 <label class="chk"><input type="checkbox" name="checkbox" checked=""/>Ghi nhớ</label>
                            </span>
                                <a class="close_modal" data-dismiss="modal" href="#" data-toggle="modal" data-target="#myGetpass">Quên mật khẩu?</a>
                            <div class="clear"></div>
                        </div>
                        <label style="color: red;">
                            <?php if(isset($_SESSION['erro'])) echo $_SESSION['erro']; ?>
                            </label>
                       <input type="submit" name="dangnhap" class="btn btn-primary" value="Đăng nhập"/>
                    </form>
                   
                </div>
            </div>
          </div>
          </div>
        </div>
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
					username:{
						required: "Vui lòng không để trống"
					},
					email:{
						required: "Vui lòng không để trống",
						email: "Ví dụ: mail@gmail.com"
					},
					tenshop:{
						required: "Vui lòng không để trống"
					},
					address:{
						required: "Vui lòng không để trống"
					},
					tel:{
						required: "Vui lòng không để trống",
						phoneUK:"Chỉ được nhập 10 đến 11 số"
					},
					password1:{
						required: "Vui lòng không để trống",
						minlength:"Mật khẩu phải có từ 8 kí tự <br> Chứa cả chữ và số"
					},
					password2:{
						required: "Vui lòng không để trống",
						minlength:"Mật khẩu phải có từ 8 kí tự <br> Chứa cả chữ và số",
						equalTo: "Mật khẩu chưa khớp"
					}	
				},
		rules:{
			email:{
				required: true,
      			email: true
			},	
			tel:{
				required:true,
				phoneUK:true
			},
			password1:{
				minlength:8
			},
			password2:{
				minlength : 8,
                equalTo : '[name="password1"]'
			}
  		}	
	});
});
</script>
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
                    <form action="users_controller.php?action=dangky" method="post" id="signup">
                        <ol>
                            <li>
                                <input type="text" id="username" name="username" placeholder="Họ và tên" title="Vui lòng nhập tên của bạn" required="">
                                <label for="username_error" class="form-error"></label>
                            </li>
                            <li>
                                <input type="email" id="email" name="email" placeholder="mail@gmail.com" title="Vui lòng nhập email" required="">
                                <label for="email_error" class="form-error"></label>
                            </li>
                            <li>
                                <input type="text" id="tenshop" name="tenshop" placeholder="Tên Shop" title="Vui lòng nhập tên shop" required=""/>
                                <label for="tenshop_error" class="form-error"></label>
                            </li>
                             <li>
                                <input type="text" id="address" name="address" placeholder=" Địa chỉ" title="Vui lòng nhập địa chỉ shop" required=""/>
                                <label for="address_error" class="form-error"></label>
                            </li>
                            <li>
                                <input type="text" id="tel" name="tel" placeholder="Vui lòng nhập số điện thoại" required="" >
                               <label id="tel_error" for="tel_error" class="form-error"></label>
                            </li>
                            <li>
                            	<input type="password" class="lock" name="password1" placeholder="Mật khẩu" id="password1" required="">
                                <label for="password1_error" class="form-error"></label>
                            </li>
                            <li>
                       			 <input type="password" class="lock" name="password2" placeholder="Mật khẩu nhập lại" id="password2" required="">
                                 <label for="password2_error" class="form-error"></label>
                        	</li>
                        </ol>
                         <input type="submit" value="Đăng kí"/>
                    </form>
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
                        <input type="text" class="email" name="getEmail" placeholder="Email" required=""/>
                        <input type="submit" value="Gửi"/>
                    </form>
                </div>
            </div>
          </div>
          </div>
        </div>
<?php
return ob_get_clean();
?>