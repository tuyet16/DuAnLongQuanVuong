<?php
ob_start();
?>
        <h1 class="alert-danger jumbotron">Thông báo: <span class="alert-link"><?php echo $message;?></span></h1>
        <p class="alert-dark">Tập tin có lỗi: <span class="alert-link"><?php echo $error_file;?></span></p>
        <p class="alert-warning">Dòng bị lỗi: <?php echo $error_line;?></p>
<?php
return ob_get_clean();
?>
