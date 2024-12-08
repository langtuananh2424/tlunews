<?php
require_once APP_ROOT."/app/services/NewsServices.php";

class NewsController{
    public function index(){
        $news_services = new NewsService();
        $news = $news_services->getAllNews();
        $categories = $news_services->getAllCategories();
        include APP_ROOT."/views/home/index.php";
    }

    public function detail() {
        if(isset($_GET["id"])){
            $news_services = new NewsService();
            $detail = $news_services->getById($_GET["id"]);
            include APP_ROOT."/views/news/detail.php";
        }
    }

    public function category(){
        if(isset($_GET["category_id"])){
            $news_services = new NewsService();
            $categories = $news_services->getAllCategories();
            $news = $news_services->getByCategoryId($_GET["category_id"]);
            include APP_ROOT."/views/home/index.php";
        }
    }
}
?>