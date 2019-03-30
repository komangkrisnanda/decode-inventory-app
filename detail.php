<?php
    require_once "autoload.php";
    require_once $BASE_URL . "/models/Peminjaman.php";

    $allowedLevel = ["Pegawai"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: login.php');
    }

    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $data = $peminjaman->withDetail($id);
        if(count($data) == 0){
            header('location: peminjaman.php');
        }
    }
    else{
        header('location: peminjaman.php');
    }
    // var_dump($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>DetailPinjam</title>
</head>
<body>
    <form action="process/edit-process.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id_detailPinjam'] ?>">
        <h1 align="center">Detail Peminjaman</h1>
        <table style="margin:auto; border-collapse: collapse" border="1" cellpadding="10">
            <tr>
                <td>#No</td>
                <td>Nama Pegawai</td>
                <td>Nama Inventaris</td>
                <td>Jumlah</td>
            </tr>
            <?php
                $number = 1;
                foreach($data as $detail){
                    ?>      
                        <tr>
                            <td><?= $number++ ?></td>
                            <td><?= $detail['nama_pegawai'] ?></td>
                            <td><?= $detail['nama'] ?></td>
                            <td><?= $detail['jumlah'] ?></td>
                        </tr>
                    <?php
                }
            ?>
        </table>
    </form>
</body>
</html>