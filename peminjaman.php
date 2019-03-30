<?php
    require_once "autoload.php";
    require_once $BASE_URL . "/models/Peminjaman.php";
    require_once $BASE_URL . "/models/Inventaris.php";
    require_once $BASE_URL . "/models/Pegawai.php";

    $allowedLevel = ["Pegawai"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: login.php');
    }

    if(is_numeric(@$_GET['count'])){
        if($_GET['count'] < 1){
            header('location: ?count=1');
        }
        $count = $_GET['count'];
    }
    else{
        $count = 1;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Peminjaman</title>
    <style>
        input, select{
            width: 100%;
        }
        input[type="submit"]{
            width: auto;
        }
    </style>
</head>
<body>
    Hello, <?= $_SESSION['nama_pegawai'] ?> | <a href="logout.php">Logout</a>
    <hr>
    <form action="peminjaman-process.php" method="POST">
        <h1 align="center">Tambah Data Peminjaman</h1>
        <table style="margin:auto">
            <?php
                for($i=1; $i <= $count; $i++){
                    ?>
                        <tr>
                            <td>Nama Inventaris</td>
                            <td>
                                <select name="id_inventaris[]">
                                    <?php
                                        foreach($inventaris->all() as $data){
                                            echo "<option value='$data[id_inventaris]'>$data[nama] #$data[kode_inventaris] (Stok: $data[jumlah])</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Pinjam</td>
                            <td><input type="number" name="jumlah_pinjam[]" value="1" min="1">
                            </td>
                        </tr>
                    <?php
                }
            ?>
            <tr>
                <td colspan="2" align="right">
                        <a href="?count=<?=  ++$count ?>"><button type="button">Tambah Inventaris</button></a>
                        <?php
                            if(@$_GET['count'] > 1){
                                ?>
                                    <a href="?count=<?= $count-=2 ?>"><button type="button">Hapus Inventaris</button></a>
                                <?php
                            }
                        ?>
                </td>
            </tr>
            <tr>
                <td>Tanggal Pinjam</td>
                <td><input type="date" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>"></td>
            </tr>
            <tr>
                <td>Tanggal Kembali</td>
                <td><input type="date" name="tanggal_kembali" value="<?= date('Y-m-d', strtotime('+1 day')) ?>"></td>
            </tr>
            
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Add Data"></td>
            </tr>
        </table>
    </form>

    <h1 align="center">Data Peminjaman</h1>
    <table border="1" cellpadding="10" style="border-collapse: collapse; margin:auto">
        <tr>
            <td>#No</td>
            <td>Nama Pegawai</td>
            <td>Tanggal Pinjam</td>
            <td>Tanggal Kembali</td>
            <td>Status</td>
            <td>Action</td>
        </tr>

        <?php
            $number = 1;
            foreach($peminjaman->withPegawai() as $data){
                    if($_SESSION['id_pegawai'] == $data['id_pegawai']){
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $data['nama_pegawai'] ?></td>
                        <td><?= date("d F Y", strtotime($data['tanggal_pinjam'])) ?></td>
                        <td><?= date("d F Y", strtotime($data['tanggal_kembali'])) ?></td>
                        <td><?= $data['status_peminjaman'] ?></td>
                        <td>
                            <a href="detail.php?id=<?= $data['id_peminjaman'] ?>">Detail Peminjaman</a>
                        </td>
                    </tr>
                <?php
                }
            }
        ?>
    </table>
</body>
</html>