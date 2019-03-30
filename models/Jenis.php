<?php
    require_once $BASE_URL . "/libraries/Model.php";
    class Jenis extends Model{
        public $table = 'jenis';
    }

    $jenis = new Jenis();
?>