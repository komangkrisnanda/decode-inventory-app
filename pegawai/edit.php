<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Pegawai.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }

    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $data = $pegawai->where('id_pegawai', $id);
        if(count($data) == 0){
            header('location: index.php');
        }
    }
    else{
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pegawai</title>
</head>
<body>
    <form action="process/edit-process.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id_pegawai'] ?>">
        <h1 align="center">Edit Data Pegawai</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Pegawai</td>
                <td><input type="text" name="nama_pegawai" value="<?= $data['nama_pegawai'] ?>"></td>
            </tr>
            <tr>
                <td>Password Pegawai</td>
                <td><input type="password" name="password_pegawai"></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td><input type="number" name="nip_pegawai" value="<?= $data['nip'] ?>" disabled></td>
            </tr>
            <tr>
                <td>Alamat Pegawai</td>
                <td><textarea name="alamat_pegawai"><?= $data['alamat'] ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Update Data"></td>
            </tr>
        </table>
    </form>
</body>
</html>