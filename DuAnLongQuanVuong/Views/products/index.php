<?php
	ob_start();
?>

    	<div class="row" style="margin: 60px 0;">
            <div class="col-xs-12">
        	   <div  class="product-information">Thêm sản phẩm</div>
                <form method="post" action="?action=themsanpham" enctype="multipart/form-data" style="padding-top: 15px;">
                    <div class="row">
                    	<label class="control-label col-md-2">
                            Tên sản phẩm
                        </label> 
                       	<div class="col-md-7"> 
                           <input type="text" name="tensp" class="form-control"/>
                        </div>
                    </div>
                     <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Loại sản phẩm</label> 
                       	<div class="col-md-3">
                            <select name="categoryID" class="form-control">
                            <?php foreach($dsCategories as $product)
                            {
                            ?>
                                <option value="<?php echo $product->categoryID ; ?>"><?php echo $product->categoryName; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                     <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Đơn vị tính</label> 
                       	<div class="col-md-3">
                            <select name="unitID" class="form-control">
                            <?php foreach($dsUnits as $unit)
                            {
                            ?>
                                <option value="<?php echo $unit->unitID ; ?>"><?php echo $unit->unitName; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Giá</label> 
                       	<div class="col-md-3"> <input type="text" name="gia" class="form-control" width="60%"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Số Lượng</label> 
                       	<div class="col-md-3"> <input type="text" name="soluong" class="form-control" width="60%"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Giá Khuyến Mãi</label> 
                       	<div class="col-md-3"> <input type="text" name="giakhuyenmai" class="form-control" width="60%"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Hình ảnh chính</label> 
                       	<div class="col-md-3"><input type="file" name="hinhanh" class="form-control"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Hình ảnh phụ 1</label> 
                       	<div class="col-md-3"><input type="file" name="hinhanhphu[]" class="form-control"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Hình ảnh phụ 2</label> 
                       	<div class="col-md-3"><input type="file" name="hinhanhphu[]" class="form-control"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Hình ảnh phụ 3</label> 
                       	<div class="col-md-3"><input type="file" name="hinhanhphu[]" class="form-control"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Hình ảnh phụ 4</label> 
                       	<div class="col-md-3"><input type="file" name="hinhanhphu[]" class="form-control"/></div>
                    </div>
                    <div class="row" style="margin-top:15px">
                    	<label class="col-md-2">Hình ảnh phụ 5</label> 
                       	<div class="col-md-3"><input type="file" name="hinhanhphu[]" class="form-control"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<label class="control-label col-md-2">Mô tả</label> 
                       	<div class="col-md-8">
                           <textarea name="description" rows="25" cols="55" class="mota" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row" style="margin-top:3px;margin-left:52%"> 
                    	<button type="submit" class="btn" style="background-color:darkblue;color:#FFF"> Lưu </button> 
                   	</div>
                </form>
            </div>
        </div>
        

<?php
	return ob_get_clean();
?>