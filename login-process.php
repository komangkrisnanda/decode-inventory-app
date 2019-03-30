<?php
    require_once "./autoload.php";
    require_once $BASE_URL . "/models/Petugas.php";
    require_once $BASE_URL . "/models/Level.php";
    

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($password)){
            $query = $petugas->where('username', $username);

            if(count($query) > 1){
                if(password_verify($password, $query['password'])){

                    $data_level = $level->where('id_level', $query['id_level']);

                    $_SESSION['id_petugas'] = $query['id_petugas'];
                    $_SESSION['nama_petugas'] = $query['nama_petugas'];
                    $_SESSION['level'] = $data_level['nama_level'];

                    alert("Login Success, Welcome $query[nama_petugas] !", "index.php");
                }
                else{
                    alert("Wrong Username & Password Combination!", "login.php");
                }
            }
            else{
                alert("Wrong Username!", "login.php");
            }
        }
        else{
            alert("Please fill all forms!", "login.php");
        }
    }
    else{
        header('location: login.php');
    }
?>