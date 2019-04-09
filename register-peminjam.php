<?php
    require_once "autoload.php";
    require_once $BASE_URL . "/models/Peminjam.php";

    $allowedLevel = ["Pegawai","Guru","Siswa"];
    if(in_array(@$_SESSION['level'], $allowedLevel)){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Peminjam</title>
</head>
<body>
    <form action="register-peminjam-process.php" method="POST">
        <h1>Register Peminjam</h1>
        <table>
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
        <p>Sudah Punya akun ? <a href="login.php">Login</a></p>
    </form>
</body>
</html>