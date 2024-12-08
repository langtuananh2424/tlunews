<?php
require_once "../models/News.php";
require_once "../models/Category.php";
require_once "../Utilities/Database.php";

class NewsService{
    public function getAllNews(){
        try {
            $conn = DataBase::connectDb();
            $stmt = $conn->prepare("SELECT * FROM news");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $news_ = [];
            foreach($result as $row){
                $new = new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
                $news_[] = $new;
            }
            return $news_;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function getById($id){
        try {
            $conn = DataBase::connectDb();
            $stmt = $conn->prepare("SELECT * FROM news WHERE id = :id");
            $stmt->bindParam("id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result){
                return new News(
                    $result["id"], $result["title"], $result["content"], $result["image"], $result["created_at"], $result["category_id"]
                );
            }
            return $result;
        } catch (PDOException $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public function getAllCategories(){
        try {
            $conn = DataBase::connectDb();
            $stmt = $conn->prepare("SELECT * FROM categories");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $categories_ = [];
            foreach ($result as $row){
                $categories = new Category($row['id'], $row['name']);
                $categories_[] = $categories;
            }
            return $categories_;
        } catch (PDOException $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public function getByCategoryId($category_id) {
        try {
            $conn = DataBase::connectDb();
            $stmt = $conn->prepare("SELECT * FROM news WHERE category_id = :category_id");
            $stmt->bindParam("category_id", $category_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $news_c = [];
            foreach ($result as $row){
                $news = new News($row['id'], $row['title'], $row['content'], $row['image'], $row['created_at'], $row['category_id']);
                $news_c[] = $news;
            }
            return $news_c;
        } catch (PDOException $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public function getNewsCount() {
        try {
            $conn = DataBase::connectDb();
            $stmt = $conn->prepare("SELECT COUNT(id) FROM news");
            $stmt->execute();
            $news_count = $stmt->fetch(PDO::FETCH_ASSOC);
            return $news_count;
        } catch (PDOException $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public function getUserCount() {
        try {
            $conn = DataBase::connectDb();
            $stmt = $conn->prepare("SELECT COUNT(id) FROM users where role = 1");
            $stmt->execute();
        } catch (PDOException $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public function getCategoryCount() {
        try {
            $conn = DataBase::connectDb();
            $stmt = $conn->prepare("SELECT COUNT(id) FROM categories");
            $stmt->execute();
            $category_count = $stmt->fetch(PDO::FETCH_ASSOC);
            return $category_count;
        } catch (PDOException $th) {
            echo $th->getMessage();
            return null;
        }
    }
}
?>