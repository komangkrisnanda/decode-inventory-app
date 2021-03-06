<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Level.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Level</title>
</head>
<body>
    <form action="process/add-process.php" method="POST">
        <h1 align="center">Tambah Data Level</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Level</td>
                <td><input type="text" name="nama_level"></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Add Data"></td>
            </tr>
        </table>
    </form>

    <h1 align="center">Data Level</h1>
    <table border="1" cellpadding="10" style="border-collapse: collapse; margin:auto">
        <tr>
            <td>#No</td>
            <td>Nama Level</td>
            <td>Action</td>
        </tr>

        <?php
            $number = 1;
            foreach($level->all() as $data){
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $data['nama_level'] ?></td>
                        <td><a href="edit.php?id=<?= $data['id_level'] ?>">Edit</a> | <a href="delete.php?id=<?= $data['id_level'] ?>">Delete</a></td>
                    </tr>
                <?php
            }
        ?>
    </table>
</body>
</html>