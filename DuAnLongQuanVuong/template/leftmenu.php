<?php ob_start(); ?>
    <div class="list-group" style="padding-top: 3%;">
        <div class="list-title ">Danh Sách Các Shop</div>
        <div class="list-group-item ">Shop Mỹ Phẩm</div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/home_controller.php?action=mypham">Shop Mỹ Phẩm</a>
        </div>
        <div class="list-group-item list-group-item-action">Shop Mỹ Phẩm</div>
        <div class="list-group-item list-group-item-action">Shop Mỹ Phẩm</div>
        <div class="list-group-item list-group-item-action">Shop Mỹ Phẩm</div>
        <div class="list-group-item list-group-item-action">Shop Mỹ Phẩm</div>
        <div class="list-group-item list-group-item-action">Shop Mỹ Phẩm</div>
        <div class="list-group-item list-group-item-action">Shop Mỹ Phẩm</div>
        
    </div>
    <div class="list-group" style="padding-top: 3%;">
        <div class="list-title">
            Bảng Giá Dịch Vụ
        </div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/home_controller.php?action=services">Xem chi tiết >></a>
        </div>  
    </div>
     
<?php return ob_get_clean(); ?>