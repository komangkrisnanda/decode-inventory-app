<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Ruang.php";

    if(isset($_POST['submit'])){
        $namaRuang = $_POST['nama_ruang'];
        $keteranganRuang = $_POST['keterangan_ruang'];
        $kodeRuang = random("R", 3);

        if(!empty($namaRuang)){
            $query = $ruang->where('nama_ruang', $namaRuang);

            if(count($query) == 0){
                $query = $ruang->insert([
                    'nama_ruang' => $namaRuang,
                    'kode_ruang' => $kodeRuang,
                    'keterangan' => $keteranganRuang
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