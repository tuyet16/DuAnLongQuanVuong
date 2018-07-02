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
                                <td>Giá</td>
                                <td>Thành tiền</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Son lỳ 3CE</td>
                                <td>3</td>
                                <td>330.000</td>
                                <td>990.000</td>
                            </tr>
                            
                        </table>
                        <div class="row">
                        <div class="col-md-3 text-right">
                            <div class="row">
                            Chọn nhân viên: 
                                <select>
                                    <option>Nguyễn Văn A</option>
                                    <option>Nguyễn Văn b</option>
                                </select>
                            </div>
                            <div class="row">
                                Phí Ship: 
                                30.000đ
                            </div>
                        </div>
                            <div class="col-md-2"><input type="radio" name="dagiao" value="" /> Đã Giao</div>
                            <div class="col-md-2"><input type="radio" name="chuagiao" value="" /> Chưa Giao</div>
                            <div class="col-md-2"><input type="radio" name="huydon" value="" /> Hủy đơn hàng</div>
                            <div class="col-md-3 text-center"><button type="submit" class="btn btn-success">Gửi đơn hàng</button></div>
                        </div>
                    </div>
                    </div>    
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
            <td colspan="7" style="color: red; background-color: white;"><h4>Ngày 28/6/2018</h4></td>
        </tr>
      
          <tr  style="background-color: #F5F5F5;">
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
        
        <tr  style="background-color: white;">
            <td colspan="7">
             <div class="card">
                <div id="collapseOne" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    Lorem ipsum..
                  </div>
                </div>
              </div>
            </td>
        </tr>
        <tr  style="background-color: #F5F5F5;"> 
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
        <tr  style="background-color: white;"> 
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
        <tr style="background-color: #F5F5F5;">
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
        <tr  style="background-color: white;">
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
        
        
   </div>
        

</table>
<div class="pull-right">
    <a href="../Controllers/employees_controller.php?action=bangluong"><input type="submit" name="in" value="Bảng lương nhân viên" class="btn btn-danger"/></a>    
    <a href="../Controllers/shop_controller.php?action=doanhthu"><input type="submit" name="in" value="Doanh Thu" class="btn btn-danger"/></a>
    <input type="submit" name="in" value="In đơn hàng" class="btn btn-danger"/>
</div>
  
<?php
	return ob_get_clean();
?>