<?php ob_start(); ?>
<link type="text/css" rel="stylesheet" href="../Views/css/pgwslideshow.min.css"/>
<script src="../Views/js/jquery.min.js"> </script>
<script src="../Views/js/pgwslideshow.min.js"></script>
<script>
$(document).ready(function(){
    $('.pgwSlideshow').pgwSlideshow({
            transitionEffect : 'fading',
            displayControls : false,
            autoSlide: true
        }); 
});
</script>
<div class="container-fluid" style="margin: 60px 0;">
    <div class="row">
        <div class="col-xs-12 col-md-5">
        <div class="slides">
            <ul class="pgwSlideshow">
                <li><img src="../Views/img/thumb/medium_<?php echo $rs_chi_tiet_san_pham[0]->image; ?>"/></li>
                <?php if($rs_chi_tiet_san_pham[0]->image1 != ""){ ?>
                <li><img src="../Views/img/<?php echo $rs_chi_tiet_san_pham[0]->image1; ?>"/></li>
                <?php }?>
                <?php if($rs_chi_tiet_san_pham[0]->image2 != ""){ ?>
                <li><img src="../Views/img/thumb/medium_<?php echo $rs_chi_tiet_san_pham[0]->image2; ?>"/></li>
                <?php }?>
                <?php if($rs_chi_tiet_san_pham[0]->image3 != ""){ ?>
                <li><img src="../Views/img/thumb/medium_<?php echo $rs_chi_tiet_san_pham[0]->image3; ?>"/></li>
                <?php }?>
                <?php if($rs_chi_tiet_san_pham[0]->image4 != ""){ ?>
                <li><img src="../Views/img/thumb/medium_<?php echo $rs_chi_tiet_san_pham[0]->image4; ?>"/></li>
                <?php }?>
                <?php if($rs_chi_tiet_san_pham[0]->image5 != ""){ ?>
                <li><img src="../Views/img/thumb/medium_<?php echo $rs_chi_tiet_san_pham[0]->image5; ?>"/></li>
                <?php }?>               
            </ul>
            </div>
        </div>
        <form method="post">
        <div class="col-xs-12 col-md-7">
        
           <div class="product-title">
               <?php echo ucwords($rs_chi_tiet_san_pham[0]->productName); ?>
          </div>
          <?php if($rs_chi_tiet_san_pham[0]->PromotionPrice > 0):?>
                    <div class="product-price-with-promotion">
                         <?php echo number_format($rs_chi_tiet_san_pham[0]->price);?> đ
                    </div>
                    <div class="product-promotion-price">
                         <?php echo number_format($rs_chi_tiet_san_pham[0]->PromotionPrice);?> đ/<?php echo $rs_chi_tiet_san_pham[0]->unitName;?>
                    </div>
            <?php else:?>
                    <div class="product-price">
                         <?php echo number_format($rs_chi_tiet_san_pham[0]->price);?> đ/<?php echo $rs_chi_tiet_san_pham[0]->unitName;?>
                    </div>
            <?php endif; ?>
            <?php if($rs_chi_tiet_san_pham[0]->count >0):?>
                    <div class="product-price">
                         <?php echo 'Số Lượng hàng còn:'.number_format($rs_chi_tiet_san_pham[0]->count);?> /<?php echo $rs_chi_tiet_san_pham[0]->unitName;?>
                    </div>
                    <p class="button">
                        <a href="shoppingcart_controller.php?action=add&id=<?php echo $rs_chi_tiet_san_pham[0]->productID;?>" 
                            >
                            Mua sản phẩm
                        </a>
                    </p>
            <?php else:?>
                    <div class="product-price" style="color: #0000A0;">
                         <?php echo 'Hết Hàng' ?>
                    </div>
                    <p class="button">
                        <a style="opacity: 0.5;">
                            Mua sản phẩm
                        </a>
                    </p>
            <?php endif;?>
            
            <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="product-information">THÔNG TIN SẢN PHẨM</div>
                <p>
                    <?php echo $rs_chi_tiet_san_pham[0]->description;?>
                </p>
            </div>
        </div>
        </div>
        </form>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <h3 class="product-information">SẢN PHẨM KHÁC CỦA SHOP</h3>
        </div>
    </div>
        <?php $number = 0;
         foreach($rsOtherProductShop as $item):
            if($number == 0){
         ?>
         <div class="row most-view-product">
            <div class="col-xs-12 col-sm-3 col-md-2">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <a href="home_controller.php?action=chitiet&id=<?php echo $item->productID;?>">
                    <img src="../Views/img/thumb/x_small_<?php echo $item->image;?>"  class="img-responsive" style="margin: 0 auto;"/> 
                    <h5><?php echo ucwords($item->productName);?></h5>
                    </a>
                    <?php 
                    if($item->PromotionPrice > 0):
                                echo '<p class="origin-price-with-promotion">'. number_format($item->price) .'đ</p>
                                <p class="promotion-price">'. number_format($item->PromotionPrice) .'đ/'. $item->unitName.'</p>';
                            else:
                                echo ' <p class="origin-price-not-promotion">'. number_format($item->price) .'đ/'.$item->unitName .'</p>';
                            endif;
                    ?>
                  </div>
                </div>
            </div>
            <?php }else{?>
                    <div class="col-xs-12 col-sm-3 col-md-2">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <a href="home_controller.php?action=chitiet&id=<?php echo $item->productID;?>">
                    <img src="../Views/img/thumb/x_small_<?php echo $item->image;?>"  class="img-responsive" style="margin: 0 auto;"/> 
                    <h5><?php echo ucwords($item->productName);?></h5>
                    </a>
                    <?php 
                    if($item->PromotionPrice > 0):
                                echo '<p class="origin-price-with-promotion">'. number_format($item->price) .'đ</p>
                                    <p class="promotion-price">'. number_format($item->PromotionPrice) .'đ/'. $item->unitName.'</p>';
                            else:
                                echo ' <p class="origin-price-not-promotion">'. number_format($item->price) .'đ/'.$item->unitName .'</p>';
                            endif;
                    ?>
                  </div>
                </div>
            </div>
            <?php } 
            if($number > 4){
                $number = 0;
                echo '</div>';
            }
            else
                $number++;
            ?>
        <?php endforeach; ?> 
    </div>
</div>
  




<?php return ob_get_clean(); ?>