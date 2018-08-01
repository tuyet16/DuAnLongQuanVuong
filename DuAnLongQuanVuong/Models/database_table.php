<?php
class Database{
    //private $dsn = 'mysql:dbname=my_guitar_shop2;host=localhost';
    private $dsn = '';
    private $username = '';
    private $password = '';
    private $conn = null;

    public function __construct() {
        try{
            $config = parse_ini_file('../Config/config.ini', true);
            $this->dsn = 'mysql:dbname=' . $config['database']['name'] . ';host=' . $config['database']['host'];
            $this->username = $config['database']['username'];
            $this->password = $config['database']['password'];
            $this->conn = new PDO($this->dsn, $this->username, $this->password);
            
        } catch (PDOException $ex) {
            $message = $ex->getMessage();
            $error_file = $ex->getFile();
            $error_line = $ex->getLine();
            $GLOBALS['template']['content'] = include_once '../Errors/404.php';
            $GLOBALS['template']['title'] = 'MVC Error';
            include_once '../template/index.php';
            exit();
        }
    }
    public function getconnect()
    {
        return $this->conn;
    }
    public function doQuery($strQuery, $param = null){
        if($param == null){
            $rs = $this->conn->prepare($strQuery);
            $rs->execute();
        }
        else{
            $rs = $this->conn->prepare($strQuery);
            for($i = 0; $i < count($param); $i++){
                $rs->bindParam($i+1, $param[$i]);
            }
            $rs->execute();
        }
        return $rs->fetchAll(PDO::FETCH_OBJ);
    }
     public function doQuery1($strQuery, $param = null){
        if($param == null){
            $rs = $this->conn->prepare($strQuery);
            $rs->execute();
        }
        else{
            $rs = $this->conn->prepare($strQuery);
            for($i = 0; $i < count($param); $i++){
                $rs->bindParam($i+1, $param[$i]);
            }
            $rs->execute();
        }
        return $rs;
    }
    public function getTables()
    {
        $strQuery = 'SHOW TABLES';
        $rs = $this->doQuery($strQuery);
        return $rs;
    }
    public function __destruct() {
        $this->conn = null;
    }
}

