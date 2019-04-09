<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Peminjam.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../../index.php');
    }

    if(isset($_POST['submit'])){
        $namaPeminjam = $_POST['nama_peminjam'];
        $usernamePeminjam = $_POST['username_peminjam'];
        $passwordPeminjam = $_POST['password_peminjam'];
        $nip = $_POST['nip_peminjam'];
        $alamatPeminjam = $_POST['alamat_peminjam'];
        $status = $_POST['status'];

        if(!empty($namaPeminjam) && !empty($usernamePeminjam) && !empty($passwordPeminjam) && !empty($alamatPeminjam) && !empty($status)){
            $query = $peminjam->where('nip', $nip);

            if(count($query) == 0){
                $query = $peminjam->insert([
                    'nama_peminjam' => $namaPeminjam,
                    'username' => $usernamePeminjam,
                    'password' => PASSWORD_HASH($passwordPeminjam, PASSWORD_BCRYPT, ['cost' => 12]),
                    'nip' => $nip,
                    'alamat' => $alamatPeminjam,
                    'status' => $status
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