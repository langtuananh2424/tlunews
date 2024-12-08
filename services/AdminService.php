<?php
require_once APP_ROOT."/Utilities/Database.php";

class AdminService {
    public function addNew($title, $content, $image, $created_at, $category_id) {
        try {
            $conn = DataBase::connectDb();
            $stmt = $conn->prepare("
                INSERT INTO news (title, content, image, created_at, category_id)
                VALUES (:title, :content, :image, :created_at, :category_id)
            ");
            $stmt->bindParam("title", $title, PDO::PARAM_STR);
            $stmt->bindParam("content", $content, PDO::PARAM_STR);
            $stmt->bindParam("image", $image, PDO::PARAM_STR);
            $stmt->bindParam("created_at", $created_at, PDO::PARAM_STR);
            $stmt->bindParam("", $category_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    public function deleteNews($id) {
        try {
            $conn = DataBase::connectDb();
            $stmt = $conn->prepare("DELETE FROM news WHERE id = :id");
            $stmt->bindParam("id", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "". $e->getMessage();
        }
    }

    public function editNews($id, $title, $content, $image, $created_at, $category_id) {
        try {
            $conn = DataBase::connectDb();
            $stmt = $conn->prepare("UPDATE news SET title = :title, content = :content, create_at = :create_at, category_id = :category_id");
            $stmt->bindParam("id", $id, PDO::PARAM_INT);
            $stmt->bindParam("title", $title, PDO::PARAM_STR);
            $stmt->bindParam("content", $content, PDO::PARAM_STR);
            $stmt->bindParam("image", $image, PDO::PARAM_STR);
            $stmt->bindParam("created_at", $created_at, PDO::PARAM_STR);
            $stmt->bindParam("category", $category_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "". $e->getMessage();
        }
    }
}
?>