<?php
    require_once "autoload.php";

    $level = ["Administrator", "Operator"];
    if(!in_array($_SESSION['level'], $level)){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Hello, <?= $_SESSION['nama_petugas'] ?> | <a href="logout.php">Keluar</a></p>

    <hr>
        <ul>
            <?php
                if($_SESSION['level'] == "Administrator"){
                    ?>
                        <li><a href="./inventaris">Inventaris</a></li>
                        <li><a href="./jenis">Jenis</a></li>
                        <li><a href="./ruang">Ruang</a></li>
                        <li><a href="./level">Level</a></li>
                        <li><a href="./petugas">Petugas</a></li>
                        <li><a href="./pegawai">Pegawai</a></li>
                        <li><a href="./laporan">Laporan</a></li>
                    <?php
                }
            ?>
            
            <li><a href="./peminjaman">Peminjaman</a></li>
        </ul>
    <hr>
</body>
</html>