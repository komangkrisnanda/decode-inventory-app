<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Jenis.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jenis</title>
</head>
<body>
    <form action="process/add-process.php" method="POST">
        <h1 align="center">Tambah Data Jenis</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Jenis</td>
                <td><input type="text" name="nama_jenis"></td>
            </tr>
            <tr>
                <td>Keterangan Jenis</td>
                <td><textarea name="keterangan_jenis"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Add Data"></td>
            </tr>
        </table>
    </form>

    <h1 align="center">Data Jenis</h1>
    <table border="1" cellpadding="10" style="border-collapse: collapse; margin:auto">
        <tr>
            <td>#No</td>
            <td>Nama Jenis</td>
            <td>Kode Jenis</td>
            <td>Keterangan Jenis</td>
            <td>Action</td>
        </tr>

        <?php
            $number = 1;
            foreach($jenis->all() as $data){
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $data['nama_jenis'] ?></td>
                        <td><?= $data['kode_jenis'] ?></td>
                        <td><?= $data['keterangan'] ?></td>
                        <td><a href="edit.php?id=<?= $data['id_jenis'] ?>">Edit</a> | <a href="delete.php?id=<?= $data['id_jenis'] ?>">Delete</a></td>
                    </tr>
                <?php
            }
        ?>
    </table>
</body>
</html>