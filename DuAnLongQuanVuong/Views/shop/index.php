<?php
ob_start();
?>
    <div class="row well well-sm"><b style="font-size: 120%;color:#FF2020;">Sản Phẩm Mới</b></div>
    <div class="row" style="padding-top: 10px;">        
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;">
                <div class="card-header">
                   <a href="../Controllers/shop_controller.php?action=suasanpham" style="color: white;"><img src="../Views/images/q1.jpg" width="100%"/></a> 
                </div>
                <div class="card-body" style="padding: 20px;text-align: center;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <div class="row">
                     <div class="col-md-6">
                     <a href="../Controllers/shop_controller.php?action=suasanpham" style="color: white;">
                        <button class="btn btn-danger">Sửa</button>
                     </a></div>
                    <div class="col-md-6">
                        <button class="btn btn-success">Xóa</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Sửa Sản phẩm</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Sửa Sản phẩm</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Sửa Sản phẩm</button>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row" style="padding-top: 20px;">        
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Sửa Sản phẩm</button>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Sửa Sản phẩm</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4>
                    <h4 style="color: #D52072;">500.000 vnđ</h4>
                    <button class="btn btn-danger">Sửa Sản phẩm</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border: 1px solid silver;text-align: center;">
                <div class="card-header">
                   <img src="../Views/images/q1.jpg" width="100%" /> 
                </div>
                <div class="card-body" style="padding: 20px;">
                    <h4>Set đồ đẹp</h4> 
                    <h4 style="color: #D52072;">500.000 vnđ</h4>                   
                    <button class="btn btn-danger">Sửa Sản phẩm</button>
                </div>
            </div>
        </div>        
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