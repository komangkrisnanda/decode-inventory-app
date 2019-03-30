<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Peminjaman.php";
    require_once $BASE_URL . "/models/Inventaris.php";
    require_once $BASE_URL . "/models/Jenis.php";
    require_once $BASE_URL . "/models/Ruang.php";
    require_once $BASE_URL . "/models/Petugas.php";
    require_once $BASE_URL . "/models/Pegawai.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }

    if(is_numeric($_GET['bulan'])){
        $bulan = $_GET['bulan'];
        $data = $peminjaman->whereAll('MONTH(tanggal_pinjam)', $bulan);
        if(count($data) == 0){
            header('location: index.php');
        }
    }
    else{
        header('location: index.php');
    }

    $sudahKembali = 0;
    $belumKembali = 0;

    foreach($data as $data_peminjaman){
        if($data_peminjaman['status_peminjaman'] == "Sudah Kembali"){
            $sudahKembali++;
        }
        else if($data_peminjaman['status_peminjaman'] == "Belum Kembali"){
            $belumKembali++;
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan</title>
    <style>
        @media print{
            button{
                display: none;
            }
        }
    </style>
</head>
<body>
    <h1 align="center">Laporan Inventory App</h1>
    <p align="center">Update : <?= date("d F Y H:i:s"); ?></p>

    <table align="center" cellpadding="5" style="border-collapse: collapse" border="1">
        <tr>
            <td colspan="2" align="center">Laporan Peminjaman "<?= convertMonth($bulan) ?>"</td>
        </tr>
        <tr>
            <td><b>Keterangan</b></td>
            <td><b>Jumlah</b></td>    
        </tr>
        <tr>
            <td>Transaksi Peminjaman</td>
            <td><?= count($data) ?></td>
        </tr>
        <tr>
            <td>Sudah Kembali</td>
            <td><?= $sudahKembali ?></td>
        </tr>
        <tr>
            <td>Belum Kembali</td>
            <td><?= $belumKembali ?></td>
        </tr>
        <tr>
            <td colspan="2" align="center">Laporan Umum</td>
        </tr>
        <tr>
            <td><b>Keterangan</b></td>
            <td><b>Jumlah</b></td>    
        </tr>
        <tr>
            <td>Total Inventaris</td>
            <td><?= count($inventaris->all()) ?></td>
        </tr>
        <tr>
            <td>Total Jenis</td>
            <td><?= count($jenis->all()) ?></td>
        </tr>
        <tr>
            <td>Total Ruang</td>
            <td><?= count($ruang->all()) ?></td>
        </tr>
        <tr>
            <td>Total Petugas</td>
            <td><?= count($petugas->all()) ?></td>
        </tr>
        <tr>
            <td>Total Pegawai</td>
            <td><?= count($pegawai->all()) ?></td>
        </tr>
    </table>

    <div style="width: 100%; text-align: center; margin-top: 1em">
        <button onclick="print()">Print Laporan</button>
    </div>

</body>
</html>