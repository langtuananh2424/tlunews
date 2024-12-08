<?php
    require_once "../services/NewsService.php";
    class HomeController {
        public function index() {
            $news_services = new NewsService();
            $news = $news_services->getAllNews();
            $categories = $news_services->getAllCategories();
            return view('home.index', compact('news', 'categories'));
        }
    }
?>