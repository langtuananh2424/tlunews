<?php
class Database{
    public static function connectDb()
    {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=tintuc", "root", "root123456");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Kết nối thất bại: " . $e->getMessage());
    }
    
    }
}
?>