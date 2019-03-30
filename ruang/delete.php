<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Ruang.php";

    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];

        $query = $ruang->where('id_ruang', $id);

        if(count($query) > 1){
            $query = $ruang->delete('id_ruang', $id);

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