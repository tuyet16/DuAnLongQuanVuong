<?php
	ob_start();
?>
<fieldset>
	<legend style="80%">Thêm sản phẩm</legend>
        <form method="post" action="?action=suasanpham" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-9">                   
                <input type="hidden" name="productID" value="<?php echo $rsProducts[0]->productID;?>" />
                <div class="row">
                	<div class="col-md-2">Tên sản phẩm</div> 
                   	<div class="col-md-8"> <input type="text" name="tensp" class="form-control" value="<?php echo $rsProducts[0]->productName; ?>"/></div>
                </div>
                 <div class="row" style="margin-top:2px">
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
                 <div class="row" style="margin-top:2px">
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
                <div class="row" style="margin-top:2px">
                	<div class="col-md-2">Giá</div> 
                   	<div class="col-md-8"> <input type="text" name="gia" value="<?php echo $rsProducts[0]->price; ?>" class="form-control" width="60%"/></div>
                </div>
                <div class="row" style="margin-top:2px">
                	<div class="col-md-2">Hình ảnh</div> 
                   	<div class="col-md-8">
                        <input type="file" name="hinhanh" class="form-control" value="<?php echo $rsProducts[0]->image; ?>"/>                        
                    </div>
                </div>
                <input type="hidden" name="hinhcu" value="<?php echo $rsProducts[0]->image; ?>" />
                <div class="row" style="margin-top:3px;margin-left:52%"> 
                	<button type="submit" name="submit" class="btn" style="background-color:darkblue;color:#FFF"> Lưu </button> 
               	</div>        
            </div>
            <div class="col-md-2">
                
                <img src="../Views/img/<?php echo $rsProducts[0]->image; ?>" width="100%"/>
            </div>
        </div>
    </form>
</fieldset>
        <fieldset>
        	<legend>Danh sách sản phẩm của shop</legend>
                <table class="table table-bordered table-striped">
                  <tr style="background-color:darkblue;color:#FFF">
                    <td>&nbsp; STT</td>
                    <td>&nbsp; Tên sản phẩm</td>
                    <td>&nbsp; Loại sản phẩm</td>
                    <td>&nbsp; Đơn vị tính</td>
                    <td>&nbsp; Giá </td>
                    <td>&nbsp; Hình ảnh </td>
                    <td>&nbsp; Thao tác</td>
                  </tr>
                  
                  <?php
		  	   $i=1;
				foreach($dsProducts as $row){
					echo '<tr>
					<td>&nbsp;'.$i++.'</td>
					<td>&nbsp;'.ucfirst($row->productName).'</td>
					<td>&nbsp;'.$row->categoryID.'</td>
					<td>&nbsp;'.$row->unitID.'</td>
                    <td>&nbsp;'.$row->price.'</td>
                    <td><img src="../Views/img/'.$row->image.'" width="30%"/></td>
					<td><a href="../Controllers/products_controller.php?action=suasanpham&id='.$row->productID.'"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; 
						<a href="../Controllers/products_controller.php?action=xoasanpham&id='.$row->productID.'"><span class="glyphicon glyphicon-remove"></span></a></td>
				  </tr>';
			}
		  ?>
                </table>
        </fieldset>
<?php
	return ob_get_clean();
?>