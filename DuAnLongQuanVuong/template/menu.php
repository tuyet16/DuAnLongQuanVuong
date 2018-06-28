<?php
ob_start(); //Bien luu = chuoi
?>

<div class="row" style="background-color:#AAD5FF;margin-top: 3%;">    
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
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user" style="font-size: 24px;"></i>
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
               <li><a href="#"><span class="glyphicon glyphicon-user"></span> Đăng Ký</a></li>
            <li><a href="#" data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon-log-in"></span> Đăng Nhập</a></li>
            </ul>
          <li>
           
        </ul>        
      </div>
    </nav>

<form method="post" action="users_controller.php?action=dangnhap">
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="background-color: red;color: white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Đăng Nhập Tài Khoản</h4>
          </div>
          <div class="modal-body">
          <div class="row">
            <div class="col-md-3">Tài khoản</div>
            <div class="col-md-9"><input type="text" class="form-control" name="user" /></div>
          </div>
          <div class="row" style="padding-top: 10px;">
            <div class="col-md-3">Mật khẩu</div>
            <div class="col-md-9"><input type="password" class="form-control" name="pass" /></div>
          </div> 
          <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-9"><input  type="checkbox" /> Nhớ mật khẩu</div>            
          </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger" name="dangnhap" >Đăng Nhập</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
    
      </div>
    </div>
   </form>
<!--

-->
<!--
<div class="row bg-dark">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <!-- Brand 
      <a class="navbar-brand" href="../Controllers/admin_controller.php">Logo</a>
    
      <!-- Links 
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Link 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link 2</a>
        </li>
           
        <!-- Dropdown -->
        <!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Quản lý
          </a>
          <div class="dropdown-menu">
          <?php
            //foreach($tables as $table):
          ?>
            <a class="dropdown-item" href="../Controllers/<?php //echo $table->Tables_in_my_guitar_shop2 .'_controller.php';?>">
                <?php //echo $table->Tables_in_my_guitar_shop2;?>
            </a>
          <?php
           // endforeach;
          ?>
          </div>
        </li>
        
      </ul>
    </nav>
</div>
-->
<?php
return ob_get_clean();
?>
