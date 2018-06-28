<?php
session_start();
include_once '../Errors/mvcexception.php';
/**
 * Hàm này tự động tìm các tập tin có cùng tên với class và nạp vào file đang thiếu class đó 
 * 
 */

spl_autoload_register(function ($class) {
    $model_dir = '../Models/' . $class . '_table.php';
    if(file_exists($model_dir) == true){
        include_once $model_dir;
    }   
    $lib_dir = '../Libs/' . $class . '_lib.php';
    if(file_exists($lib_dir) == true)
        include_once $lib_dir;
    
    $error_dir = '../Errors/' . $class . '.php';
    if(file_exists($error_dir) == true)
        include_once $error_dir;
    
});

?>