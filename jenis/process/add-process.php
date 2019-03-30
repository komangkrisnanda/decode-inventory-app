<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Jenis.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../../index.php');
    }

    if(isset($_POST['submit'])){
        $namaJenis = $_POST['nama_jenis'];
        $keteranganJenis = $_POST['keterangan_jenis'];
        $kodeJenis = random("J", 3);

        if(!empty($namaJenis)){
            $query = $jenis->where('nama_jenis', $namaJenis);

            if(count($query) == 0){
                $query = $jenis->insert([
                    'nama_jenis' => $namaJenis,
                    'kode_jenis' => $kodeJenis,
                    'keterangan' => $keteranganJenis
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