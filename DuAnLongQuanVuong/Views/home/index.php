<?php
ob_start();
?>
<!--Script run carousel-->
<link rel="stylesheet" type="text/css" href="../Views/css/owl.carousel.min.css"/>
<link rel="stylesheet" type="text/css" href="../Views/css/owl.theme.default.min.css"/>
<script src="../Views/js/jquery.min.js"> </script>
<script src="../Views/js/owl.carousel.min.js"></script>
<script>
$(document).ready(function(){
 $(".owl-carousel-most-view").owlCarousel({
		loop:true,
		margin:10,
		//responsiveClass:true,
		autoplay:true,
		autoplayTimeout:1000,
		autoplayHoverPause:true,
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		responsive:{
			0:{
				items:1,
				nav:true
			},
			600:{
				items:3,
				nav:false,
			},
		}
         });
  });
</script>
    <div class="row product-information">
        <div class="col-xs-12 col-sm-12">
            DANH MỤC MUA SẮM
        </div>
    </div>
    <div class="row" style="padding-top: 10px;">  
    <div class="col-md-12 col-sm-12 col-xs-12">    
    <?php
        $i = 0;
    foreach($dsCategories as $row){        
        echo '  
            <div class="col-md-3 col-sm-3 col-xs-6" style="padding:10px;">
                <div class="panel" style="border: 1px solid silver; ">
                    <div class="panel-heading" style="text-align: center;background-color: #FE840E;">
                    <a href="../Controllers/home_controller.php?action=xemsanpham&id=' . $row->categoryID .'" style="color: white; text-decoration:none;">
                        <h4>'
                        . ucwords($row->categoryName) .'
                        </h4>
                    </a>    
                    </div>
                    
                    <div class="panel-body">
                        <a href="../Controllers/home_controller.php?action=xemsanpham&id=' . $row->categoryID .'" style="color: white;">
                        <img src="../Views/img/'.$row->cate_img.'" class="img-responsive" width="100%" alt="'. $row->categoryName .'"/></a> 
                    </div>
                    
                </div>
            </div>
        ';
        if($i > 3) $i = 0;
            $i++;
    } ?>      
      </div>  
    </div>
    <!--phân trang-->
   <!-- <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>-->
    <?php if($rsNewProduct != null):?>
    <div class="row product-information">
        <div class="col-xs-12 col-sm-12">
            SẢN PHẨM MỚI VỀ
        </div>
    </div>
    <div class="most-view-product">
        
            <?php 
                $index = 0;
                foreach($rsNewProduct as $newProductItem)
            	{
            	   if($index==0):
                    echo '<div  class="row" style="margin: 10px 0;">
                            <div class="col-xs-12 col-sm-3 col-md-2" style="padding: 10px;">
                            <div class="item">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <a href="home_controller.php?action=chitiet&id='. $newProductItem->productID .'">
						      	           <img src="../Views/img/thumb/x_small_'.$newProductItem->image.'" alt="' . $newProductItem->productName.'" class="img-responsive" style="margin: 0 auto;"/>
                                            <h5>'. ucwords($newProductItem->productName) .'</h5>
                                        </a>';
                                    if($newProductItem->PromotionPrice > 0):
                                      echo ' <p class="origin-price-with-promotion">'. number_format($newProductItem->price) .'đ</p>
                                            <p class="promotion-price">'. number_format($newProductItem->PromotionPrice) .'đ /'. $newProductItem->unitName.'</p>';
                                    else:
                                        echo ' <p class="origin-price-not-promotion">'. number_format($newProductItem->price) .'đ /'.$newProductItem->unitName .'</p>';
                                    endif;
                        echo '      </div>
                                </div>
                            </div>
                        </div>';
                    else:
                        echo '<div class="col-xs-12 col-sm-3 col-md-2" style="padding:10px;">
                            <div class="item">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <a href="home_controller.php?action=chitiet&id='. $newProductItem->productID .'">
						      	           <img src="../Views/img/thumb/x_small_'.$newProductItem->image.'" alt="' . $newProductItem->productName.'" class="img-responsive" style="margin: 0 auto;"/>
                                            <h5>'. ucwords($newProductItem->productName) .'</h5>
                                        </a>';
                                    if($newProductItem->PromotionPrice > 0):
                                      echo ' <p class="origin-price-with-promotion">'. number_format($newProductItem->price) .'đ</p>
                                            <p class="promotion-price">'. number_format($newProductItem->PromotionPrice) .'đ /'. $newProductItem->unitName.'</p>';
                                    else:
                                        echo ' <p class="origin-price-not-promotion">'. number_format($newProductItem->price) .'đ /'.$newProductItem->unitName .'</p>';
                                    endif;
                        echo '      </div>
                                </div>
                            </div>
                        </div>';
                    endif;
                    if($index > 4):
                        $index = 0;
                        echo '</div>';
                    else:
                        $index++;
                    endif;
				}       
			?>
    </div>
    <?php endif; ?>
    <!-- Newest Products-->
    <div class="row product-information">
        <div class="col-xs-12 col-sm-12">
            SẢN PHẨM XEM NHIỀU
        </div>
    </div>
    <div class="container-fluid most-view-product">
            <?php 
                $number = 0;
                foreach($rsMostViewProduct as $viewProductItem)
            	{
            	   if($number == 0)
                   {
            	       echo '<div class="row" style="margin: 10px 0;">
                                <div class="col-xs-12 col-sm-3 col-md-2" style="padding: 10px;"><div class="item">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                <a href="home_controller.php?action=chitiet&id='. $viewProductItem->productID .'">
						      	   <img src="../Views/img/thumb/x_small_'.$viewProductItem->image.'" alt="' . $viewProductItem->productName .'" class="img-responsive" style="margin: 0 auto;"/>
                                   <h5>'. ucwords($viewProductItem->productName) .'</h5></a>';
                            if($viewProductItem->PromotionPrice > 0):
                                echo '<p class="origin-price-with-promotion">'. number_format($viewProductItem->price) .'đ </p>
                                    <p class="promotion-price">'. number_format($viewProductItem->PromotionPrice) .'đ /' . $viewProductItem->unitName. '</p>';
                            else:
                                echo '<p class="origin-price-not-promotion">'. number_format($viewProductItem->price) .'đ /'. $viewProductItem->unitName.'</p>';
                            endif;
                        
                        echo     '</div>
                            </div>
                        </div>
                        </div>';
                    }
                    else
                    {
                        echo '<div class="col-xs-12 col-sm-3 col-md-2" style="padding: 10px;">
                            <div class="item">
                            <div class="panel panel-default">
                                
                                <div class="panel-body">
                                    <a href="home_controller.php?action=chitiet&id='. $viewProductItem->productID .'">
						      	   <img src="../Views/img/thumb/x_small_'.$viewProductItem->image.'" alt="'.$viewProductItem->productName.'" class="img-responsive" style="margin:0 auto;"/>
                                   <h5>'. ucwords($viewProductItem->productName) .'</h5></a>';
                                   if($viewProductItem->PromotionPrice > 0):
                                echo ' <p class="origin-price-with-promotion">'. number_format($viewProductItem->price) .'đ </p>
                                        <p class="promotion-price">'. number_format($viewProductItem->PromotionPrice) .'đ/'. $viewProductItem->unitName.'</p>';
                            else:
                                echo ' <p class="origin-price-not-promotion">'. number_format($viewProductItem->price) .'đ/'.$viewProductItem->unitName .'</p>';
                            endif;
                        echo '</div>
                            </div>
                        </div>
                        </div>';
                    }
                    if($number > 4)
                    {
                        $number = 0;
                        echo '</div>';   
                    }
                    else
                        $number++;
				}       
			?>
    </div>
    <!-- End of Newest Products-->
<?php
return ob_get_clean();
?>