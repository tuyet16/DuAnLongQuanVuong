<?php
	ob_start();
?>

    <table class="table table-bordered table-striped">
      <tr style="background-color:darkblue;color:#FFF">
        <td>&nbsp; STT</td>
        <td>&nbsp; Tên Khách hàng</td>
        <td>&nbsp; Loại ship </td>
        <td>&nbsp; Tinh trạng</td>
        <td>&nbsp; Đơn giá </td>
        <td>&nbsp; Thời gian đặt hàng</td>
        <td>&nbsp; Chi Tiết</td>
      </tr>
      <div id="accordion">
      <tr>
        <td colspan="7" style="color: red;"><h4>Ngày 28/6/2018</h4></td>
      </tr>
      
          <tr>
            <td>&nbsp;1</td>
            <td>&nbsp;Nguyễn Văn Anh</td>
            <td>&nbsp;Thường</td>
            <td>&nbsp;Chưa ship</td>
            <td>&nbsp;30.000</td>
            <td>&nbsp;28/6/2018</td>
            <td>             
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseOne">
                    Xem
                </a>
            </td>
            
        </tr>
        <form method="post" action="">
        <tr>
            <td colspan="7">
             <div class="card">
                <div id="collapseOne" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Số điện thoại: 0985437443</label>
                        </div>
                        <div class="col-md-6">
                            <label>Địa chỉ: 215 Điện Biên Phủ, quận Binh Thạnh</label>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered table-striped text-center">
                            <tr style="background-color:green; color: white; ">
                                <td>STT</td>
                                <td>Tên sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Đơn vị</td>
                                <td>Giá</td>
                                <td>Giảm giá</td>
                                <td>Thành tiền</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Son lỳ 3CE</td>
                                <td><input type="text" name="soluong" value="3" /></td>
                                <td>thỏi</td>
                                <td>330.000</td>
                                <td><select>
                                    <option value="0">0%</option>
                                    <option value="1">5%</option>
                                    <option value="2">10%</option>
                                    <option value="3">15%</option>
                                    <option value="4">20%</option>
                                </select></td>
                                <td>990.000</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Sầu riêng</td>
                                <td><input type="text" name="soluong" value="5" /></td>
                                <td>Kg</td>
                                <td>330.000</td>
                                <td><select>
                                    <option value="0">0%</option>
                                    <option value="1">5%</option>
                                    <option value="2">10%</option>
                                    <option value="3">15%</option>
                                    <option value="4">20%</option>
                                </select></td>
                                <td>990.000</td>
                            </tr>
                        </table>
                        <div class="text-right"><button type="submit" class="btn btn-success">Gửi đơn hàng</button></div>
                    </div>
                    
                    </div>    
                  </div>
                </div>
              </div>
            </td>
        </tr>
        
        </form>
        <tr>
            <td>&nbsp;1</td>
            <td>&nbsp;Nguyễn Văn Binh</td>
            <td>&nbsp;VIP</td>
            <td>&nbsp;Chưa ship</td>
            <td>&nbsp;30.000</td>
            <td>&nbsp;28/6/2018</td>
            <td>  
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                    Xem
                </a>       
            </td>
        </tr>
        <tr>
            <td colspan="7">
            <div class="card">
                
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    Lorem ipsum..
                  </div>
                </div>
              </div>
            </td>
        </tr>
        <tr>
            <td>&nbsp;1</td>
            <td>&nbsp;Nguyễn Văn Binh</td>
            <td>&nbsp;VIP</td>
            <td>&nbsp;Chưa ship</td>
            <td>&nbsp;30.000</td>
            <td>&nbsp;28/6/2018</td>
            <td>  
                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse3">
                    Xem
                  </a>         
                
            </td>
        </tr>
        <tr >
            <td colspan="7">
            <div class="card">
                
                <div id="collapse3" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    Lorem ipsum..
                  </div>
                </div>
              </div>
            </td>
        </tr>
        <tr>
            <td>&nbsp;1</td>
            <td>&nbsp;Nguyễn Văn Binh</td>
            <td>&nbsp;VIP</td>
            <td>&nbsp;Chưa ship</td>
            <td>&nbsp;30.000</td>
            <td>&nbsp;28/6/2018</td>
            <td>  
                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse3">
                    Xem
                  </a>         
                
            </td>
        </tr>
        <tr>
            <td colspan="7">
            <div class="card">
                
                <div id="collapse3" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    Lorem ipsum..
                  </div>
                </div>
              </div>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="color: red; text-align: center;font-weight: bolder;font-size: 130%;">Tổng tiền</td>
            <td style="color: blue;background-color: #FDE1FD;"><b>120.000</b></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="7" style="color: red; font-weight: bolder; font-size: 120%;text-align: center;">THỐNG KÊ SỐ LƯỢNG</td></tr>
        <tr style="background-color: green ; color: white;">
            <td>STT</td>
            <td colspan="3">Tên sản phẩm</td>
            <td colspan="2">Tổng số lượng</td>
            <td>Đơn vị</td>
        </tr>
        <tr>
            <td>1</td>
            <td colspan="3">son 3CE</td>
            <td colspan="2">20</td>
            <td>thỏi</td>
        </tr>
        <tr>
            <td>1</td>
            <td colspan="3">Sầu Riêng</td>
            <td colspan="2">5</td>
            <td>Kg</td>
        </tr>         
   </div>
        

</table>


  
  
<?php
	return ob_get_clean();
?>