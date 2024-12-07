<?php
require_once APP_ROOT. "/services/NewsService.php";

class HomeController {
    public function index() {
        $n = new NewsService();
        $news = $n -> getAllNews();
        $categories = $n->getAllCategories();
        include APP_ROOT. "views/home/index.php";
    }
}
?>
