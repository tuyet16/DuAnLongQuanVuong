<?php
	ob_start();
?>

<div class="container" style="margin-bottom: 50px;">
  <form method="post" action="?action=dathang">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
         <legend style="color: RED;">THÔNG TIN NGƯỜI NHẬN</legend> 
            <div class="row">
                <label class="control-label">Họ tên người nhận</label>
                <input type="text" name="hoten" class="form-control" />
            </div>
            <div class="row">
                <label class="control-label">Điện thoại di động</label>
                <input type="text" name="dienthoai" class="form-control" />
            </div>
            <div class="row">
                <label class="control-label">Quận/Huyện</label>                
                <select name="quan" class="form-control">
                <?php foreach($DSdistrict as $row){ ?>
                    <option value="<?php echo $row->districtID; ?>"><?php echo $row->districtName; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="row">
                <label class="control-label">Địa chỉ</label>
                <input type="text" name="diachi" class="form-control" />
            </div>
             <div class="row">
                <label class="control-label">Phương thức giao hàng</label>
                <select name="giaohang" class="form-control">
                    <option value="thuong">Giao thường</option>
                    <option value="nhanh">Giao nhanh</option>
                </select>
            </div>
            <div class="row" style="margin-top: 2%;">
                <input type="text" name="email" class="form-control" placeholder="Email nhận thông báo(Không bắt buộc)" />
            </div>
        </div>
        <div class="col-md-2"></div>
        </div>
        
        <div class="row text-center" style="padding: 10px;">
            <input type="submit" class="btn btn-danger" value="ĐẶT HÀNG"/>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="border: 1px solid black;">
                <legend style="color:red;">THÔNG TIN ĐƠN HÀNG</legend>
    
                 <table class="table table-hover">
            <tr>
                <td>Sản Phẩm</td>
                <td>Số lượng</td>
                <td>Giá Thành</td>
                <td>Thành Tiền</td>
                <td></td>
            </tr>
            <?php foreach($rsCart as $row){ ?>            
            <tr>
                <td>
                    <div class="row">
                        <div class="col-md-3"><?php echo '<img src="../Views/img/'.$row['hinhanh'].'" width="60%"/>'; ?></div>
                        <div class="col-md-9"><?php echo $row['name']; ?></div>
                    </div>                
                </td>
                <td><label><?php echo $row['soluong']; ?></label></td>
                <td><?php echo number_format($row['gia']); ?></td>
                <td><?php echo number_format($row['thanhtien']); ?></td>
                
            </tr>
            <?php }?>
            <tr>
                <td colspan="3" class="text-right" style="color: red; font-weight: bold;">Tổng tiền</td>
                <td style="color: blue; font-weight: bold;"><?php echo number_format($tongtien);?></td>
            </tr>       
                
        </table>
            <div class="col-md-2"></div>
        </div>
    </form>
</div>

<?php
	return ob_get_clean();
?>