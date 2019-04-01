<?php ob_start(); ?>
<div class="container-fluid" style="margin-top: 60px;">
<?php
    foreach($dsProducts['cateInfo'] as $category):
?>
        <div class="row">
            <h3 class="product-information"><?php echo $category['cateName'];?></h3>
            <?php foreach($dsProducts['cateinfo'][$category['cateId']]['productCategory'] as $product):?>
                <div class="col-xs-6 col-sm-3">
                    <div class="panel panel-default">
                      <div class="panel-body">
                            <p class="text-center" style="text-align: center;">
                                <img src="../Views/img/thumb/x_small_<?php echo $product['image'];?>" class="img-responsive" style="margin: 0 auto;"/>
                            </p>
                            <div class="form-group">
                              <label for="productName">Tên sản phẩm:</label>
                              <p><?php echo $product['productName']; ?></p>
                            </div>
                            <div class="form-group">
                              <label for="productPrice">Giá gốc:</label>
                              <p><?php echo number_format($product['price']); ?></p>
                            </div>
                            <div class="form-group">
                              <label for="productName">Giảm giá:</label>
                              <p><?php echo number_format($product['PromotionPrice']); ?></p>
                            </div>
                            
                            
                      </div>
                      <div class="panel-footer text-center">
                        <a href="products_controller.php?action=xoasanpham&id=<?php echo $product['productID']?>" class="btn btn-danger">Xóa</a>
                        <a href="products_controller.php?action=suasanpham&id=<?php echo $product['productID']?>" class="btn btn-primary">Sửa</a>
                      </div>
                    </div>
                    
                </div>
            <?php endforeach; ?>
        </div>
<?php endforeach; ?>
</div>
<?php return ob_get_clean(); ?>