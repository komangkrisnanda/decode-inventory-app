<?php
    require_once "../../autoload.php";
    require_once $BASE_URL . "/models/Peminjaman.php";
    require_once $BASE_URL . "/models/DetailPinjam.php";
    require_once $BASE_URL . "/models/Inventaris.php";

    $allowedLevel = ["Administrator","Operator"];
    if(!in_array($_SESSION['level'], $allowedLevel)){
        header('location: ../../index.php');
    }
    

    if(isset($_POST['submit'])){
        $idInventaris = $_POST['id_inventaris'];
        $jumlahPinjam = $_POST['jumlah_pinjam'];
        $tanggalPinjam = $_POST['tanggal_pinjam'];
        $tanggalKembali = $_POST['tanggal_kembali'];
        $idPegawai = $_POST['id_pegawai'];

        $detail = [];

        foreach($idInventaris as $key => $val){
            $detail[$key]['id_inventaris'] = $val;
        }

        foreach($jumlahPinjam as $key => $val){
            $detail[$key]['jumlah'] = $val;
        }

        // var_dump($detail);
        // die();

        if(!empty($idInventaris) && !empty($jumlahPinjam) && !empty($tanggalPinjam) && !empty($tanggalKembali) && is_numeric($idPegawai)){

            //Check 
            foreach($detail as $data){
                $check = $inventaris->whereAnd('id_inventaris', $data['id_inventaris'], 'jumlah', $data['jumlah']);

                if(count($check) == 0){
                    alert("Inventory out of stock!", "../index.php");
                    die();
                }
            }

            $query = $peminjaman->insert([
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali,
                'status_peminjaman' => "Belum Kembali",
                'id_pegawai' => $idPegawai
            ]);

            if($query){
                foreach($detail as $data){
                    $query = $detailPinjam->insert([
                        'id_peminjaman' => $peminjaman->getLastId(),
                        'id_inventaris' => $data['id_inventaris'],
                        'jumlah' => $data['jumlah']
                    ]);
                }
                alert("Data is successfully added!", "../index.php");
            }
            else{
                alert("Something error!", "../index.php");
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