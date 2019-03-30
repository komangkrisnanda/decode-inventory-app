<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Pegawai.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../../index.php');
    }

    if(isset($_POST['submit'])){
        $namaPegawai = $_POST['nama_pegawai'];
        $passwordPegawai = $_POST['password_pegawai'];
        $nip = $_POST['nip_pegawai'];
        $alamatPegawai = $_POST['alamat_pegawai'];

        if(!empty($namaPegawai) && !empty($passwordPegawai) && is_numeric($nip) && !empty($alamatPegawai)){
            $query = $pegawai->where('nip', $nip);

            if(count($query) == 0){
                $query = $pegawai->insert([
                    'nama_pegawai' => $namaPegawai,
                    'password' => PASSWORD_HASH($passwordPegawai, PASSWORD_BCRYPT, ['cost' => 12]),
                    'nip' => $nip,
                    'alamat' => $alamatPegawai
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