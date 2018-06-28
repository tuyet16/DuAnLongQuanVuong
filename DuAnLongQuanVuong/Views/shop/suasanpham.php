<?php
	ob_start();
?>
    	<fieldset>
        	<legend style="80%">Sửa sản phẩm</legend>
                <form method="post" action="">
                    <div class="row">
                    	<div class="col-md-2">Tên sản phẩm</div> 
                       	<div class="col-md-5"> <input type="text" class="form-control" width="60%"/></div>
                    </div>
                    <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Shop</div> 
                       	<div class="col-md-5"> <input type="text" class="form-control" width="60%" disabled/></div>
                    </div>
                     <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Loại sản phẩm</div> 
                       	<div class="col-md-5"><select class="form-control">
                        							<option>Chọn tất cả</option>
                 							</select>
                        </div>
                    </div>
                     <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Đơn vị tính</div> 
                       	<div class="col-md-5"><select class="form-control">
                        							<option>Chọn tất cả</option>
                 							</select>
                        </div>
                    </div>
                    <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Giá</div> 
                       	<div class="col-md-5"> <input type="text" class="form-control" width="60%"/></div>
                    </div>
                    <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Hình ảnh</div> 
                       	<div class="col-md-5"><input type="file" class="form-control"/></div>
                    </div>
                    <div class="row" style="margin-top:3px;margin-left:52%"> 
                    	<button type="submit" class="btn" style="background-color:darkblue;color:#FFF"> Lưu </button> 
                   	</div>
                </form>
        </fieldset>
<?php
	return ob_get_clean();
?>