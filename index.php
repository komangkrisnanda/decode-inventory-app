<?php
    require_once "autoload.php";

    $level = ["Administrator", "Operator"];
    if(!in_array($_SESSION['level'], $level)){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <?php $title = "Dashboard"; require_once $BASE_URL . "/helper/header.inc.php" ?>
</body>
</html>