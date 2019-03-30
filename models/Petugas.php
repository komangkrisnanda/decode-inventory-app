<?php
    require_once $BASE_URL . "/libraries/Model.php";
    class Petugas extends Model{
        public $table = 'petugas';

        public function withLevel(){
            $sql = "SELECT petugas.*, level.nama_level FROM petugas INNER JOIN level ON level.id_level = petugas.id_level";

            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }
    }

    $petugas = new Petugas();
?>