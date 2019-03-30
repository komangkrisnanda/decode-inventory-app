<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Ruang.php";

    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $data = $ruang->where('id_ruang', $id);
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
    <title>Ruang</title>
</head>
<body>
    <form action="process/edit-process.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id_ruang'] ?>">
        <h1 align="center">Edit Data Ruang</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Ruang</td>
                <td><input type="text" name="nama_ruang" value="<?= $data['nama_ruang'] ?>"></td>
            </tr>
            <tr>
                <td>Keterangan Ruang</td>
                <td><textarea name="keterangan_ruang"><?= $data['keterangan'] ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Update Data"></td>
            </tr>
        </table>
    </form>
</body>
</html>