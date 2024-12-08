<?
require_once APP_ROOT."/tlunews/controllers/NewsController.php";
class AdminService {
    // Thêm bài viết mới
    public function addNews($title, $content, $image, $created_at, $category_id) {
        try {
            $conn = DataBase::connect();
            if (!$conn) {
                throw new Exception("Database connection failed.");
            }

            $stmt = $conn->prepare("
                INSERT INTO news (title, content, image, created_at, category_id)
                VALUES (:title, :content, :image, :created_at, :category_id)
            ");
            $stmt->execute([
                "title" => $title,
                "content" => $content,
                "image" => $image,
                "created_at" => $created_at,
                "category_id" => $category_id,
            ]);

        } catch (PDOException $e) {
            error_log("Database Error in addNews: " . $e->getMessage());
        }
    }

    // Chỉnh sửa bài viết
    public function editNews($id, $title, $content, $image, $created_at, $category_id) {
        try {
            $conn = DataBase::connect();
            if (!$conn) {
                throw new Exception("Database connection failed.");
            }
            $query = "
                UPDATE news 
                SET title = :title, content = :content, created_at = :created_at, category_id = :category_id
            ";
            $params = [
                "title" => $title,
                "content" => $content,
                "created_at" => $created_at,
                "category_id" => $category_id,
                "id" => $id,
            ];

            if (!empty($image)) {
                $query .= ", image = :image";
                $params["image"] = $image;
            }

            $query .= " WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->execute($params);

        } catch (PDOException $e) {
            error_log("Database Error in editNews: " . $e->getMessage());
        }
    }
    public function deleteNews($id) {
        try {
            $conn = DataBase::connect();
            if (!$conn) {
                throw new Exception("Database connection failed.");
            }
    
            $stmt = $conn->prepare("DELETE FROM news WHERE id = :id");
            $stmt->execute(["id" => $id]);
    
        } catch (PDOException $e) {
            error_log("Database Error in deleteNews: " . $e->getMessage());
        }
    }    
}
class AdminController {
    public function dashboard(){
        $n = new NewsService();
        $news = $n->getAllNews();
        include APP_ROOT."/tlunews/views/admin/dashboard.php";
    }

    public function add(){
        $n = new NewsService();
        $categories = $n->getAllCategories();
        include APP_ROOT."/tlunews/views/admin/news/add.php";
    }

    public function edit(){
        $n = new NewsService();
        $id = $_GET['id'];
        $news = $n->getById($id);
        $categories = $n->getAllCategories();
        include APP_ROOT."/tlunews/views/admin/news/edit.php";
    }

    public function delete(){
        $id = $_GET['id'];
        $as =  new AdminService();
        $as->deleteNews($id);
        header("Location: ?controller=admin&action=dashboard");
    }

    public function create(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $as = new AdminService();
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = "/".$_FILES['image']['name'];
            $created_at = $_POST['created_at'];
            $category_id = $_POST['category_id'];
            $as->addNews($title,$content,$image,$created_at,$category_id);
            header("Location: ?controller=admin&action=dashboard");
        }
    }

    public function update(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $as = new AdminService();
            $id = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = "/".$_FILES['image']['name'];
            $created_at = $_POST['created_at'];
            $category_id = $_POST['category_id'];
            $as->editNews($id,$title,$content,$image,$created_at,$category_id);
            header("Location: ?controller=admin&action=dashboard");
        }
    }
}
?>
