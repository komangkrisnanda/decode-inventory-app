<?php
    require_once "../autoload.php";
    require_once $BASE_URL . "/models/Peminjaman.php";
    require_once $BASE_URL . "/models/DetailPinjam.php";
    require_once $BASE_URL . "/models/Inventaris.php";

    $allowedLevel = ["Administrator","Operator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../index.php');
    }
    

    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];

        $query = $peminjaman->where('id_peminjaman', $id);

        if(count($query) > 1){
            $query = $peminjaman->update([
                'status_peminjaman' => 'Sudah Kembali'
            ], 'id_peminjaman',$id);

            if($query){
                $query = $detailPinjam->whereAll('id_peminjaman', $id);
                foreach($query as $detail){
                    $data_inventaris = $inventaris->where('id_inventaris', $detail['id_inventaris']);
                    $current_stock = $data_inventaris['jumlah'] + $detail['jumlah'];
                    $query = $inventaris->update([
                        'jumlah' => $current_stock
                    ], 'id_inventaris', $detail['id_inventaris']);
                }
                alert("Data is successfully added!", "index.php");
            }
            else{
                alert("Something error!", "index.php");
            }
        }
        else{
            alert("Data is already added before ! Please use another data!", "index.php");
        }
    }
    else{
        header('location: ../index.php');
    }
?>