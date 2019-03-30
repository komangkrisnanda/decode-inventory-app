<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Inventaris.php";
    require_once $BASE_URL . "/models/Ruang.php";
    require_once $BASE_URL . "/models/Jenis.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }
    
    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $data = $inventaris->where('id_inventaris', $id);
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
    <title>Inventaris</title>
</head>
<body>
    <form action="process/edit-process.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id_inventaris'] ?>">
        <h1 align="center">Edit Data Inventaris</h1>
        <table style="margin:auto">
            <tr>
                <td>Nama Inventaris</td>
                <td><input type="text" name="nama" value="<?= $data['nama'] ?>"></td>
            </tr>
            <tr>
                <td>Jenis Inventaris</td>
                <td>
                    <select name="id_jenis">
                        <?php
                            foreach($jenis->all() as $data_jenis){
                                if($data['id_jenis'] == $data_jenis['id_jenis']){
                                    echo "<option value='$data_jenis[id_jenis]' selected>$data_jenis[nama_jenis] #$data_jenis[kode_jenis]</option>";
                                }
                                else{
                                    echo "<option value='$data_jenis[id_jenis]'>$data_jenis[nama_jenis] #$data_jenis[kode_jenis]</option>";
                                }
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
                            foreach($ruang->all() as $data_ruang){
                                if($data['id_ruang'] == $data_ruang['id_ruang']){
                                    echo "<option value='$data_ruang[id_ruang]' selected>$data_ruang[nama_ruang] #$data_ruang[kode_ruang]</option>";
                                }
                                else{
                                    echo "<option value='$data_ruang[id_ruang]'>$data_ruang[nama_ruang] #$data_ruang[kode_ruang]</option>";
                                }
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Kondisi Inventaris</td>
                <td>
                    <select name="kondisi">
                        <?php
                            $baik = "";
                            $kurangBaik = "";
                            $rusak = "";
                            
                            if($data['kondisi'] == "Baik"){
                                $baik = " selected";
                            }
                            else if($data['kondisi'] == "Kurang Baik"){
                                $kurangBaik = " selected";
                            }
                            else if($data['kondisi'] == "Rusak"){
                                $rusak = " selected";
                            }
                        ?>
                        <option value="Baik" <?= $baik ?>>Baik</option>
                        <option value="Kurang Baik" <?= $kurangBaik ?>>Kurang Baik</option>
                        <option value="Rusak" <?= $rusak ?>>Rusak</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Jumlah Stok</td>
                <td><input type="number" name="jumlah_stok" value="<?= $data['jumlah'] ?>"></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>
                    <textarea name="keterangan" rows="8" style="resize:none"><?= $data['keterangan'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Add Data"></td>
            </tr>
        </table>
    </form>
</body>
</html>