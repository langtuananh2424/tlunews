<?php
    require_once "../models/User.php";
    require_once "../Utilities/Database.php";

    class UserService {
        public function getUser($username, $password) {
            try {
                $conn = DataBase::connectDb();
                $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $stmt->bindParam("password", $password, PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                return $user;
            } catch (PDOException $e) {
                echo"". $e->getMessage();
                return null;
            }
        }
    }
?>