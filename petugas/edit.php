<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Petugas.php";
    require_once $BASE_URL . "/models/Level.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }
    

    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $data = $petugas->where('id_petugas', $id);
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
    <title>Petugas</title>
</head>
<body>
    <form action="process/edit-process.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id_petugas'] ?>">
        <h1 align="center">Edit Data Petugas</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Petugas</td>
                <td><input type="text" name="nama_petugas" value="<?= $data['nama_petugas'] ?>"></td>
            </tr>
            <tr>
                <td>Username Petugas</td>
                <td><input type="text" name="username_petugas" value="<?= $data['username'] ?>"></td>
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
                            foreach($level->all() as $data_level){
                                if($data['id_level'] == $data_level['id_level']){
                                    echo "<option value='$data_level[id_level]' selected>$data_level[nama_level]</option>";
                                }
                                else{
                                    echo "<option value='$data_level[id_level]'>$data_level[nama_level]</option>";
                                }
                            }
                        ?>
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