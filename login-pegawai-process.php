<?php
    require_once "./autoload.php";
    require_once $BASE_URL . "/models/Pegawai.php";
    

    if(isset($_POST['submit'])){
        $nip = $_POST['nip'];
        $password = $_POST['password'];

        if(!empty($nip) && !empty($password)){
            $query = $pegawai->where('nip', $nip);

            if(count($query) > 1){
                if(password_verify($password, $query['password'])){

                    $_SESSION['id_pegawai'] = $query['id_pegawai'];
                    $_SESSION['nama_pegawai'] = $query['nama_pegawai'];
                    $_SESSION['level'] = "Pegawai";

                    alert("Login Success, Welcome $query[nama_pegawai] !", "peminjaman.php");
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