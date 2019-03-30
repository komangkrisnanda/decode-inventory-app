<?php
    require_once $BASE_URL . "/libraries/Model.php";
    class Ruang extends Model{
        public $table = 'ruang';
    }

    $ruang = new Ruang();
?>