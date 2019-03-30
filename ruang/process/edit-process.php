<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Ruang.php";

    if(isset($_POST['submit'])){
        $idRuang = $_POST['id'];
        $namaRuang = $_POST['nama_ruang'];
        $keteranganRuang = $_POST['keterangan_ruang'];

        if(!empty($namaRuang) && is_numeric($idRuang)){
            $query = $ruang->where('id_ruang', $idRuang);

            if(count($query) > 1){
                $query = $ruang->update([
                    'nama_ruang' => $namaRuang,
                    'keterangan' => $keteranganRuang
                ], 'id_ruang', $idRuang);

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