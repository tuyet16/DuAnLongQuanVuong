<?php
	ob_start();
?>
<div class="container-fluid" style="margin-top: 60px;">
    <h3 class="product-information">Sửa sản phẩm</h3>   
        <form method="post" action="?action=suasanpham" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-9">                   
                <input type="hidden" name="productID" value="<?php echo $rsProducts[0]->productID;?>" />
                <div class="row">
                	<div class="col-md-2">Tên sản phẩm</div> 
                   	<div class="col-md-8"> <input type="text" name="tensp" class="form-control" value="<?php echo $rsProducts[0]->productName; ?>"/></div>
                </div>
                 <div class="row" style="margin-top:15px">
                	<div class="col-md-2">Loại sản phẩm</div> 
                   	<div class="col-md-8">
                        <select name="categoryID" class="form-control">
                        <?php 
                       $select = $rsProducts[0]->categoryID;
                        foreach($dsCategories as $product)
                        {
                            if($product->categoryID == $select)
                            {
                        ?>
                            <option value="<?php echo $product->categoryID ; ?>" selected="selected"><?php echo $product->categoryName; ?></option>
                        <?php }
                        else
                        {
                            echo '<option value="'.$product->categoryID.'">'.$product->categoryName.'</option>';
                        }
                        }?>
                        </select>
                    </div>
                </div>
                 <div class="row" style="margin-top:15px">
                	<div class="col-md-2">Đơn vị tính</div> 
                   	<div class="col-md-8">
                        <select name="unitID" class="form-control">
                        
                        <?php 
                        $op = $rsProducts[0]->unitID;
                        foreach($dsUnits as $unit)
                        {
                        if($unit->unitID == $op)
                            {
                        ?>
                            <option value="<?php echo $unit->unitID ; ?>" selected="selected"><?php echo $unit->unitName; ?></option>
                        <?php }
                        else
                        {
                            echo '<option value="'.$unnit->unitID.'">'.$unit->unitName.'</option>';
                        }} ?>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top:15px">
                	<div class="col-md-2">Giá</div> 
                   	<div class="col-md-8"> 
                       <input type="text" name="gia" value="<?php echo $rsProducts[0]->price; ?>" class="form-control" width="60%"/>
                    </div>
                </div>
                <div class="row" style="margin-top:15px">
                	<div class="col-md-2">Giá Khuyến Mãi</div> 
                   	<div class="col-md-8"> 
                       <input type="text" name="giakhuyenmai" value="<?php echo $rsProducts[0]->PromotionPrice; ?>" class="form-control" width="60%"/>
                    </div>
                </div>
                <div class="row" style="margin-top:15px">
                	<div class="col-md-2">Số Lượng</div> 
                   	<div class="col-md-8"> 
                       <input type="text" name="soluong" value="<?php echo $rsProducts[0]->count; ?>" class="form-control" width="60%"/>
                    </div>
                </div>
                <div class="row" style="margin-top:15px">
                	<div class="col-md-2">Hình ảnh</div> 
                   	<div class="col-md-5">
                        <input type="file" name="hinhanh" class="form-control" value="<?php echo $rsProducts[0]->image; ?>"/>                        
                    </div>
                </div>
                <div class="row" style="padding-top:15px">
                    	<div class="col-md-2">Hình ảnh phụ 1</div> 
                       	<div class="col-md-5"><input type="file" name="hinhanhphu[]" class="form-control"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<div class="col-md-2">Hình ảnh phụ 2</div> 
                       	<div class="col-md-5"><input type="file" name="hinhanhphu[]" class="form-control"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<div class="col-md-2">Hình ảnh phụ 3</div> 
                       	<div class="col-md-5"><input type="file" name="hinhanhphu[]" class="form-control"/></div>
                    </div>
                    <div class="row" style="padding-top:15px">
                    	<div class="col-md-2">Hình ảnh phụ 4</div> 
                       	<div class="col-md-5"><input type="file" name="hinhanhphu[]" class="form-control"/></div>
                    </div>
                    <div class="row" style="margin-top:15px">
                    	<div class="col-md-2">Hình ảnh phụ 5</div> 
                       	<div class="col-md-5"><input type="file" name="hinhanhphu[]" class="form-control"/></div>
                    </div>
                <div class="row" style="margin-top: 15px">
                	<div class="col-md-2">Mô tả</div> 
                   	<div class="col-md-10">
                        <textarea name="description" class="form-control" rows="15" class="mota">
                        <?php echo $rsProducts[0]->description; ?> </textarea>                        
                    </div>
                </div>
                <input type="hidden" name="hinhcu" value="<?php echo $rsProducts[0]->image; ?>" />
                <input type="hidden" name="hinhphucu[]" value="<?php echo $rsProducts[0]->image1; ?>" />
                <input type="hidden" name="hinhphucu[]" value="<?php echo $rsProducts[0]->image2; ?>" />
                <input type="hidden" name="hinhphucu[]" value="<?php echo $rsProducts[0]->image3; ?>" />
                <input type="hidden" name="hinhphucu[]" value="<?php echo $rsProducts[0]->image4; ?>" />
                <input type="hidden" name="hinhphucu[]" value="<?php echo $rsProducts[0]->image5; ?>" />
                <div class="row" style="margin-top:3px;margin-left:52%"> 
                	<button type="submit" name="submit" class="btn" style="background-color:darkblue;color:#FFF"> Lưu </button> 
               	</div>        
            </div>
            <div class="col-md-2">
                
                <img src="../Views/img/<?php echo $rsProducts[0]->image; ?>" width="100%"/>
            </div>
        </div>
    </form>
 </div> 
<?php
	return ob_get_clean();
?>