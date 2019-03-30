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

        if(!empty($nama) && is_numeric($idJenis) && is_numeric($idRuang) && !empty($kondisi) && is_numeric($jumlahStok) && !empty($keterangan)){
            $query = $inventaris->where('nama', $nama);

            if(count($query) == 0){
                $tanggalRegister = date("Y-m-d");
                $kodeInventaris = random("I", 3);

                $query = $inventaris->insert([
                    'nama' => $nama,
                    'kondisi' => $kondisi,
                    'keterangan' => $keterangan,
                    'jumlah' => $jumlahStok,
                    'id_jenis' => $idJenis,
                    'tanggal_register' => $tanggalRegister,
                    'id_ruang' => $idRuang,
                    'kode_inventaris' => $kodeInventaris,
                    'id_petugas' => $_SESSION['id_petugas'],
                ]);

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