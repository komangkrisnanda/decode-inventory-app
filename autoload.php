<?php
    $BASE_URL = "C:/xampp7/htdocs/ukk-inventory/";

    require_once $BASE_URL . "/libraries/Database.php";
    require_once $BASE_URL . "/libraries/Model.php";
    require_once $BASE_URL . "/helper/Alert.php";
    require_once $BASE_URL . "/helper/Random.php";
    require_once $BASE_URL . "/helper/Month.php";
    
    
    session_start();
    
    date_default_timezone_set('Asia/Makassar');
?>