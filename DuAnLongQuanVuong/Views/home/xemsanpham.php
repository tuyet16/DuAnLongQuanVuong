<?php
ob_start();
?>
    <div class="row well well-sm">
        <div style="font-size: 120%;color:#FF2020;">
        <a href="/">Home</a> &raquo; <?php echo $category_name; ?>
        </div>
    </div>
      
    <?php 
    $number = 0;
    foreach($rsProducts as $row)
    {
        if($number == 0){
        echo '
        <div class="row most-view-product" style="padding-top: 10px;">
        <div class="col-md-2 col-sm-3 col-xs-12" style="margin-bottom:15px;">
            <div class="panel panel-default" style="border: 1px solid silver; padding: 5px; ">
                <div class="panel-body"  style="padding: 5px;text-align: center;">
                   <a href="../Controllers/home_controller.php?action=chitiet&id=' . $row->productID . '" style="color: white;">
                        <img src="../Views/img/thumb/x_small_'.$row->image.'" class="img-responsive" style="margin: 0 auto" />
                   </a> 
                    <h5 style="font-weight:bold;">'.$row->productName.'</h5>'; 
                     
                    if($row->PromotionPrice > 0):
                                echo '<p class="origin-price-with-promotion">'. number_format($row->price) .'đ</p>
                                    <p class="promotion-price">'. number_format($row->PromotionPrice) .'đ/'. $row->unitName.'</p>';
                            else:
                                echo ' <p class="origin-price-not-promotion">'. number_format($row->price) .'đ/'.$row->unitName .'</p>';
                            endif;
                    if($row->count > 0):
                        echo '<a href="../Controllers/shoppingcart_controller.php?action=add&id='.$row->productID.'&q=' .  base64_encode($_SERVER['QUERY_STRING']) .'" class="btn" style="background-color:#FE840E; color:#fff;">
                                Mua hàng
                             </a>';
                    else:
                        echo '<a class="btn" style="background-color:#FE840E; color:#fff;opacity: 0.5;">
                                    Mua hàng
                            </a>';
                    
                   endif;
                echo'   
                </div>
            </div>
        </div>            
        ';
        }
        else{
            echo '
        
        <div class="col-md-2 col-sm-3 col-xs-12" style="margin-bottom:15px;">
            <div class="panel panel-default" style="border: 1px solid silver; padding: 5px; ">
                <div class="panel-body"  style="padding: 5px;text-align: center;">
                   <a href="../Controllers/home_controller.php?action=chitiet&id=' . $row->productID . '" style="color: white;">
                        <img src="../Views/img/thumb/x_small_'.$row->image.'" class="img-responsive" style="margin: 0 auto" />
                   </a> 
                    <h5 style="font-weight:bold;">'.$row->productName.'</h5>'; 
                     
                    if($row->PromotionPrice > 0):
                                echo '<p class="origin-price-with-promotion">'. number_format($row->price) .'đ</p>
                                    <p class="promotion-price">'. number_format($row->PromotionPrice) .'đ/'. $row->unitName.'</p>';
                            else:
                                echo ' <p class="origin-price-not-promotion">'. number_format($row->price) .'đ/'.$row->unitName .'</p>';
                            endif;
                    if($row->count > 0):
                        echo '<a href="../Controllers/shoppingcart_controller.php?action=add&id='.$row->productID.'&q=' .  base64_encode($_SERVER['QUERY_STRING']) .'" class="btn" style="background-color:#FE840E; color:#fff;">
                                Mua hàng
                             </a>';
                    else:
                        echo '<a class="btn" style="background-color:#FE840E; color:#fff;opacity: 0.5;">
                                    Mua hàng
                            </a>';
                    
                   endif;
                echo'   
                </div>
            </div>
        </div>            
        ';
        }
        if($number > 4){
            $number=0;
            echo '</div>';
        }
        else{
            $number++;
        }
    } ?>      
           
    </div>
    <!--phân trang-->
    <div style="text-align: center;"><?php echo $pagination; ?></div>


<?php
return ob_get_clean();
?>