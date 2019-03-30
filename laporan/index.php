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
                <td>Pilih Bulan</td>
                <td>
                    <select name="bulan">
                        <?php
                            foreach($peminjaman->getMonths() as $data){
                                ?>
                                    <option value="<?= $data['bulan_pinjam'] ?>"><?= convertMonth($data['bulan_pinjam']) ?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <input type="submit" value="Cek Laporan">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>