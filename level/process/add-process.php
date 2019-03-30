<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Level.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../../index.php');
    }

    if(isset($_POST['submit'])){
        $namaLevel = $_POST['nama_level'];

        if(!empty($namaLevel)){
            $query = $level->where('nama_level', $namaLevel);

            if(count($query) == 0){
                $query = $level->insert([
                    'nama_level' => $namaLevel,
                ]);

                if($query){
                    alert("Data is successfully added!", "../index.php");
                }
                else{
                    alert("Something error!", "../index.php");
                }
            }
            else{
                alert("Data is already added before ! Please use another data!", "../index.php");
            }
        }
        else{
            alert("Please fill all forms!", "../index.php");
        }
    }
    else{
        header('location: ../index.php');
    }
?>