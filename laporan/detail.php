<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Peminjaman.php";
    require_once $BASE_URL . "/models/Inventaris.php";
    require_once $BASE_URL . "/models/Jenis.php";
    require_once $BASE_URL . "/models/Ruang.php";
    require_once $BASE_URL . "/models/Petugas.php";
    require_once $BASE_URL . "/models/Peminjam.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }

    if(!empty($_GET['range_awal']) && !empty($_GET['range_akhir'])){
        $rangeAwal = $_GET['range_awal'];
        $rangeAkhir = $_GET['range_akhir'];
        $data = $peminjaman->whereBetween("tanggal_pinjam", "$rangeAwal", "$rangeAkhir");

        if(count($data) == 0){
            alert("Data laporan tidak tersedia!", "index.php");
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

    <table align="center" cellpadding="5" style="border-collapse: collapse" border="1">
        <tr>
            <td colspan="2" align="center">Laporan Peminjaman <br> <?= date('d F Y', strtotime($rangeAwal)) ?> - <?= date('d F Y', strtotime($rangeAkhir)) ?></td>
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
            <td><?= $inventaris->callProcedure('total_inventaris') ?></td>
        </tr>
        <tr>
            <td>Total Jenis</td>
            <td><?= $jenis->callProcedure('total_jenis') ?></td>
        </tr>
        <tr>
            <td>Total Ruang</td>
            <td><?= $ruang->callProcedure('total_ruang') ?></td>
        </tr>
        <tr>
            <td>Total Petugas</td>
            <td><?= $petugas->callProcedure('total_petugas') ?></td>
        </tr>
        <tr>
            <td>Total Peminjam</td>
            <td><?= $peminjam->callProcedure('total_peminjam') ?></td>
        </tr>
    </table>

    <div style="width: 100%; text-align: center; margin-top: 1em">
    <button onclick="print()">Print Laporan</button>
    <a href="detail_peminjaman.php?range_awal=<?= $rangeAwal ?>&range_akhir=<?= $rangeAkhir ?>"><button>Detail</button></a>
        
    </div>

</body>
</html>