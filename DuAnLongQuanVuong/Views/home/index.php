<?php
ob_start();
?>
<h3 class="text-info text-capitalize">Bảng Giá Dịch Vụ</h3>
        <table class="table table-hover" style="border: 1px solid black;">
            <tr>
                <td>Quận/huyện</td>
                <td>Mã KV</td>
                <td>Số Km vuợt quá</td>
                <td>Giao thuờng
                    (120p phút)</td>
                <td>Giao nhanh<br/>
                    (90 phút)</td>
                <td>Lưu ý</td>
            </tr>
            <tr>
                <td>Quận 5</td>
                <td>1</td>
                <td> </td>
                <td>15k</td>
                <td>20</td>
                <td rowspan="6">Thời gian giao từ 16h-21h là 120 phút</td>
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


<?php
return ob_get_clean();
?>