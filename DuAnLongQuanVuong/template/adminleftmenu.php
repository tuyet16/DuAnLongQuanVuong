<?php ob_start(); ?>
    <div class="list-group" style="background-color: #F3F3F3;">
        <div class="list-title text-center">Quản Lý</div>
        <div class="list-group-item "><a href="admin_controller.php?action=dsshop">Shop</a></div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/customers_controller.php">Khách Hàng</a>
        </div>
        <div class="list-group-item list-group-item-action"><a href="../Controllers/employees_controller.php">nhân viên</a></div>
<<<<<<< HEAD
        <div class="list-group-item list-group-item-action">Dịch Vụ</div>
        <div class="list-group-item list-group-item-action"><a href="../Controllers/districts_controller.php">Khu Vực</a></div>        
        <div class="list-group-item list-group-item-action"><a href="../Controllers/categories_controller.php">Mặt Hàng</div>
=======
        <div class="list-group-item list-group-item-action"><a href="../Controllers/services_controller.php">Dịch Vụ</a></div>
        <div class="list-group-item list-group-item-action"><a href="../Controllers/districts_controller.php">Quận</a></div> 
        <div class="list-group-item list-group-item-action"><a href="../Controllers/wards_controller.php">Phường</a></div>
        <div class="list-group-item list-group-item-action"><a href="../Controllers/areas_controller.php">Khu vực</a></div>       
        <div class="list-group-item list-group-item-action"><a href="../Controllers/categories_controller.php">Danh Mục Sản Phẩm</div>
>>>>>>> cc33e16a41d1289f425b0909724fc3734e97b947
    </div>
    <div class="list-group" style="padding-top: 3%;">
        <div class="list-title text-center">
           Đơn Hàng
        </div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/admin_controller.php?action=donhang">Đơn hàng</a>
        </div>
    </div>
     <div class="list-group" style="padding-top: 3%;">
        <div class="list-title text-center">
           Thống Kê
        </div>
        <div class="list-group-item list-group-item-action"><a href="../Controllers/employees_controller.php?action=bangluong">Lương Nhân Viên</a></div>  
        <div class="list-group-item list-group-item-action"><a href="../Controllers/admin_controller.php?action=doanhthungay">Doanh Thu Theo Ngày</a></div>
        <div class="list-group-item list-group-item-action">Doanh Thu Theo Tháng</div>
        <div class="list-group-item list-group-item-action">Doanh Thu Theo Năm</div>          
    </div>
<?php return ob_get_clean(); ?>