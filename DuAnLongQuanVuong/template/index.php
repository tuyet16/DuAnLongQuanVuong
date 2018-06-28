<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>
    <?php
        if(isset($GLOBALS['template']['title'])){
            echo $GLOBALS['template']['title'];
        } 
    ?>
    </title>
    <link type="text/css" rel="stylesheet" href="../views/css/designer.css"/>
   	<link type="text/css" rel="stylesheet" href="../views/css/bootstrap.min.css"/> 
   	<link type="text/css" rel="stylesheet" href="../views/css/font-awesome.css"/>
     <script src="../Views/js/jquery.min.js"> </script>
    <script src="../Views/js/bootstrap.min.js"></script>       
    <script src="../Views/js/jquery.validate.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../views/css/pgwslideshow.min.css"/>
    <script src="../Views/js/pgwslideshow.min.js"></script>
    <script src="../views/js/script.js"></script>

</head>

<body>
    <?php
    if(isset($GLOBALS['template']['menu'])){
        echo $GLOBALS['template']['menu'];
    }
    
?>
    <div class="container-fluid" style="padding-top: 10px;" >

        <div class="row bg-transparent">
           <div class="col-sm-3">
                <?php
                
                if(isset($GLOBALS['template']['leftmenu'])){
                    echo $GLOBALS['template']['leftmenu'];
                 }
                ?>
            </div>
        
            <div class="col-sm-9">
                    <?php
                if(isset($GLOBALS['template']['content'])){
                    echo $GLOBALS['template']['content'];
                }
            ?>
            </div>
        </div>
        <div class="row">
            <?php 
                if(isset($GLOBALS['template']['footer'])){
                    echo $GLOBALS['template']['footer'];
            }
             ?>
        </div>

    </div>     
   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width:28%">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: none;text-align: center;background-color: #314D68;padding: 22px 12px; color:#FFF">
          <button type="button" class="close" data-dismiss="modal">x</button>
          <h4 class="modal-title">Đăng nhập</h4>
        </div>
        <div class="modal-body" style="padding: 30px 35px 35px;">
         	<div class="login-form">
                <form action="" method="post">
                    <input type="text" class="user" name="loginid" placeholder="Email" required="">
                    <input type="password" class="lock" name="Userpassword" placeholder="password" required="" value="">
                    <input type="hidden" name="sendbacktopage" value="/ecommerce-online-shopping-mobile-website-templates/page/3/">
                    <div class="signin-rit">
                        <span class="checkbox1">
                             <label class="checkbox"><input type="checkbox" name="checkbox" checked="">Ghi nhớ</label>
                        </span>
                        <a class="forgot play-icon popup-with-zoom-anim" href="#small-dialog3">Quên mật khẩu?</a>
                        <div class="clear"> </div>
                    </div>
                    <input type="submit" value="Đăng nhập">
                </form>
                <p>Bạn chưa có tài khoản?<a href="#small-dialog2" class="play-icon popup-with-zoom-anim">Tạo tài khoản</a></p>
                <!--<h5 class="or">(or)</h5>
                <div class="social-icons">
                    <ul>
                        <li><a href="#"class="facebook"><img src="images/fb.jpg" title="facebook" alt="facebook" /></a></li>
                        <li><a href="#"class="twitter"><img src="images/tw.jpg" title="facebook" alt="facebook" /></a></a></li>
                        <li><a href="#"class="googleplus"><img src="images/gp.jpg" title="facebook" alt="facebook" /></a></a></li>
                    </ul>
                </div>-->
            </div>
        </div>
      </div>
      
    </div>
  </div>
     
</body>
</html>