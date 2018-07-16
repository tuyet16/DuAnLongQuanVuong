<?php ob_start();?>
    <fieldset>
        <legend>Sửa Users</legend>
    
   	<div class="col-md-9">
        <form action="?action=suashop" method="post" id="signup">  
        <input type="hidden" name="userid" type="text" value="<?php echo $rsUsers[0]->userid; ?>" />         
            <div class="row">
                <div class="col-md-2">Họ và tên</div>
                <div class="col-md-10">
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $rsUsers[0]->fullname; ?>" required=""/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">Email</div>
                <div class="col-md-10"><input type="email" id="email" value="<?php echo $rsUsers[0]->email; ?>" name="email" placeholder="mail@example.com" class="form-control" required=""/></div>
            </div> 
              
            <div class="row">
                <div class="col-md-2">Tên Shop</div>
                <div class="col-md-10"><input type="text" id="tenshop" name="tenshop"value="<?php echo $rsUsers[0]->shopName; ?>" class="form-control" required=""/></div>
            </div> 
            <div class="row">
                <div class="col-md-2">Địa chỉ</div>
                <div class="col-md-10">
                    <input type="text" id="address" name="address" value="<?php echo $rsUsers[0]->address; ?>" class="form-control" required=""/></div>
            </div> 
            <div class="row">
                <div class="col-md-2">Địa chỉ</div>
                <div class="col-md-10">
                   <input type="tel" id="tel" name="tel" value="<?php echo $rsUsers[0]->phone; ?>" class="form-control" required=""/>
                </div>
            </div>          
            <input type="submit" name="submit" value="Lưu"/>
        </form>
    </div>
    </fieldset>
    <fieldset>
        	<legend>Danh sách sản phẩm của shop</legend>
                <table class="table table-bordered table-striped">
                  <tr style="background-color:darkblue;color:#FFF">
                    <td>&nbsp; STT</td>
                    <td>&nbsp; Họ và Tên</td>
                    <td>&nbsp; Email</td>
                    <td>&nbsp; Địa chỉ</td>
                    <td>&nbsp; Điện Thoại </td>
                    <td>Tên Shop</td>
                    <td>&nbsp; Thao tác</td>
                  </tr>
                  
                  <?php
		  	   $i=1;
				foreach($dsUsers as $row){
					echo '<tr>
					<td>&nbsp;'.$i++.'</td>
					<td>&nbsp;'.ucfirst($row->fullname).'</td>
					<td>&nbsp;'.$row->email.'</td>
					<td>&nbsp;'.$row->address.'</td>
					<td>&nbsp;'.$row->phone.'</td>
                    <td>&nbsp;'.$row->shopName.'</td>
					<td><a href="../Controllers/admin_controller.php?action=suashop&id='.$row->userid.'"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; 
						<a href="../Controllers/admin_controller.php?action=delete_user&id='.$row->userid.'"><span class="glyphicon glyphicon-remove"></span></a></td>
				  </tr>';
			}
		  ?>
                </table>
        </fieldset>

<?php return ob_get_clean(); ?>