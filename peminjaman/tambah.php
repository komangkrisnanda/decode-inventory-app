<?php
    require_once "../autoload.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $_SESSION['data_inventaris'][] = $id;
        header('location: index.php');
    }
    else{
        header('location: index.php');
    }
?>