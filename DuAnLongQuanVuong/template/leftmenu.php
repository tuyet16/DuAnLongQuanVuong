<?php ob_start(); ?>
<h3 class="text-info text-capitalize">Danh Sách Các Shop</h3>
    <div class="list-group">
        <div class="list-group-item">Shop Mỹ Phẩm</div>
        <div class="list-group-item">Shop Mỹ Phẩm</div>
        <div class="list-group-item">Shop Mỹ Phẩm</div>
        <div class="list-group-item">Shop Mỹ Phẩm</div>
        <div class="list-group-item">Shop Mỹ Phẩm</div>
    </div>
     <a href="../Controllers/home_controller.php?action=index&view=dichvu">Bảng Giá Dịch Vụ</a>
<?php return ob_get_clean(); ?>