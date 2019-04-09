<?php
    require_once "autoload.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $_SESSION['data_inventaris'][] = $id;
        header('location: peminjaman.php');
    }
    else{
        header('location: peminjaman.php');
    }
?>