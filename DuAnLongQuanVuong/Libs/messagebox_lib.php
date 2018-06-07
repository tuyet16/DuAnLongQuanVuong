<?php
define('MB_ALERT',2);
define('MB_CONFIRM',3);
class MessageBox{    
    public static function Show($str='Message Box', $type = MB_ALERT){
        echo "<script type='text/javascript'>";
        switch($type){
            case MB_ALERT:
                echo "alert('{$str}')";
            break;
            case MB_CONFIRM:
                ?>
                var r = confirm('<?php echo $str;?>');
                if(r == true)
                    window.location.href = '<?php 
                                            if(isset($_SERVER['QUERY_STRING']))
                                                echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
                                            else
                                                echo $_SERVER['PHP_SELF'];    
                                            ?>&confirm=' + r;
                else
                    window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>';
                
                <?php
            break;
        }
        echo "</script>";
    }
}

?>