<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Peminjam.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Peminjam</title>
</head>
<body>
    <form action="process/add-process.php" method="POST">
        <h1 align="center">Tambah Data Peminjam</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Peminjam</td>
                <td><input type="text" name="nama_peminjam"></td>
            </tr>
            <tr>
                <td>Username Peminjam</td>
                <td><input type="text" name="username_peminjam"></td>
            </tr>
            <tr>
                <td>Password Peminjam</td>
                <td><input type="password" name="password_peminjam"></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td><input type="number" name="nip_peminjam"></td>
            </tr>
            <tr>
                <td>Alamat Peminjam</td>
                <td><textarea name="alamat_peminjam"></textarea></td>
            </tr>
            <tr>
                <td>Status Peminjam</td>
                <td>
                    <select name="status">
                        <option value="Pegawai">Pegawai</option>
                        <option value="Guru">Guru</option>
                        <option value="Siswa">Siswa</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Add Data"></td>
            </tr>
        </table>
    </form>

    <h1 align="center">Data Peminjam</h1>
    <table border="1" cellpadding="10" style="border-collapse: collapse; margin:auto">
        <tr>
            <td>#No</td>
            <td>Nama Peminjam</td>
            <td>Username Peminjam</td>
            <td>NIP</td>
            <td>Alamat Peminjam</td>
            <td>Status Peminjam</td>
            <td>Action</td>
        </tr>

        <?php
            $number = 1;
            foreach($peminjam->all() as $data){
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $data['nama_peminjam'] ?></td>
                        <td><?= $data['username'] ?></td>
                        <td><?= $data['nip'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td><?= $data['status'] ?></td>
                        <td><a href="edit.php?id=<?= $data['id_peminjam'] ?>">Edit</a> | <a href="delete.php?id=<?= $data['id_peminjam'] ?>">Delete</a></td>
                    </tr>
                <?php
            }
        ?>
    </table>
</body>
</html>