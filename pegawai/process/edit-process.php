<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Pegawai.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../../index.php');
    }

    if(isset($_POST['submit'])){
        $idPegawai = $_POST['id'];
        $namaPegawai = $_POST['nama_pegawai'];
        $passwordPegawai = $_POST['password_pegawai'];
        $alamatPegawai = $_POST['alamat_pegawai'];

        if(!empty($namaPegawai) && is_numeric($idPegawai) && !empty($alamatPegawai)){
            $query = $pegawai->where('id_pegawai', $idPegawai);

            if(count($query) > 1){
                if(!empty($passwordPegawai)){
                    $query = $pegawai->update([
                        'nama_pegawai' => $namaPegawai,
                        'password' => PASSWORD_HASH($passwordPegawai, PASSWORD_BCRYPT, ['cost' => 12]),
                        'alamat' => $alamatPegawai
                    ], 'id_pegawai', $idPegawai);
                }
                else{
                    $query = $pegawai->update([
                        'nama_pegawai' => $namaPegawai,
                        'alamat' => $alamatPegawai
                    ], 'id_pegawai', $idPegawai);
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