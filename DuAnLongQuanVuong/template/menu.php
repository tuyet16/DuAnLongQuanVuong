<?php
ob_start(); //Bien luu = chuoi
?>
<div class="row bg-dark">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <!-- Brand -->
      <a class="navbar-brand" href="../Controllers/admin_controller.php">Logo</a>
    
      <!-- Links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Link 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link 2</a>
        </li>
    
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Quản lý
          </a>
          <div class="dropdown-menu">
          <?php
            foreach($tables as $table):
          ?>
            <a class="dropdown-item" href="../Controllers/<?php echo $table->Tables_in_my_guitar_shop2 .'_controller.php';?>">
                <?php echo $table->Tables_in_my_guitar_shop2;?>
            </a>
          <?php
            endforeach;
          ?>
          </div>
        </li>
      </ul>
    </nav>
</div>
<?php
return ob_get_clean();
?>
