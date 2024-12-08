<?php
    require_once APP_ROOT."/services/NewsService.php";
    class HomeController {
        public function index() {
            $news_services = new NewsService();
            $news = $news_services->getAllNews();
            $categories = $news_services->getAllCategories();
            include APP_ROOT."/views/home/index.php";
        }
    }
?>