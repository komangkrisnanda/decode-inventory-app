<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Ruang.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ruang</title>
</head>
<body>
    <form action="process/add-process.php" method="POST">
        <h1 align="center">Tambah Data Ruang</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Ruang</td>
                <td><input type="text" name="nama_ruang"></td>
            </tr>
            <tr>
                <td>Keterangan Ruang</td>
                <td><textarea name="keterangan_ruang"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Add Data"></td>
            </tr>
        </table>
    </form>

    <h1 align="center">Data Ruang</h1>
    <table border="1" cellpadding="10" style="border-collapse: collapse; margin:auto">
        <tr>
            <td>#No</td>
            <td>Nama Ruang</td>
            <td>Kode Ruang</td>
            <td>Keterangan Ruang</td>
            <td>Action</td>
        </tr>

        <?php
            $number = 1;
            foreach($ruang->all() as $data){
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $data['nama_ruang'] ?></td>
                        <td><?= $data['kode_ruang'] ?></td>
                        <td><?= $data['keterangan'] ?></td>
                        <td><a href="edit.php?id=<?= $data['id_ruang'] ?>">Edit</a> | <a href="delete.php?id=<?= $data['id_ruang'] ?>">Delete</a></td>
                    </tr>
                <?php
            }
        ?>
    </table>
</body>
</html>