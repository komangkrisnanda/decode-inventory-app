<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Pegawai.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pegawai</title>
</head>
<body>
    <form action="process/add-process.php" method="POST">
        <h1 align="center">Tambah Data Pegawai</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Pegawai</td>
                <td><input type="text" name="nama_pegawai"></td>
            </tr>
            <tr>
                <td>Password Pegawai</td>
                <td><input type="password" name="password_pegawai"></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td><input type="number" name="nip_pegawai"></td>
            </tr>
            <tr>
                <td>Alamat Pegawai</td>
                <td><textarea name="alamat_pegawai"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Add Data"></td>
            </tr>
        </table>
    </form>

    <h1 align="center">Data Pegawai</h1>
    <table border="1" cellpadding="10" style="border-collapse: collapse; margin:auto">
        <tr>
            <td>#No</td>
            <td>Nama Pegawai</td>
            <td>NIP</td>
            <td>Alamat Pegawai</td>
            <td>Action</td>
        </tr>

        <?php
            $number = 1;
            foreach($pegawai->all() as $data){
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $data['nama_pegawai'] ?></td>
                        <td><?= $data['nip'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td><a href="edit.php?id=<?= $data['id_pegawai'] ?>">Edit</a> | <a href="delete.php?id=<?= $data['id_pegawai'] ?>">Delete</a></td>
                    </tr>
                <?php
            }
        ?>
    </table>
</body>
</html>