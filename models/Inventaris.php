<?php
    require_once $BASE_URL . "/libraries/Model.php";
    class Inventaris extends Model{
        public $table = 'inventaris';

        public function withAll(){
            $sql = "SELECT inventaris.*, jenis.nama_jenis, ruang.nama_ruang, petugas.nama_petugas FROM inventaris 
            INNER JOIN jenis ON jenis.id_jenis = inventaris.id_jenis
            INNER JOIN ruang ON ruang.id_ruang = inventaris.id_ruang
            INNER JOIN petugas ON petugas.id_petugas = inventaris.id_petugas
            ORDER BY inventaris.id_inventaris DESC
            ";

            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }

        public function whereAnd($column, $value, $column2, $value2){
            $sql = "SELECT * FROM " . $this->table . " WHERE $column = '$value' AND $column2 >= '$value2'";
            
            $query = $this->conn->query($sql);

            if($query->rowCount() == 1){
                $rows = $query->fetch(PDO::FETCH_ASSOC);
            }
            else{
                $rows = [];
            }

            return $rows;
        }

        public function withSearch($search){
            $sql = "SELECT * FROM inventaris WHERE nama LIKE '%$search%'";

            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }
    }

    $inventaris = new Inventaris();
?>