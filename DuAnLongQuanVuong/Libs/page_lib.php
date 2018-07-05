<?php
class Page{
    /**
     * Hàm dùng để tạo phân trang cho tập hợp dữ liệu, thường sử dụng trong trang index liệt kê sản phẩm
     * $rs là toàn bộ dữ liệu lấy từ bảng bất kỳ
     * $limit mỗi trang hiển thị 5 sản phẩm
     * $_GET['start'] dùng để xác định trang thứ mấy 
     * 
     * 
     */
    public static function createPagination($rs, $limit=5)
    {
        //Kiểm tra URL có tham số hay không, nếu chưa thì dùng dấu ? , nếu có thì dùng dấu &
        if(!isset($_SERVER['QUERY_STRING']))
            $mark = '&';
        else
            $mark = '?';
        $pages = '<ul class="pagination">';
        $number = count($rs);
        $active_page = 0;
        if(isset($_GET['start']))
        {
            $active_page = $_GET['start'];
        }
        $num_page = ceil($number/$limit);
        if($num_page > 1){
            for($i = 0; $i < $num_page; $i++){
                $start = $i * $limit;
                if($start != $active_page)
                    $pages .= "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . $mark. "start=" . ($start) . "'>" . ($i+1) . "</a></li>";
                else
                    $pages .= "<li class='page-item active'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . $mark . "start=" . ($start) . "'>" . ($i+1) . "</a></li>";
            }
        }
        $pages .= '</ul>';
        return $pages;
    }
    /**
     * http://localhost/test/Controllers/products_controller.php?action=add_product_form
     * Mục tiêu : cắt chuỗi trên sao cho được products và add_product_form
     * $_SERVER['PHP_SELF'] chứa http://localhost/test/Controllers/products_controller.php
     * $_SERVER['QUERY_STRING'] chứa action=add_product_form
     * 
     * Hàm có tham số mặc định menu nếu website có dùng menu thì truyền tên menu còn không thì bỏ trống
     */
    public static function View($menu=null)
    {
        if($menu == null)
        {
            $path = $_SERVER['PHP_SELF'];
            //Cắt chuỗi http://localhost/test/Controllers/products_controller.php theo dấu '/'
            $pathArr = explode('/',$path); 
            
            //Chọn phần tử cuối cùng của mảng vừa cắt để lấy products_controller.php
            $path = $pathArr[count($pathArr)-1];
            
            //Cắt chuỗi products_controller.php thành mảng theo dấu '_'
            $pathArr = explode('_', $path);
            //Lấy phần tử đầu của mảng pathArr chứa chuối products
            $path = $pathArr[0];
            
            //Kiểm tra có action không ? nếu không thi mặc định view 'index'
            if(isset($_SERVER['QUERY_STRING'])){
                
                //Lưu action=add_product_form
                $query_string = $_SERVER['QUERY_STRING'];
                
                //Kiểm tra có chứa '&'
                if(strpos($query_string, '&')){
                    
                    //Cắt chuỗi action=add_product_form&cateID=2 thành mảng theo dấu & nếu có dấu &
                    $query_stringArr = explode('&', $query_string);
                    
                    $query_stringArr = $query_stringArr[0];
                }
                else
                {
                    //Gán action=add_product_form cho biến $query_stringArr 
                    $query_stringArr = $query_string;
                }
                
                //Tìm chuỗi 'action' trong chuỗi action=add_product_form
                if(strpos($query_stringArr, 'action') > -1){
                    $pattern = array('/action/', '/=/');
                    
                    //Xóa chuỗi action và dấu = để lấy chuỗi add_product_form 
                    $query_string = trim(preg_replace($pattern,'',$query_stringArr));
                }
                else{
                    //Không tìm thấy chuỗi action trong chuỗi action=add_product_form thì mặc định view index
                    $query_string = 'index';
                }
            }
            else
            {
                $query_string = 'index';
            }
            
        }
        else
        {
            $path = $_SERVER['PHP_SELF'];
            $pathArr = explode('/',$path);
            $path = $pathArr[count($pathArr)-1];
            $pathArr = explode('_', $path);
            $path = $pathArr[0];
            $query_string = $menu;
        }
        
        return '../Views/' . $path . '/' . $query_string . '.php';
    }
}
?>