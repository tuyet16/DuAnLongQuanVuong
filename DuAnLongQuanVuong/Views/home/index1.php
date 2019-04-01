<?php
ob_start();
?>
    <div class="row well well-sm"><b style="font-size: 120%;color:#FF2020;">Mặt Hàng</b></div>
    <div class="row" style="padding-top: 10px;">  
    <div class="col-md-12 col-sm-12 col-xs-12">    
    <?php
        $i = 0;
    foreach($rsProducts as $row){        
        echo '
            <div class="col-md-3 col-sm-6" col-xs-6 style="padding:10px;">
            <div class="card" style="border: 1px solid silver;">
                <div class="card-header">
                   <a href="../Controllers/home_controller.php?action=chitiet&id=' . $row->productID .'" style="color: white;">
                    <img src="../Views/img/'.$row->image.'" width="100%" height="230px"/></a> 
                </div>
                <div class="card-body" style="padding-top: 20px;padding-bottom:20px;text-align: center;">
                <div class="col-xs-12" style="margin-bottom:20px">
                    <h4 style="height:35px"><b>'.$row->productName.'</b></h4>
                </div>
                    <h4 style="color: #D52072;">'.number_format($row->price).' vnđ</h4>
                    <a href="../Controllers/shoppingcart_controller.php?action=add&id='.$row->productID.'" class="btn btn-primary">Mua hàng</a>
                </div>
            </div>
        </div>
        ';
        
    } ?>      
      </div>  
    </div>
    <?php echo $pagination; ?>
    <!--phân trang-->
   <!-- <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>-->


<?php
return ob_get_clean();
?>