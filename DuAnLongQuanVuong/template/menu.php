 <?php
ob_start(); 
?>
<!--Menu -->
<div class="row">
    <div class="col-md-12" >
    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #FE840E; border: none;">
        <div class="navbar-header">
        	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar btn-navmenu"></span>
                <span class="icon-bar btn-navmenu"></span>
                <span class="icon-bar btn-navmenu"></span>                        
             </button>
           <a class="navbar-brand" href="home_controller.php" style="color: white;">
            <span class="glyphicon glyphicon-home"></span> Trang Chủ</a>
            <a class="navbar-brand" href="home_controller.php?action=nhanship" style="color: white;">
            <i class="fas fa-shipping-fast"></i> Nhận ship</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav" style="background-color: #FE840E;">
          <li><a href="#" style="color: #fff;" data-toggle="modal" data-target="#infoFindCustomer">
                <span class="glyphicon glyphicon-list-alt"></span> Khách Tra Cứu Đơn Hàng
            </a></li>
          <li><a href="#" style="color: #fff;">
                  <span class="glyphicon glyphicon-info-sign"></span> Liên hệ
                </a>
          </li>
          <?php 
            if(isset($_SESSION['role'])){
                if($_SESSION['role']==0)
                {
                    echo '<li><a href="../Controllers/admin_controller.php?action=index" style="color:#fff;">Quản Lý</a></li>';
                }
                else
                {
                    echo '<li><a href="../Controllers/shop_controller.php?action=index" style="color:#fff;">Quản Lý</a></li>';
                }
            }?>            
           
            <?php if(isset($_SESSION['fullname']))
            { 
				 if($_SESSION['role']==0)
                {
                   echo '<li><a href="#" data-toggle="modal" data-target="#mySignup" style="color:#fff;">
                            <span class="glyphicon glyphicon-user"></span>Đăng Ký</a></li>';
                }
               echo '<li><a style="color:#fff;">Xin chào '. $_SESSION['fullname'].'</a></li>';
               echo '<li><a href="../Controllers/users_controller.php?action=logout" style="color:#fff;">Đăng Xuất</a></li>';
            } else{?>     
     
            <li><a href="#" data-toggle="modal" data-target="#myLogin" style="color: #fff;">
                    <span class="glyphicon glyphicon-log-in"></span> Đăng Nhập
                </a>
            </li>
            
        <?php }?>
        
        </ul>
         <!-- <div class="col-md-2 col-sm-2 col-xs-4">-->
         <?php if(isset($_SESSION['cart']))
                {
                    if($_SESSION['sosl'] > 0):
            ?>
                <ul class="nav navbar-nav navbar-right" style="background-color: #FE840E;" >
                    <li>
                        <a href="../Controllers/shoppingcart_controller.php?action=viewcart" style="color: #fff;">
                        <img src='../Views/img/cart6.png' width="25%" data-html="true" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="<b>Giỏ hàng có <?php echo $_SESSION['sosl'];?> sản phẩm</b>"/>
                            Giỏ Hàng
                            <?php
                                echo '                            
                                     <span class="badge" style="font-size:120%">
                                        '.$_SESSION['sosl'].'';
                                endif;
                            ?>                                    
                           </span>
                        </a>
                    </li>
                
                </ul>
            <?php } ?>
             <!-- </div>-->
        </div>
    </nav>
    </div>
</div>
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
    <!-- Information fiding customer-->
    <div class="modal fade" id="infoFindCustomer" role="dialog">
         <div class="col-md-4 col-sm-4 col-xs-1"></div>
        <div class="col-md-5 col-sm-6 col-xs-10 modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;text-align: center;background-color: #FE840E;padding: 22px 12px; color:#FFF">
              <button type="button" class="close" data-dismiss="modal">x</button>
              <h3 class="modal-title">Tra Cứu Đơn Hàng</h3>
            </div>
            <div class="modal-body" style="padding: 30px 35px 35px;">
                <div class="login-form">
                    <form action="../Controllers/users_controller.php?action=tra_cuu_don_hang" method="post" id="signin">
                        <input type="text" class="form-control" id="phone" 
                                name="phone" placeholder="Nhập số điện thoại" required=""/>
                        <label for="phone_error" class="form-error"></label>
                            <div class="clear"></div>
                </div>
                <input type="submit" name="dangnhap" class="form-control" 
                                style="background-color: #FE840E; color: #fff;" value="Tra cứu"/>
            </form>
                   
                </div>
            </div>
          </div>
          </div>
        </div>
        <!-- End of Information finding customer-->
   		<!--Login-->
    <div class="modal fade" id="myLogin" role="dialog">
         <div class="col-md-4 col-sm-4 col-xs-1"></div>
        <div class="col-md-5 col-sm-6 col-xs-10 modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;text-align: center;background-color: #FE840E;padding: 22px 12px; color:#FFF">
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
                       <input type="submit" name="dangnhap" class="btn btn-primary" 
                                style="background-color: #FE840E;" value="Đăng nhập"/>
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
			}
  		}	
	});
    $('[data-toggle="popover"]').popover('show');
});
</script>
        <!--Sign up-->
        <div class="modal fade row" id="mySignup" role="dialog" >
        <div class="col-md-4 col-sm-4 col-xs-1"></div>
        <div class="col-md-5 col-sm-6 col-xs-10 modal-dialog">
                  <!-- Modal content-->
          <div class="modal-content row">
            <div class="modal-header" style="border-bottom: none;text-align: center;background-color: #314D68;padding: 22px 12px; color:#FFF">
              <button type="button" class="close" data-dismiss="modal">x</button>
              <h4 class="modal-title">Đăng kí</h4>
            </div>
            <div class="modal-body " style="padding: 30px 35px 35px;">
               	<div class="login-form">
                    <form action="users_controller.php?action=dangky" method="post" id="signup">
                        <ol>
                            <li>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Họ và tên" title="Vui lòng nhập tên của bạn" required=""/>
                                <label for="username_error" class="form-error"></label>
                            </li>
                            <li>
                                <input type="email" id="email" name="email" class="form-control" placeholder="mail@gmail.com" title="Vui lòng nhập email" required=""/>
                                <label for="email_error" class="form-error"></label>
                            </li>
                            <li>
                                <input type="text" id="tenshop" name="tenshop" class="form-control" placeholder="Tên Shop " title="Vui lòng nhập tên shop" required=""/>
                                <label for="tenshop_error" class="form-error"></label>
                            </li>
                             <li>
                                <input type="text" id="address" name="address" class="form-control" placeholder=" Địa chỉ" title="Vui lòng nhập địa chỉ shop" required=""/>
                                <label for="address_error" class="form-error"></label>
                            </li>
                            <li>
                                <input type="text" id="tel" name="tel" class="form-control" placeholder="Vui lòng nhập số điện thoại" required="" />
                               <label id="tel_error" for="tel_error" class="form-error"></label>
                            </li>
                            <li>
                            	<input type="hidden" class="lock" class="form-control" name="password1" id="password1" 
                                value="<?php
										$letter='0123456789abcdfghjkmnpqrstvwxyzABCDFGHJKMNPQRSTVWXYZ@*!~#$%^&()-+=';
										$str="";
										for($i=0;$i<8;$i++){
											$str .= substr($letter,mt_rand(0,strlen($letter)-1),1);	
										}
										echo $str;
								?>"/>
                            </li> 
                        </ol>
                         <input type="submit" value="Đăng kí"/>
                    </form>
                </div>
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