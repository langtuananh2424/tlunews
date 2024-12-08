<?php
class News {
    private $db;

    public function __construct() {
        // Kết nối cơ sở dữ liệu
        $this->db = new PDO('mysql:host=localhost;dbname=tintuc', 'nsh', '1234');
    }

    public function getAllNews() {
        // Lấy tất cả các bài viết
        $stmt = $this->db->query('SELECT * FROM news');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Các hàm khác: addNews, getNewsById, updateNews, deleteNews
}