<?php
    require_once $BASE_URL . "/libraries/Model.php";
    class Peminjaman extends Model{
        public $table = 'peminjaman';

        public function getLastId(){
            return $this->conn->lastInsertId();
        }

        public function withPeminjam($search, $page, $item){
            $start = ($page * $item) - $item; //
            $end   = $page * $item;
            
            $sql = "SELECT peminjaman.*, peminjam.nama_peminjam FROM peminjaman INNER JOIN peminjam ON peminjaman.id_peminjam = peminjam.id_peminjam WHERE peminjam.nama_peminjam LIKE '%$search%' ORDER BY peminjaman.tanggal_pinjam LIMIT $start, $end";

            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }

        public function withDetail($id){
            $sql = "SELECT peminjaman.*, peminjam.nama_peminjam, inventaris.nama, detail_pinjam.* FROM peminjaman INNER JOIN peminjam ON peminjaman.id_peminjam = peminjam.id_peminjam INNER JOIN detail_pinjam ON peminjaman.id_peminjaman = detail_pinjam.id_peminjaman INNER JOIN inventaris ON detail_pinjam.id_inventaris = inventaris.id_inventaris WHERE peminjaman.id_peminjaman = $id
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

        public function whereBetween($column, $start, $end){
            $sql = "SELECT * FROM peminjaman WHERE $column BETWEEN '$start' AND '$end'";
            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }
        
    }

    $peminjaman = new Peminjaman();
?>