<?php
    require_once "./autoload.php";
    require_once $BASE_URL . "/models/Peminjam.php";
    

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($password)){
            $query = $peminjam->where('username', $username);

            if(count($query) > 1){
                if(password_verify($password, $query['password'])){

                    $_SESSION['id_peminjam'] = $query['id_peminjam'];
                    $_SESSION['nama_peminjam'] = $query['nama_peminjam'];
                    $_SESSION['level'] = $query['status'];

                    alert("Login Success, Welcome $query[nama_peminjam] !", "peminjaman.php");
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