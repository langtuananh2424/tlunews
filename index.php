<?php require_once 'Utilities/Database.php';
    foreach($news as $item){
        echo $item['id'];
    }
    header('Location: views/home/index.php');
    exit;
?>