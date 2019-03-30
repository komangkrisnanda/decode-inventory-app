<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Level.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }

    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $data = $level->where('id_level', $id);
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
    <title>Level</title>
</head>
<body>
    <form action="process/edit-process.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id_level'] ?>">
        <h1 align="center">Edit Data Level</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Level</td>
                <td><input type="text" name="nama_level" value="<?= $data['nama_level'] ?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Update Data"></td>
            </tr>
        </table>
    </form>
</body>
</html>