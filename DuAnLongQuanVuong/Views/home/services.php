<?php
ob_start();
?>
<h3 class="text-info text-capitalize"><div class="well well-sm">Bảng Giá Dịch Vụ</div></h3>
        <h4 style="color: red;"><b>* Lưu ý:</h4> </b>
                    <h4 style="margin-left: 10%;">Thời Gian nhận hàng cho quý khách hàng: Từ 8 giờ đến 21 giờ mỗi ngày</h4>
                    <h4><b style="margin-left: 17%;">(Từ 16 giờ đến 21 giờ phụ thu thêm 5.000đ/đơn tháng)</b></h4>
                    <h4 style="margin-left: 20%;">Thời gian giao nhanh từ 16h - 21h là 120 phút </h4>
        <div class="row">
        <table class="table table-bordered" style="border: 1px solid black;">
            <tr style="background-color: darkblue; color: white;">
                <td>Quận/huyện</td>
                <td>Mã KV</td>
                <td>Số Km vuợt quá</td>
                <td>Giao thuờng(120p phút)</td>
                <td>Giao nhanh(90 phút)</td>
            </tr>
            <tr>
                <td>Quận 5</td>
                <td>1</td>
                <td> </td>
                <td>15k</td>
                <td>20</td>
                
            </tr>
             <tr>
                <td>Quận 1,Quận 3,Quận 4,Quận 6,Quận 8,Quận 10</td>
                <td>2</td>
                <td>6 Km</td>
                <td>25k</td>
                <td>30k</td>
            </tr>
            <tr>
                <td>Tân Phú,Tân Bình,Bình Thạnh,Phú Nhuận,Quận 7,Quận 11</td>
                <td>3</td>
                <td>8 Km</td>
                <td>30k</td>
                <td>35k</td>
            </tr>
            <tr>
                <td>Quận 2,Bình Tân,Gò Vấp</td>
                <td>4</td>
                <td>10 Km</td>
                <td>35k</td>
                <td>40k</td>
            </tr>
            <tr>
                <td>Quận 12,Thủ Ðức,Quận 9,Bình Chánh</td>
                <td>5</td>
                <td>12 Km</td>
                <td>40k</td>
                <td>50</td>
            </tr>
            <tr>
                <td>Hóc Môn, Nhà Bè</td>
                <td>6</td>
                <td>12 Km</td>
                <td>45k</td>
                <td>60</td>
            </tr>            
        </table>
        </div>
    <div class="row">
    <h3 class="text-info text-capitalize"><div class="well well-sm">Phí ứng trước chủ hàng</div></h3>
        <table class="table table-bordered" style="border: 1px solid black;">
            <tr style="background-color: darkblue; color: white;">
                <td>Số Tiền</td>
                <td>Phí Ứng Tiền</td>
            </tr>
            <tr>
                <td>< 1 triệu</td>
                <td>-</td>
            </tr>
            <tr>
                <td> >= 2 triêu</td>
                <td>16.000</td>                
            </tr>
             <tr>
                <td> >= 3 triêu</td>
                <td>24.000</td>                
            </tr>
             <tr>
                <td> >= 4 triêu</td>
                <td>32.000</td>                
            </tr>
             <tr>
                <td> >= 5 triêu</td>
                <td>40.000</td>                
            </tr>
        </table>
    </div>
    <div class="row">
    <h3 class="text-info text-capitalize"><div class="well well-sm">Phụ thu phí ship</div></h3>
        <table class="table table-bordered" style="border: 1px solid black;">
            <tr style="background-color: darkblue; color: white;">
                <td>Khối lượng hàng không vượt quá</td>
                <td>10kg(Trên 10kg, phụ thu 1k/kg)</td>
            </tr>
            <tr>
                <td>Kích thước hàng hóa</td>
                <td>50cm x 50cm x 50cm</td>
            </tr>
            <tr>
                <td>Giá trên chưa bao gồm</td>
                <td>Phí gửi chành, gửi xe, phí giao tận tay cho khách hàng tại cao ốc</td>                
            </tr>
            
        </table>
    </div>


<?php
return ob_get_clean();
?>