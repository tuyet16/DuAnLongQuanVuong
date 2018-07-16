<?php
	ob_start();
?>
    	<fieldset>
        	<legend style="80%">Thêm sản phẩm</legend>
                <form method="post" action="?action=themsanpham" enctype="multipart/form-data">
                    <div class="row">
                    	<div class="col-md-2">Tên sản phẩm</div> 
                       	<div class="col-md-5"> <input type="text" name="tensp" class="form-control" width="60%"/></div>
                    </div>
                     <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Loại sản phẩm</div> 
                       	<div class="col-md-5">
                            <select name="categoryID" class="form-control">
                            <?php foreach($dsCategories as $product)
                            {
                            ?>
                                <option value="<?php echo $product->categoryID ; ?>"><?php echo $product->categoryName; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                     <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Đơn vị tính</div> 
                       	<div class="col-md-5">
                            <select name="unitID" class="form-control">
                            <?php foreach($dsUnits as $unit)
                            {
                            ?>
                                <option value="<?php echo $unit->unitID ; ?>"><?php echo $unit->unitName; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Giá</div> 
                       	<div class="col-md-5"> <input type="text" name="gia" class="form-control" width="60%"/></div>
                    </div>
                    <div class="row" style="margin-top:2px">
                    	<div class="col-md-2">Hình ảnh</div> 
                       	<div class="col-md-5"><input type="file" name="hinhanh" class="form-control"/></div>
                    </div>
                    <div class="row" style="margin-top:3px;margin-left:52%"> 
                    	<button type="submit" class="btn" style="background-color:darkblue;color:#FFF"> Lưu </button> 
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