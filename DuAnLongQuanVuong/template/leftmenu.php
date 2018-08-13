<?php ob_start(); ?>
    <div class="list-group" style="background-color: #F3F3F3;">
        <div class="list-title ">Danh Sách Mặt Hàng</div>       
       <?php foreach($dsCategories as $row){ 
            ?>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/home_controller.php?action=xemsanpham&id=<?php echo $row->categoryID; ?>"><?php echo $row->categoryName; ?></a>
        </div>
        <?php }?>  
    </div>
    <div class="list-group" style="padding-top: 3%;">
        <div class="list-title">
            Bảng Giá Dịch Vụ
        </div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/services_controller.php?action=index">Xem chi tiết >> ></a>
        </div>  
    </div>
     
<?php return ob_get_clean(); ?>