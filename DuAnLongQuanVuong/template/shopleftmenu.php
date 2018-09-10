<?php ob_start(); ?>
    <div class="list-group" style="background-color: #F3F3F3;">
        <div class="list-title ">DANH MUC SẢN PHẨM</div>
        <?php foreach($dsCategories as $row){ ?>
            <div class="list-group-item list-group-item-action">
            <a href="../Controllers/shop_controller.php?action=xemsanpham&id=<?php echo $row->categoryID; ?>"><?php echo $row->categoryName; ?></a>
        </div>
        <?php } ?>
    </div>
    <div class="list-group" style="padding-top: 3%;">
        <div class="list-title">
           DANH MỤC ĐƠN HÀNG
        </div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/users_controller.php?action=donhang">Đơn hàng</a>
        </div>
    </div>
     <div class="list-group" style="padding-top: 3%;">
        <div class="list-title">
           CHỨC NĂNG
        </div>
        <div class="list-group-item list-group-item-action">
            <a href="../Controllers/products_controller.php?action=index"><i class="fa fa-plus-circle"></i> Thêm Sản Phẩm</a><br />
            <a href="../Controllers/users_controller.php?action=changepass"><i class="fa fa-key" aria-hidden="true"></i> Đổi mật khẩu</a>
        </div>  
    </div>
<?php return ob_get_clean(); ?>