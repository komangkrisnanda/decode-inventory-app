<?php
    require_once $BASE_URL . "/libraries/Model.php";
    class Peminjaman extends Model{
        public $table = 'peminjaman';

        public function getLastId(){
            return $this->conn->lastInsertId();
        }

        public function withPegawai(){
            $sql = "SELECT peminjaman.*, pegawai.nama_pegawai FROM peminjaman INNER JOIN pegawai ON peminjaman.id_pegawai = pegawai.id_pegawai";

            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }

        public function withDetail($id){
            $sql = "SELECT peminjaman.*, pegawai.nama_pegawai, inventaris.nama, detail_pinjam.* FROM peminjaman INNER JOIN pegawai ON peminjaman.id_pegawai = pegawai.id_pegawai INNER JOIN detail_pinjam ON peminjaman.id_peminjaman = detail_pinjam.id_peminjaman INNER JOIN inventaris ON detail_pinjam.id_inventaris = inventaris.id_inventaris
            WHERE peminjaman.id_peminjaman = $id
            ";

            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }

        public function getMonths(){
            $sql = "SELECT month(tanggal_pinjam) as bulan_pinjam FROM peminjaman GROUP BY bulan_pinjam";
            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }

        public function whereAll($column, $data){
            $sql = "SELECT * FROM peminjaman WHERE $column = '$data'";
            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }
        
    }

    $peminjaman = new Peminjaman();
?>