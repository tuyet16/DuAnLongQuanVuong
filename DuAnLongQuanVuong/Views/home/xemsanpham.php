<?php
ob_start();
?>
    <div class="row well well-sm"><b style="font-size: 120%;color:#FF2020;">Sản Phẩm Mới</b></div>
    <div class="row" style="padding-top: 10px;">  
    <?php foreach($rsProducts as $row)
    {
        echo '
             <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;">
                <div class="card-header">
                   <a href="../Controllers/shop_controller.php?action=suasanpham" style="color: white;"><img src="../Views/img/'.$row->image.'" width="100%"  height="250px"/></a> 
                </div>
                <div class="card-body" style="padding: 20px;text-align: center;">
                    <h4>'.$row->productName.'</h4>
                    <h4 style="color: #D52072;">Giá: '.number_format($row->price).' vnđ</h4>
                </div>
            </div>
        </div>            
        
        ';
    } ?>      
           
    </div>
    <!--phân trang-->
    <div><?php echo $pagination; ?></div>


<?php
return ob_get_clean();
?>