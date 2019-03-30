<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Jenis.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }

    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $data = $jenis->where('id_jenis', $id);
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
    <title>Jenis</title>
</head>
<body>
    <form action="process/edit-process.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id_jenis'] ?>">
        <h1 align="center">Edit Data Jenis</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Jenis</td>
                <td><input type="text" name="nama_jenis" value="<?= $data['nama_jenis'] ?>"></td>
            </tr>
            <tr>
                <td>Keterangan Jenis</td>
                <td><textarea name="keterangan_jenis"><?= $data['keterangan'] ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Update Data"></td>
            </tr>
        </table>
    </form>
</body>
</html>