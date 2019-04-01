<?php
	ob_start();
?>

    <table class="table table-bordered table-striped">
      <tr style="background-color:darkblue;color:#FFF">
        <td>&nbsp; STT</td>
        <td>&nbsp; Tên nhân viên</td>
        <td>&nbsp; Số điện thoại</td>
        <td>&nbsp; Tổng tiền</td>        
        <td>&nbsp; Chi Tiết</td>
      </tr>
      <div id="accordion">  
      <tr>
        <td colspan="7" style="color: red;"><h4>Ngày 28/6/2018</h4></td>
      </tr>      
          <tr>
            <td>&nbsp;1</td>
            <td>&nbsp;Nguyễn Văn Anh</td>
            <td>&nbsp;0934654798</td>
            <td>&nbsp;200.000</td>
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
                        <legend>Danh Sách Đơn Hàng</legend>
                        <table class="table table-bordered table-striped text-center">
                            <tr style="background-color:green; color: white; ">
                                <td>STT</td>
                                <td>Khách hàng</td>
                                <td>Địa Chỉ</td>
                                <td>Thành Tiền</td>
                                <td>Phí ship</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Nguyễn Văn B</td>
                                <td>215 Điện Biên Phủ</td>
                                <td>990.00</td>
                                <td>30.000</td>
                            </tr>
                            
                        </table>
                    </div>
                    </div>    
                  </div>
                </div>
              </div>
            </td>
        </tr>
<?php
	return ob_get_clean();
?>