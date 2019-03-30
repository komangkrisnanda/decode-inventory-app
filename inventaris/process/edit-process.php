<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Inventaris.php";
    
    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../../index.php');
    }

    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $idJenis = $_POST['id_jenis'];
        $idRuang = $_POST['id_ruang'];
        $kondisi = $_POST['kondisi'];
        $jumlahStok = $_POST['jumlah_stok'];
        $keterangan = $_POST['keterangan'];
        $idInventaris = $_POST['id'];

        if(!empty($nama) && is_numeric($idJenis) && is_numeric($idRuang) && !empty($kondisi) && is_numeric($jumlahStok) && !empty($keterangan) && is_numeric($idInventaris)){
            $query = $inventaris->where('id_inventaris', $idInventaris);

            if(count($query) > 1){
               
                $query = $inventaris->update([
                    'nama' => $nama,
                    'kondisi' => $kondisi,
                    'keterangan' => $keterangan,
                    'jumlah' => $jumlahStok,
                    'id_jenis' => $idJenis,
                    'id_ruang' => $idRuang,
                ], 'id_inventaris', $idInventaris);
                

                if($query){
                    alert("Data is successfully added!", "../index.php");
                }
                else{
                    alert("Something error!", "../index.php");
                }
            }
            else{
                alert("Data is already added before ! Please use another data!", "../index.php");
            }
        }
        else{
            alert("Please fill all forms!", "../index.php");
        }
    }
    else{
        header('location: ../index.php');
    }
?>