<?php
ob_start();
?>
    <div class="row well well-sm"><b style="font-size: 120%;color:#FF2020;">Sản Phẩm Mới</b></div>
    <div class="row" style="padding-top: 10px;">  
    <?php foreach($dsProducts as $row){
        echo '
            <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;">
                <div class="card-header">
                   <a href="../Controllers/home_controller.php?action=chitiet" style="color: white;"><img src="../Views/img/'.$row->image.'" width="100%" height="250px"/></a> 
                </div>
                <div class="card-body" style="padding: 20px;text-align: center;">
                    <h4>'.$row->productName.'</h4>
                    <h4 style="color: #D52072;">'.$row->price.' vnđ</h4>
                    <a href="../Controllers/shoppingcart_controller.php?action=add&id='.$row->productID.'" class="btn btn-danger">Mua hàng</a>
                </div>
            </div>
        </div>
        ';
    } ?>      
        
    </div>
    <!--phân trang-->
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>


<?php
return ob_get_clean();
?>