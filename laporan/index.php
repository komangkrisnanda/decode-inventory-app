<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Peminjaman.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan</title>
</head>
<body>
    <h1 align="center">Laporan peminjaman bulanan</h1>
    <form action="detail.php" method="GET">
        <table align="center">
            <tr>
                <td>Range Awal</td>
                <td>
                    <input type="date" name="range_awal" value="<?= date("Y-m-d") ?>" required>
                </td>
            </tr>
            <tr>
                <td>Range Akhir</td>
                <td>
                    <input type="date" name="range_akhir" value="<?= date("Y-m-d", strtotime("+1 day")) ?>" required>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" value="Cari!"></td>
            </tr>
        </table>
    </form>
</body>
</html>