<?php
session_start();
require_once APP_ROOT . "/services/UserService.php";
require_once APP_ROOT ."/services/NewsService.php";
class AuthColtroller {
    public function index() {
        include APP_ROOT . "/views/admin/login.php";
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user_services = new UserService();
            $user = $user_services->getUser($username, $password);
            if($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $news_services = new NewsService();
                $news = $news_services->getAllNews();

                if($user['role'] === 0) {
                    header("Location: ?controller=admin&action=dashboard");
                }
                exit();
            } else {
                $error = "Tài khoản hoặc mật khẩu không đúng!";
                $_SESSION['error'] = "Invalid username or password.";
                exit();
            }
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: /admin/login.php");
        exit();
    }
}