<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Petugas.php";
    require_once $BASE_URL . "/models/Level.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Petugas</title>
</head>
<body>
    <?php $title = "Data Petugas"; require_once $BASE_URL . "/helper/header.inc.php" ?>
    <form action="process/add-process.php" method="POST">
        <h1 align="center">Tambah Data Petugas</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Petugas</td>
                <td><input type="text" name="nama_petugas"></td>
            </tr>
            <tr>
                <td>Username Petugas</td>
                <td><input type="text" name="username_petugas"></td>
            </tr>
            <tr>
                <td>Password Petugas</td>
                <td><input type="password" name="password_petugas"></td>
            </tr>
            <tr>
                <td>Level Petugas</td>
                <td>
                    <select name="id_level">
                        <?php
                            foreach($level->all() as $data){
                                echo "<option value='$data[id_level]'>$data[nama_level]</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Add Data"></td>
            </tr>
        </table>
    </form>

    <h1 align="center">Data Petugas</h1>
    <table border="1" cellpadding="10" style="border-collapse: collapse; margin:auto">
        <tr>
            <td>#No</td>
            <td>Nama Petugas</td>
            <td>Username</td>
            <td>Level</td>
            <td>Action</td>
        </tr>

        <?php
            $number = 1;
            foreach($petugas->withLevel() as $data){
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $data['nama_petugas'] ?></td>
                        <td><?= $data['username'] ?></td>
                        <td><?= $data['nama_level'] ?></td>
                        <td><a href="edit.php?id=<?= $data['id_petugas'] ?>">Edit</a> | <a href="delete.php?id=<?= $data['id_petugas'] ?>">Delete</a></td>
                    </tr>
                <?php
            }
        ?>
    </table>
</body>
</html>