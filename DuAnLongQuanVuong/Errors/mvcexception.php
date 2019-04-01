<?php
class MVCException extends Exception{
    public function __construct($message, $code = 0, Exception $previous = null )
    {
        parent::__construct($message, $code, $previous);
            $error_message = $message;
            $error_file = $this->getFile();
            $error_line = $this->getLine() - 1;
            $GLOBALS['template']['content'] = include_once '../Errors/404.php';
            $GLOBALS['template']['title'] = 'System Error';
            include_once '../template/index.php';
    }
    
}

?>