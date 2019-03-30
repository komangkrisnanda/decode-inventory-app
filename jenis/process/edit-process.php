<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Jenis.php";

    $allowedLevel = ["Administrator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../../index.php');
    }

    if(isset($_POST['submit'])){
        $idJenis = $_POST['id'];
        $namaJenis = $_POST['nama_jenis'];
        $keteranganJenis = $_POST['keterangan_jenis'];

        if(!empty($namaJenis) && is_numeric($idJenis)){
            $query = $jenis->where('id_jenis', $idJenis);

            if(count($query) > 1){
                $query = $jenis->update([
                    'nama_jenis' => $namaJenis,
                    'keterangan' => $keteranganJenis
                ], 'id_jenis', $idJenis);

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