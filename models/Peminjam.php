<?php
    require_once $BASE_URL . "/libraries/Model.php";
    class Peminjam extends Model{
        public $table = 'peminjam';
    }

    $peminjam = new Peminjam();
?>