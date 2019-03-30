<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Petugas.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../../index.php');
    }

    if(isset($_POST['submit'])){
        $namaPetugas = $_POST['nama_petugas'];
        $passwordPetugas = $_POST['password_petugas'];
        $username = $_POST['username_petugas'];
        $idLevel = $_POST['id_level'];

        if(!empty($namaPetugas) && !empty($passwordPetugas) && !empty($username) && is_numeric($idLevel)){
            $query = $petugas->where('username', $username);

            if(count($query) == 0){
                $query = $petugas->insert([
                    'username' => $username,
                    'nama_petugas' => $namaPetugas,
                    'password' => PASSWORD_HASH($passwordPetugas, PASSWORD_BCRYPT, ['cost' => 12]),
                    'id_level' => $idLevel,
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