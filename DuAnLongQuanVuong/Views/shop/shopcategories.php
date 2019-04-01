<?php ob_start(); ?>    
<?php
    foreach($dsProducts['cateInfo'] as $category):
?>
        <div class="row">
            <h3 class="product-information"><?php echo $category['cateName'];?></h3>
            <?php foreach($dsProducts['cateinfo'][$category['cateId']]['productCategory'] as $product):?>
                <div class="col-xs-6 col-sm-3">
                    <div class="panel panel-default">
                      <div class="panel-body">
                            <img src="../Views/img/<?php echo $product['image'];?>" width="100%" height="200px"/>
                            <div class="form-group">
                              <label for="productName">Tên sản phẩm:</label>
                              <p><?php echo $product['productName']; ?></p>
                            </div>
                            <div class="form-group">
                              <label for="productPrice">Giá gốc:</label>
                              <p><?php echo $product['price']; ?></p>
                            </div>
                            <div class="form-group">
                              <label for="productName">Giảm giá:</label>
                              <p><?php echo $product['PromotionPrice']; ?></p>
                            </div>
                            
                            
                      </div>
                      <div class="panel-footer text-center">
                        <a href="#" class="btn btn-danger">Xóa</a>
                        <a href="products_controller.php?action=suasanpham&id=<?php echo $product['productID']?>" class="btn btn-primary">Sửa</a>
                      </div>
                    </div>
                    
                </div>
            <?php endforeach; ?>
        </div>
<?php endforeach; ?>
<?php return ob_get_clean(); ?>