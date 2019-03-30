<?php
    class Database{

        protected $conn;

        public function __construct(){
            $this->conn = new PDO("mysql:host=localhost;dbname=ukk_inventory","root","");
        }
    }


    // $db = new Database();
?>