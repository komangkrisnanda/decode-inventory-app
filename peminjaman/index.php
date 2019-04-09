<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Peminjaman.php";
    require_once $BASE_URL . "/models/Inventaris.php";
    require_once $BASE_URL . "/models/Peminjam.php";

    $allowedLevel = ["Administrator","Operator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
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
        ul.pagination{
            list-style: none;
        }
        ul.pagination li{
            display: inline-block;
        }
    </style>
</head>
<body>

    <h1 align="center">Tambah Data Peminjaman</h1>
    <form action="">
        <table style="margin:auto">
            <tr>
                <td>Cari Inventaris</td>
                <td><input type="text" name="pencarian_inventaris" placeholder="Masukan kata kunci.."></td>
            </tr>
        </table>
    </form>

    <?php
        if(isset($_GET['pencarian_inventaris'])){
            $pencarianInventaris = $_GET['pencarian_inventaris'];
            
            if(!empty($pencarianInventaris)){
                $data_inventaris = $inventaris->withSearch($pencarianInventaris);

                if(count($data_inventaris) >= 1){
                    ?>
                        <table border="1" style="border-collapse: collapse" cellpadding="10" align="center">
                            <tr>
                                <td colspan="3" align="center">
                                Hasil penelusuran '<?= $pencarianInventaris ?>'
                                <br>
                                Data yang ditemukan : <?= count($data_inventaris) ?></td>
                            </tr>
                            <tr>
                                <td>Nama Inventaris</td>
                                <td>Stok</td>
                                <td>Aksi</td>
                            </tr>
                            <?php
                                foreach($data_inventaris as $data){
                                    ?>
                                        <tr>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['jumlah'] ?></td>
                                            <td><a href="tambah.php?id=<?= $data['id_inventaris'] ?>">Tambah ke peminjaman</a></td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </table>
                    <?php
                }
                else{
                    echo "<p align='center'>Data inventaris '$_GET[pencarian_inventaris]' tidak ditemukan!";
                }
            }
        }
    ?>

    <form action="process/add-process.php" method="POST">
        <table style="margin:auto">
            <?php
                if(!empty($_SESSION['data_inventaris'])){
                    foreach($_SESSION['data_inventaris'] as $id_inventaris){
                        ?>
                            <tr>
                                <td>Nama Inventaris</td>
                                <td>
                                    <select name="id_inventaris[]">
                                        <?php
                                            foreach($inventaris->all() as $data){
                                                if($id_inventaris == $data['id_inventaris']){
                                                    echo "<option value='$data[id_inventaris]' selected>$data[nama] #$data[kode_inventaris] (Stok: $data[jumlah])</option>";
                                                }
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
                            <tr>
                                <td></td>
                                <td><a href="hapus.php?id=<?= $id_inventaris ?>">Hapus</a></td>
                            </tr>
                        <?php
                    }
                }
            ?>
            <tr>
                <td>Tanggal Pinjam</td>
                <td><input type="date" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>"></td>
            </tr>
            <tr>
                <td>Tanggal Kembali</td>
                <td><input type="date" name="tanggal_kembali" value="<?= date('Y-m-d', strtotime('+1 day')) ?>"></td>
            </tr>
            <tr>
                <td>Nama Peminjam</td>
                <td>
                    <select name="id_peminjam">
                        <?php
                            foreach($peminjam->all() as $data){
                                echo "<option value='$data[id_peminjam]'>$data[nama_peminjam] - #$data[status]</option>";
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

    <h1 align="center">Data Peminjaman</h1>
    <form action="">
        <table align="center">
            <tr>
                <td>Pencarian</td>
                <td><input type="text" name="pencarian_peminjam" placeholder="Masukan nama peminjam.."></td>
            </tr>
        </table>
    </form> 

    <br><br>

    <table border="1" cellpadding="10" style="border-collapse: collapse; margin:auto">
        <tr>
            <td>#No</td>
            <td>Nama Peminjam</td>
            <td>Tanggal Pinjam</td>
            <td>Tanggal Kembali</td>
            <td>Status</td>
            <td>Action</td>
        </tr>

        <?php
            $number = 1;
            
            if(is_numeric(@$_GET['page'])){
                $halaman = $_GET['page'];
            }
            else{
                $halaman = 1;
            }

            if(!empty(@$_GET['pencarian_peminjam'])){
                $data_peminjaman = $peminjaman->withPeminjam($_GET['pencarian_peminjam'], $halaman, 5);
            }
            else{
                $data_peminjaman = [];
            }
            
            foreach($data_peminjaman as $data){
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= $data['nama_peminjam'] ?></td>
                        <td><?= date("d F Y", strtotime($data['tanggal_pinjam'])) ?></td>
                        <td><?= date("d F Y", strtotime($data['tanggal_kembali'])) ?></td>
                        <td>
                            <?php
                                echo $data['status_peminjaman'];
                                if($data['status_peminjaman'] == "Belum Kembali"){
                                    if(strtotime($data['tanggal_kembali']) < strtotime(date("Y-m-d"))){
                                        echo " <span style='color: red'>(Telat)</span>";
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <a href="detail.php?id=<?= $data['id_peminjaman'] ?>">Detail Peminjaman</a>
                            <?php
                                if($data['status_peminjaman'] == "Belum Kembali"){
                                    ?>
                                        | <a href="pengembalian.php?id=<?= $data['id_peminjaman'] ?>">Pengembalian</a>
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                <?php
            }

        ?>
    </table>

    <!-- Paging -->

    <?php 
        @$pencarian_peminjam = $_GET['pencarian_peminjam'];

        if(!empty($pencarian_peminjam)){
            ?>
                <div style="width: 100%; text-align: center;">
                    <ul class="pagination">
                        <li><a href="?pencarian_peminjam=<?= $pencarian_peminjam ?>&page=1">1</a></li>
                        <li><a href="?pencarian_peminjam=<?= $pencarian_peminjam ?>&page=2">2</a></li>
                    </ul>
                </div>
            <?php
        }
    ?>

    <!-- End Paging -->
</body>
</html>