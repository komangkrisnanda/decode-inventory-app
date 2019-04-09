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

            $data_peminjaman = $data;
            
            foreach($data_peminjaman as $data){
                ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td>
                            <?php
                                foreach($peminjam->all() as $data_peminjam){
                                    if($data_peminjam['id_peminjam'] == $data['id_peminjam']){
                                        echo $data_peminjam['nama_peminjam'];
                                    }
                                }
                            ?>
                        </td>
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
                        </td>
                    </tr>
                <?php
            }

        ?>
    </table>

</body>
</html>