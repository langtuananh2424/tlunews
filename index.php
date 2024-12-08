<?php 
require_once APP_ROOT . "/Utilities/Database.php";
    foreach($news as $item){
        echo $item['id'];
    }
?>