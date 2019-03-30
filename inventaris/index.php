<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Inventaris.php";
    require_once $BASE_URL . "/models/Jenis.php";
    require_once $BASE_URL . "/models/Ruang.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inventaris</title>
</head>
<body>
    <form action="process/add-process.php" method="POST">
        <h1 align="center">Tambah Data Inventaris</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Inventaris</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Jenis Inventaris</td>
                <td>
                    <select name="id_jenis">
                        <?php
                            foreach($jenis->all() as $data){
                                echo "<option value='$data[id_jenis]'>$data[nama_jenis] #$data[kode_jenis]</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Ruang Inventaris</td>
                <td>
                    <select name="id_ruang">
                        <?php
                            foreach($ruang->all() as $data){
                                echo "<option value='$data[id_ruang]'>$data[nama_ruang] #$data[kode_ruang]</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Kondisi Inventaris</td>
                <td>
                    <select name="kondisi">
                        <option value="Baik">Baik</option>
                        <option value="Kurang Baik">Kurang Baik</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Jumlah Stok</td>
                <td><input type="number" name="jumlah_stok"></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>
                    <textarea name="keterangan" rows="8" style="resize:none"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Add Data"></td>
            </tr>
        </table>
    </form>

    <h1 align="center">Data Inventaris</h1>
    <table border="1" cellpadding="10" style="border-collapse: collapse; margin:auto">
        <tr>
            <td>#No</td>
            <td>Nama Inventaris</td>
            <td>Kode</td>
            <td>Jenis</td>
            <td>Ruang</td>
            <td>Kondisi</td>
            <td>Jumlah</td>
            <td>Keterangan</td>
            <td>Petugas</td>
            <td>Tanggal Register</td>
            <td>Action</td>
        </tr>

        <?php
            $number = 1;
            foreach($inventaris->withAll() as $data){
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['kode_inventaris'] ?></td>
                        <td><?= $data['nama_jenis'] ?></td>
                        <td><?= $data['nama_ruang'] ?></td>
                        <td><?= $data['kondisi'] ?></td>
                        <td><?= $data['jumlah'] ?></td>
                        <td><?= $data['keterangan'] ?></td>
                        <td><?= $data['nama_petugas'] ?></td>
                        <td><?= $data['tanggal_register'] ?></td>
                        <td><a href="edit.php?id=<?= $data['id_inventaris'] ?>">Edit</a> | <a href="delete.php?id=<?= $data['id_inventaris'] ?>">Delete</a></td>
                    </tr>
                <?php
            }
        ?>
    </table>
</body>
</html>