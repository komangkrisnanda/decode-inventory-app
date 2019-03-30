<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Petugas.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }

    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];

        $query = $petugas->where('id_petugas', $id);

        if(count($query) > 1){
            $query = $petugas->delete('id_petugas', $id);

            if($query){
                alert("Data is successfully added!", "index.php");
            }
            else{
                alert("Something error!", "index.php");
            }
        }
        else{
            alert("Data is already added before ! Please use another data!", "index.php");
        }
    }
    else{
        header('location: ../index.php');
    }
?>