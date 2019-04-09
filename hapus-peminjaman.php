<?php
    require_once "autoload.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        foreach($_SESSION['data_inventaris'] as $key => $id_inventaris){
            if($id_inventaris == $id){
                unset($_SESSION['data_inventaris'][$key]);
            }
        }
        
        header('location: peminjaman.php');
    }
    else{
        header('location: peminjaman.php');
    }
?>