<?php
require_once APP_ROOT."/services/AdminService.php";
require_once APP_ROOT."/services/NewsService.php";

class AdminController{
    public function dashboard(){
        $news_services = new NewsService();
        $news = $news_services->getAllNews();
        include APP_ROOT."views/admin/dashboard.php";
    }

    public function add(){
        $news_services = new NewsService();
        $categories = $news_services->getAllCategories();
        include APP_ROOT."/views/admin/news/add.php";
    }

    public function edit(){
        $news_services = new NewsService();
        $id = $_GET['id'];
        $news = $news_services->getById($id);
        $categories = $news_services->getAllCategories();
        include APP_ROOT."/views/admin/news/edit.php";
    }

    public function delete(){
        $id = $_GET["id"];
        $admin_services = new AdminService();
        $admin_services->deleteNews($id);
        header("Location: ?controller=admin&action=dashboard");
    }

    public function addNews(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $admin_services = new AdminService();
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = "/".$_FILES["image"]["name"];
            $created_at = $_POST["created_at"];
            $category_id = $_POST["category_id"];
            $admin_services->addNew($title, $content, $image, $created_at, $category_id);
            header("Location: ?controller=admin&action=dashboard");
        }
    }

    public function editNews(){
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $admin_services = new AdminService();
            $id = $_POST["id"];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = "/".$_FILES['image']['name'];
            $created_at = $_POST['created_at'];
            $category_id = $_POST['category_id'];
            $admin_services->editNews($id, $title, $content, $image, $created_at, $category_id);
            header("Location: ?controller=admin&action=dashboard");
        }
    }
}
?>