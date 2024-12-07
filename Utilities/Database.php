<?php
class Database {
    private static $host = "127.0.0.1";
    private static $username = "root";
    private static $password = "bamtu1den8";
    private static $dbname = "tintuc";
    public static function connect() {
    try{   
        $dsn = "mysql::host" .self::$host . ";dbname" . self::$dbname;
        $conn = new PDO($dsn,self::$username,self::$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch (PDOException $e){
        die( "Failed". $e->getMessage());
        }
    }
}
?>