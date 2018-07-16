<?php ob_start();
?>
    <fieldset>
        <legend><img src="../Views/img.cart2.jpg"/>GIỎ HÀNG</legend>
        <h5>Bán từ Shop: Long Quân</h5>
        <form method="post" action="?action=updatecart">
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
                <td><input type="number" class="form-control" style="width: 60%;" min="1" max="20" name="<?php echo $row['masp']; ?>" value="<?php echo $row['soluong']; ?>"/></td>
                <td><?php echo number_format($row['gia']); ?></td>
                <td><?php echo number_format($row['thanhtien']); ?></td>
                <td><a href="../Controllers/shoppingcart_controller.php?action=deletecart&id=<?php echo $row['masp']; ?>">Xóa</a></td>
            </tr>
            <?php }?>
            <tr>
                <td colspan="2" class="text-right">
                <input type="submit" name="submit" class="btn btn-primary" value="Cập Nhật" />
                </td>
                <td class="text-right" style="color: red; font-weight: bold;">Tổng tiền</td>
                <td colspan="2" style="color: blue; font-weight: bold;"><?php echo number_format($tongtien);?></td>
            </tr>       
                
        </table>
        <div class="text-center"><a class="btn btn-danger">ĐẶT HÀNG</a></div>
        </form>
    </fieldset>


<?php return ob_get_clean(); ?>