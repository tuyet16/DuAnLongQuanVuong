<?php ob_start(); ?>
    <div class="list-group" style="background-color: #F3F3F3;">
        <div class="list-title text-center">Quản Lý</div>
        <div class="list-group-item "><a href="admin_controller.php?action=dsshop">Shop</a></div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/customers_controller.php">KHÁCH HÀNG</a>
        </div>
        <div class="list-group-item list-group-item-action"><a href="../Controllers/employees_controller.php">NHÂN VIÊN</a></div>
    <!--<div class="list-group-item list-group-item-action"><a href="../Controllers/districts_controller.php">KHU VỰC</a></div> -->       
        <div class="list-group-item list-group-item-action"><a href="../Controllers/categories_controller.php">MẶT HÀNG</a></div>
        <div class="list-group-item list-group-item-action"><a href="../Controllers/units_controller.php">ĐƠN VỊ TÍNH</a></div>
        <div class="list-group-item list-group-item-action"><a href="../Controllers/services_controller.php">DỊCH VỤ</a></div>
        <div class="list-group-item list-group-item-action"><a href="../Controllers/districts_controller.php">QUẬN</a></div>
        <div class="list-group-item list-group-item-action"><a href="../Controllers/areas_controller.php">KHU VỰC</a></div> 
        <div class="list-group-item list-group-item-action">
          <a href="../Controllers/tieude_controller.php">QUY ĐỊNH</a>
            
        </div> 
         <div class="list-group-item list-group-item-action"><a href="../Controllers/admin_controller.php?action=doihinh">THAY ĐỔI QUẢNG CÁO</a>
        </div>
    </div>
    <div class="list-group" style="padding-top: 3%;">
        <div class="list-title text-center">
           Đơn Hàng
        </div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/admin_controller.php?action=donhang">Đơn Hàng</a>            
        </div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/admin_controller.php?action=tinhtrang">Tình Trạng Giao Hàng</a>            
        </div>
    </div>
     <div class="list-group" style="padding-top: 3%;">
        <div class="list-title text-center">
           Thống Kê
        </div>  
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/admin_controller.php?action=doanhthungay">Doanh Thu Theo Ngày</a>
        </div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/admin_controller.php?action=doanhthuthang">Doanh Thu Theo Tháng</a></div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/admin_controller.php?action=doanhthunam">Doanh Thu Theo Năm</a></div>          
    </div>
<?php return ob_get_clean(); ?>