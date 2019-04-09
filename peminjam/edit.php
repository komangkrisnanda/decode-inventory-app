<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Peminjam.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }

    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $data = $peminjam->where('id_peminjam', $id);
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
    <title>Peminjam</title>
</head>
<body>
    <form action="process/edit-process.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id_peminjam'] ?>">
        <h1 align="center">Edit Data Peminjam</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Peminjam</td>
                <td><input type="text" name="nama_peminjam" value="<?= $data['nama_peminjam'] ?>"></td>
            </tr>
            <tr>
                <td>Username Peminjam</td>
                <td><input type="text" name="username_peminjam" value="<?= $data['username'] ?>"></td>
            </tr>
            <tr>
                <td>Password Peminjam</td>
                <td><input type="password" name="password_peminjam"></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td><input type="number" name="nip_peminjam" value="<?= $data['nip'] ?>" disabled></td>
            </tr>
            <tr>
                <td>Alamat Peminjam</td>
                <td><textarea name="alamat_peminjam"><?= $data['alamat'] ?></textarea></td>
            </tr>
            <tr>
                <td>Status Peminjam</td>
                <td>
                    <?php
                        $pegawai = "";
                        $guru = "";
                        $siswa = "";

                        if($data['status'] == "Pegawai"){
                            $pegawai = "selected";
                        }
                        else if($data['status'] == "Guru"){
                            $guru = "selected";
                        }
                        else if($data['status'] == "Siswa"){
                            $siswa = "selected";
                        }
                    ?>
                    <select name="status">
                        <option value="Pegawai" <?= $pegawai ?>>Pegawai</option>
                        <option value="Guru" <?= $guru ?>>Guru</option>
                        <option value="Siswa" <?= $siswa ?>>Siswa</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Update Data"></td>
            </tr>
        </table>
    </form>
</body>
</html>