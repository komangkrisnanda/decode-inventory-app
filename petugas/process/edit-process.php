<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Petugas.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../../index.php');
    }

    if(isset($_POST['submit'])){
        $idPetugas = $_POST['id'];
        $namaPetugas = $_POST['nama_petugas'];
        $usernamePetugas = $_POST['username_petugas'];
        $passwordPetugas = $_POST['password_petugas'];
        $idLevel = $_POST['id_level'];

        if(!empty($namaPetugas) && is_numeric($idPetugas) && !empty($usernamePetugas) && is_numeric($idLevel)){
            $query = $petugas->where('id_petugas', $idPetugas);

            if(count($query) > 1){
                if(!empty($passwordPetugas)){
                    $query = $petugas->update([
                        'nama_petugas' => $namaPetugas,
                        'password' => PASSWORD_HASH($passwordPetugas, PASSWORD_BCRYPT, ['cost' => 12]),
                        'username' => $usernamePetugas,
                        'id_level' => $idLevel
                    ], 'id_petugas', $idPetugas);
                }
                else{
                    $query = $petugas->update([
                        'nama_petugas' => $namaPetugas,
                        'username' => $usernamePetugas,
                        'id_level' => $idLevel
                    ], 'id_petugas', $idPetugas);
                }

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