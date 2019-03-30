<?php
    require_once $BASE_URL . "/libraries/Model.php";
    class DetailPinjam extends Model{
        public $table = 'detail_pinjam';

        public function whereAll($column, $data){
            $sql = "SELECT * FROM detail_pinjam WHERE $column = '$data'";

            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }
    }

    $detailPinjam = new DetailPinjam();
?>